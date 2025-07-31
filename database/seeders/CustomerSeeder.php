<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Project;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Only approved projects become customers
        $approvedProjects = Project::where('status', 'approved')->get();
        
        foreach ($approvedProjects as $index => $project) {
            $customerCode = 'CUST-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            $customer = Customer::create([
                'customer_code' => $customerCode,
                'name' => $project->lead->name,
                'email' => $project->lead->email,
                'phone' => $project->lead->phone,
                'address' => $project->lead->address,
                'company' => $project->lead->company,
                'status' => $faker->randomElement(['active', 'active', 'active', 'suspended']), // Most customers are active
                'project_id' => $project->id,
                'sales_person_id' => $project->assigned_sales_id,
                'service_start_date' => $project->installation_date ?? $faker->dateTimeBetween('-90 days', 'now'),
                'notes' => $faker->boolean(30) ? $faker->paragraph : null,
            ]);
            
            // Create customer-product relationship
            CustomerProduct::create([
                'customer_id' => $customer->id,
                'product_id' => $project->product_id,
                'status' => $customer->status,
                'monthly_fee' => $project->product->price,
                'service_start_date' => $customer->service_start_date,
                'service_end_date' => $customer->status === 'terminated' ? $faker->dateTimeBetween('now', '+30 days') : null,
                'installation_notes' => $faker->boolean(50) ? $faker->sentence : null,
            ]);
            
            // Some customers might have additional products (upsell)
            if ($faker->boolean(20)) { // 20% chance of having additional product
                $additionalProduct = \App\Models\Product::where('id', '!=', $project->product_id)->inRandomOrder()->first();
                if ($additionalProduct) {
                    CustomerProduct::create([
                        'customer_id' => $customer->id,
                        'product_id' => $additionalProduct->id,
                        'status' => 'active',
                        'monthly_fee' => $additionalProduct->price,
                        'service_start_date' => $faker->dateTimeBetween($customer->service_start_date, 'now'),
                        'installation_notes' => 'Additional service subscription',
                    ]);
                }
            }
        }
    }
}
