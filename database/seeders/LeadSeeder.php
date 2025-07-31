<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\User;
use Faker\Factory as Faker;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $salesUsers = User::where('role', 'sales')->pluck('id')->toArray();
        
        $leadStatuses = ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'];
        $priorities = ['low', 'medium', 'high', 'urgent'];
        
        // Create specific leads for demo
        $specificLeads = [
            [
                'name' => 'PT. Teknologi Maju',
                'email' => 'contact@teknologimaju.com',
                'phone' => '021-12345678',
                'address' => 'Jl. Sudirman No. 100, Jakarta Pusat',
                'company' => 'PT. Teknologi Maju',
                'status' => 'new',
                'priority' => 'high',
                'notes' => 'Perusahaan teknologi yang membutuhkan koneksi internet stabil untuk kantor pusat.',
                'estimated_value' => 2000000,
            ],
            [
                'name' => 'CV. Berkah Jaya',
                'email' => 'info@berkahjaya.com',
                'phone' => '021-87654321',
                'address' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                'company' => 'CV. Berkah Jaya',
                'status' => 'contacted',
                'priority' => 'medium',
                'notes' => 'Trading company yang butuh upgrade internet untuk mendukung sistem ERP.',
                'estimated_value' => 1200000,
            ],
            [
                'name' => 'Hotel Grand Paradise',
                'email' => 'manager@grandparadise.com',
                'phone' => '021-55667788',
                'address' => 'Jl. Thamrin No. 88, Jakarta Pusat',
                'company' => 'Hotel Grand Paradise',
                'status' => 'qualified',
                'priority' => 'high',
                'notes' => 'Hotel bintang 4 membutuhkan internet untuk guest dan operasional.',
                'estimated_value' => 3000000,
            ],
            [
                'name' => 'Restoran Nusantara',
                'email' => 'owner@nusantararesto.com',
                'phone' => '021-99887766',
                'address' => 'Jl. Kemang No. 25, Jakarta Selatan',
                'company' => 'Restoran Nusantara',
                'status' => 'proposal',
                'priority' => 'medium',
                'notes' => 'Restoran franchise yang butuh WiFi untuk customer dan POS system.',
                'estimated_value' => 650000,
            ],
            [
                'name' => 'Klinik Sehat Sentosa',
                'email' => 'admin@sehatsentosa.com',
                'phone' => '021-33445566',
                'address' => 'Jl. Fatmawati No. 12, Jakarta Selatan',
                'company' => 'Klinik Sehat Sentosa',
                'status' => 'negotiation',
                'priority' => 'medium',
                'notes' => 'Klinik yang membutuhkan internet untuk sistem informasi rumah sakit.',
                'estimated_value' => 800000,
            ],
        ];

        foreach ($specificLeads as $leadData) {
            $leadData['assigned_to'] = $faker->randomElement($salesUsers);
            $leadData['last_contacted_at'] = $faker->dateTimeBetween('-30 days', 'now');
            Lead::create($leadData);
        }

        // Create random leads
        for ($i = 0; $i < 35; $i++) {
            $companyName = $faker->company;
            $contactName = $faker->name;
            
            Lead::create([
                'name' => $contactName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'company' => $faker->boolean(70) ? $companyName : null, // 70% chance of having company
                'status' => $faker->randomElement($leadStatuses),
                'priority' => $faker->randomElement($priorities),
                'notes' => $faker->boolean(60) ? $faker->paragraph : null,
                'estimated_value' => $faker->boolean(80) ? $faker->numberBetween(250000, 5000000) : null,
                'assigned_to' => $faker->randomElement($salesUsers),
                'last_contacted_at' => $faker->boolean(70) ? $faker->dateTimeBetween('-60 days', 'now') : null,
            ]);
        }
    }
}
