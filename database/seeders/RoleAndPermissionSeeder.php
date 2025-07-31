<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Lead permissions
            'view leads',
            'create leads',
            'update leads',
            'delete leads',
            'assign leads',
            
            // Product permissions
            'view products',
            'create products',
            'update products',
            'delete products',
            
            // Project permissions
            'view projects',
            'create projects',
            'update projects',
            'delete projects',
            'approve projects',
            'reject projects',
            
            // Customer permissions
            'view customers',
            'create customers',
            'update customers',
            'delete customers',
            
            // Report permissions
            'view reports',
            'export reports',
            
            // User management permissions
            'view users',
            'create users',
            'update users',
            'delete users',
            
            // Activity log permissions
            'view activity logs',
            
            // Notification permissions
            'view notifications',
            'manage notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin role - full access
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Manager role - approval and oversight
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view leads',
            'create leads',
            'update leads',
            'assign leads',
            'view products',
            'create products',
            'update products',
            'view projects',
            'create projects',
            'update projects',
            'approve projects',
            'reject projects',
            'view customers',
            'create customers',
            'update customers',
            'view reports',
            'export reports',
            'view users',
            'view activity logs',
            'view notifications',
            'manage notifications',
        ]);

        // Sales role - customer-facing operations
        $salesRole = Role::create(['name' => 'sales']);
        $salesRole->givePermissionTo([
            'view leads',
            'create leads',
            'update leads',
            'view products',
            'view projects',
            'create projects',
            'update projects',
            'view customers',
            'create customers',
            'update customers',
            'view reports',
            'view notifications',
        ]);
    }
}
