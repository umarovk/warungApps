<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateAdminUsername extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-admin-username';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing admin user with username';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminUser = User::where('email', 'admin@warung.com')->first();
        
        if (!$adminUser) {
            $this->error('Admin user not found!');
            return 1;
        }

        $adminUser->update(['username' => 'admin']);

        $this->info('Admin user updated successfully!');
        $this->info('Username: admin');
        $this->info('Password: busaemah');
        
        return 0;
    }
} 