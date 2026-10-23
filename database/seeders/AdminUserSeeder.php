<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the default admin account.
     * Run with: php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@velorahomes.in'],
            [
                'name' => 'VELORA Admin',
                'password' => Hash::make('Admin@1234'),
                'is_admin' => true,
            ]
        );

        $this->command->info('Admin user created: admin@velorahomes.in / Admin@1234');
        $this->command->warn('Change the password after first login!');
    }
}
