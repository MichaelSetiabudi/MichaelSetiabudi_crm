<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@ptsmart.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create Manager Users
        $manager1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.manager@ptsmart.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'address' => 'Jl. Manager No. 1, Jakarta',
            'role' => 'manager',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $manager1->assignRole('manager');

        $manager2 = User::create([
            'name' => 'Sari Wulandari',
            'email' => 'sari.manager@ptsmart.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Jl. Manager No. 2, Jakarta',
            'role' => 'manager',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $manager2->assignRole('manager');

        // Create Sales Users
        $salesUsers = [
            [
                'name' => 'Ahmad Fadil',
                'email' => 'ahmad.sales@ptsmart.com',
                'phone' => '081234567893',
                'address' => 'Jl. Sales No. 1, Jakarta',
            ],
            [
                'name' => 'Lisa Handayani',
                'email' => 'lisa.sales@ptsmart.com',
                'phone' => '081234567894',
                'address' => 'Jl. Sales No. 2, Jakarta',
            ],
            [
                'name' => 'Riko Pratama',
                'email' => 'riko.sales@ptsmart.com',
                'phone' => '081234567895',
                'address' => 'Jl. Sales No. 3, Jakarta',
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya.sales@ptsmart.com',
                'phone' => '081234567896',
                'address' => 'Jl. Sales No. 4, Jakarta',
            ],
            [
                'name' => 'Doni Setiawan',
                'email' => 'doni.sales@ptsmart.com',
                'phone' => '081234567897',
                'address' => 'Jl. Sales No. 5, Jakarta',
            ],
        ];

        foreach ($salesUsers as $salesData) {
            $sales = User::create([
                'name' => $salesData['name'],
                'email' => $salesData['email'],
                'password' => Hash::make('password'),
                'phone' => $salesData['phone'],
                'address' => $salesData['address'],
                'role' => 'sales',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $sales->assignRole('sales');
        }
    }
}
