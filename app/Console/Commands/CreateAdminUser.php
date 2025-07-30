<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default admin user for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if admin user already exists
        $adminUser = User::where('username', 'admin')->first();
        
        if ($adminUser) {
            $this->error('Admin user already exists!');
            return 1;
        }

        // Create admin user
        User::create([
            'name' => 'Admin Warung',
            'username' => 'opal',
            'email' => 'admin@warung.com',
            'password' => Hash::make('umar'),
        ]);

        $this->info('Default admin user created successfully!');
        $this->info('Username: warung');
        $this->info('Password: busaemah');
        
        return 0;
    }
} 