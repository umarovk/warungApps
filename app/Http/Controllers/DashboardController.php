<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class DashboardController extends Controller
{
    public function index()
    {
        // Get order statistics
        $orderStats = Order::getOrderSummary();
        
        // Get menu count
        $menuCount = Menu::active()->count();
        
        // Get user count (you can add User model later)
        $userCount = 3; // Placeholder for now
        
        // Get most sold menu items by category for today
        $topFoodItems = $this->getTopMenuItemsByCategory(Menu::KATEGORI_MAKANAN);
        $topDrinkItems = $this->getTopMenuItemsByCategory(Menu::KATEGORI_MINUMAN);
        
        return view('dashboard.index', compact(
            'orderStats', 
            'menuCount', 
            'userCount', 
            'topFoodItems', 
            'topDrinkItems'
        ));
    }
    
    private function getTopMenuItemsByCategory($category)
    {
        return OrderItem::select(
                'menus.id',
                'menus.nama',
                'menus.gambar',
                'menus.harga',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('menus.kategori', $category)
            ->where('menus.status', true)
            ->whereDate('orders.created_at', today())
            ->groupBy('menus.id', 'menus.nama', 'menus.gambar', 'menus.harga')
            ->orderBy('total_sold', 'desc')
            ->limit(3)
            ->get();
    }
    
    public function backupDatabase()
    {
        try {
            // Try mysqldump first
            $result = $this->backupWithMysqldump();
            if ($result) {
                return $result;
            }
            
            // Fallback to Laravel-based backup
            return $this->backupWithLaravel();
            
        } catch (\Exception $e) {
            Log::error('Database backup failed: ' . $e->getMessage());
            return back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }
    
    private function backupWithMysqldump()
    {
        try {
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port', 3306);
            
            // Check if mysqldump is available
            $mysqldumpPath = $this->findMysqldump();
            if (!$mysqldumpPath) {
                return false; // Fallback to Laravel method
            }
            
            // Create backup directory if it doesn't exist
            $backupDir = storage_path('app/backups');
            if (!file_exists($backupDir)) {
                if (!mkdir($backupDir, 0755, true)) {
                    throw new \Exception('Failed to create backup directory');
                }
            }
            
            // Generate filename with timestamp
            $filename = 'warung_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $filepath = $backupDir . '/' . $filename;
            
            // Build mysqldump command
            $command = [
                $mysqldumpPath,
                '--host=' . $host,
                '--port=' . $port,
                '--user=' . $username,
                '--password=' . $password,
                '--single-transaction',
                '--routines',
                '--triggers',
                '--add-drop-database',
                '--add-drop-table',
                $database
            ];
            
            // Execute mysqldump
            $process = new Process($command);
            $process->setTimeout(300); // 5 minutes timeout
            $process->run();
            
            if (!$process->isSuccessful()) {
                return false; // Fallback to Laravel method
            }
            
            $output = $process->getOutput();
            
            // Check if output is empty
            if (empty(trim($output))) {
                return false; // Fallback to Laravel method
            }
            
            // Save the backup to file
            if (file_put_contents($filepath, $output) === false) {
                throw new \Exception('Failed to write backup file');
            }
            
            // Check if file was created and has content
            if (!file_exists($filepath) || filesize($filepath) === 0) {
                throw new \Exception('Backup file was not created or is empty');
            }
            
            // Return the file for download
            return response()->download($filepath, $filename)->deleteFileAfterSend();
            
        } catch (\Exception $e) {
            Log::error('Mysqldump backup failed: ' . $e->getMessage());
            return false; // Fallback to Laravel method
        }
    }
    
    private function backupWithLaravel()
    {
        try {
            // Create backup directory if it doesn't exist
            $backupDir = storage_path('app/backups');
            if (!file_exists($backupDir)) {
                if (!mkdir($backupDir, 0755, true)) {
                    throw new \Exception('Failed to create backup directory');
                }
            }
            
            // Generate filename with timestamp
            $filename = 'warung_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $filepath = $backupDir . '/' . $filename;
            
            $sql = "-- Warung Database Backup\n";
            $sql .= "-- Generated on: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "-- Database: " . config('database.connections.mysql.database') . "\n\n";
            
            // Get all tables
            $tables = DB::select('SHOW TABLES');
            $tableColumn = 'Tables_in_' . config('database.connections.mysql.database');
            
            foreach ($tables as $table) {
                $tableName = $table->$tableColumn;
                
                // Get table structure
                $createTable = DB::select("SHOW CREATE TABLE `$tableName`")[0];
                $createTableColumn = 'Create Table';
                $sql .= "\n-- Table structure for table `$tableName`\n";
                $sql .= "DROP TABLE IF EXISTS `$tableName`;\n";
                $sql .= $createTable->$createTableColumn . ";\n\n";
                
                // Get table data
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    $sql .= "-- Data for table `$tableName`\n";
                    
                    foreach ($rows as $row) {
                        $values = [];
                        foreach ((array) $row as $value) {
                            if ($value === null) {
                                $values[] = 'NULL';
                            } else {
                                $values[] = "'" . addslashes($value) . "'";
                            }
                        }
                        $sql .= "INSERT INTO `$tableName` VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sql .= "\n";
                }
            }
            
            // Save the backup to file
            if (file_put_contents($filepath, $sql) === false) {
                throw new \Exception('Failed to write backup file');
            }
            
            // Return the file for download
            return response()->download($filepath, $filename)->deleteFileAfterSend();
            
        } catch (\Exception $e) {
            throw new \Exception('Laravel backup failed: ' . $e->getMessage());
        }
    }
    
    private function findMysqldump()
    {
        // Common mysqldump paths
        $possiblePaths = [
            'mysqldump',
            '/usr/bin/mysqldump',
            '/usr/local/bin/mysqldump',
            '/opt/mysql/bin/mysqldump',
            'C:\xampp\mysql\bin\mysqldump.exe',
            'C:\wamp\bin\mysql\mysql5.7.36\bin\mysqldump.exe',
            'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe',
        ];
        
        foreach ($possiblePaths as $path) {
            if (is_executable($path) || $this->isCommandAvailable($path)) {
                return $path;
            }
        }
        
        return false;
    }
    
    private function isCommandAvailable($command)
    {
        $process = new Process(['which', $command]);
        $process->run();
        return $process->isSuccessful();
    }
} 