<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Menu;

class SetMenuOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:set-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the order of menu items';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting menu order...');

        // Define the desired order
        $menuOrder = [
            'bakso' => 1,
            'mie ayam' => 2,
            'mie bakso' => 3,
            'ketupat' => 4,
            'kerupuk' => 5
        ];

        $updated = 0;

        foreach ($menuOrder as $menuName => $order) {
            $menu = Menu::where('nama', 'like', '%' . $menuName . '%')->first();
            
            if ($menu) {
                $menu->update(['urutan' => $order]);
                $this->info("✓ Updated '{$menu->nama}' to order {$order}");
                $updated++;
            } else {
                $this->warn("⚠ Menu containing '{$menuName}' not found");
            }
        }

        // Set default order for other menus
        $otherMenus = Menu::whereNotIn('nama', array_keys($menuOrder))->get();
        $defaultOrder = 10;
        
        foreach ($otherMenus as $menu) {
            $menu->update(['urutan' => $defaultOrder]);
            $this->info("✓ Set '{$menu->nama}' to default order {$defaultOrder}");
            $defaultOrder++;
        }

        $this->info("\nMenu order updated successfully! {$updated} menus updated.");
        
        // Show final order
        $this->info("\nFinal menu order:");
        Menu::ordered()->get()->each(function($menu) {
            $this->line("{$menu->urutan}. {$menu->nama} ({$menu->kategori})");
        });
    }
}
