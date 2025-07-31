<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $leads = Lead::all();
        $products = Product::all();
        $salesUsers = User::where('role', 'sales')->pluck('id')->toArray();
        $managers = User::where('role', 'manager')->pluck('id')->toArray();
        
        $statuses = ['pending', 'in_progress', 'pending_approval', 'approved', 'rejected', 'completed'];
        
        // Create projects for some leads (not all leads become projects)
        $selectedLeads = $leads->random(min(25, $leads->count()));
        
        foreach ($selectedLeads as $index => $lead) {
            $product = $products->random();
            $status = $faker->randomElement($statuses);
            $projectCode = 'PRJ-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            $projectData = [
                'project_code' => $projectCode,
                'lead_id' => $lead->id,
                'product_id' => $product->id,
                'assigned_sales_id' => $lead->assigned_to ?? $faker->randomElement($salesUsers),
                'status' => $status,
                'project_value' => $lead->estimated_value ?? $product->price,
                'contract_duration_months' => $faker->randomElement([12, 24, 36]),
                'sales_notes' => $faker->paragraph,
            ];
            
            // Handle different status scenarios
            if ($status === 'pending_approval') {
                // Projects awaiting approval - no approval data yet
                $projectData['description'] = $faker->paragraph;
                $projectData['expected_close_date'] = $faker->dateTimeBetween('now', '+30 days');
            } elseif ($status === 'approved') {
                // Approved projects
                $projectData['manager_notes'] = $faker->sentence;
                $projectData['approved_by'] = $faker->randomElement($managers);
                $projectData['approved_at'] = $faker->dateTimeBetween('-30 days', 'now');
                $projectData['description'] = $faker->paragraph;
                $projectData['expected_close_date'] = $faker->dateTimeBetween('now', '+60 days');
            } elseif ($status === 'rejected') {
                // Rejected projects
                $projectData['manager_notes'] = $faker->sentence;
                $projectData['rejected_by'] = $faker->randomElement($managers);
                $projectData['rejected_at'] = $faker->dateTimeBetween('-30 days', 'now');
                $projectData['rejection_reason'] = $faker->randomElement([
                    'Insufficient budget',
                    'Technical requirements not met',
                    'Customer not qualified',
                    'Duplicate project',
                    'Incomplete documentation'
                ]);
                $projectData['description'] = $faker->paragraph;
            } elseif ($status === 'completed') {
                // Completed projects
                $projectData['manager_notes'] = $faker->sentence;
                $projectData['approved_by'] = $faker->randomElement($managers);
                $projectData['approved_at'] = $faker->dateTimeBetween('-60 days', '-30 days');
                $projectData['installation_date'] = $faker->dateTimeBetween('-30 days', '-7 days');
                $projectData['description'] = $faker->paragraph;
                $projectData['expected_close_date'] = $faker->dateTimeBetween('-30 days', 'now');
            } else {
                // For pending and in_progress - basic info only
                $projectData['description'] = $faker->paragraph;
                if ($status === 'in_progress') {
                    $projectData['expected_close_date'] = $faker->dateTimeBetween('now', '+45 days');
                }
            }
            
            Project::create($projectData);
        }
    }
}
