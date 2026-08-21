<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'description' => 'Full system access',
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'description' => 'Administrator with most operations',
        ]);

        $orderManager = Role::create([
            'name' => 'Order Manager',
            'description' => 'Manages orders and returns',
        ]);

        $productManager = Role::create([
            'name' => 'Product Manager',
            'description' => 'Manages products and inventory',
        ]);

        $contentManager = Role::create([
            'name' => 'Content Manager',
            'description' => 'Manages blog, banners, and reviews',
        ]);

        $supportManager = Role::create([
            'name' => 'Support Manager',
            'description' => 'Customer support management',
        ]);

        $customer = Role::create([
            'name' => 'Customer',
            'description' => 'Regular customer',
        ]);

        // Create permissions
        $permissions = [
            // Dashboard
            'view_dashboard',
            'view_reports',

            // Products
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'restore_products',
            'manage_inventory',

            // Categories
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',

            // Orders
            'view_orders',
            'update_order_status',
            'cancel_orders',
            'process_refunds',
            'export_orders',

            // Customers
            'view_customers',
            'create_customers',
            'edit_customers',
            'disable_customers',
            'export_customers',

            // Coupons & Promotions
            'manage_coupons',
            'manage_banners',
            'manage_promotions',

            // Delivery
            'manage_delivery_zones',
            'manage_delivery_methods',

            // Content
            'manage_blog',
            'manage_reviews',
            'manage_faqs',

            // Users & Roles
            'manage_users',
            'manage_roles',
            'manage_permissions',

            // Settings
            'manage_settings',
            'manage_email',
            'manage_payment',
            'manage_delivery_config',

            // Logs
            'view_activity_logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'description' => ucfirst(str_replace('_', ' ', $permission)),
            ]);
        }

        // Assign permissions to Super Admin (all)
        $allPermissions = Permission::all();
        $superAdmin->permissions()->attach($allPermissions);

        // Assign permissions to Admin
        $adminPermissions = Permission::whereNotIn('name', ['manage_settings', 'manage_email', 'manage_payment', 'manage_delivery_config', 'manage_roles', 'manage_permissions', 'manage_users'])->get();
        $admin->permissions()->attach($adminPermissions);

        // Assign permissions to Order Manager
        $orderPermissions = Permission::whereIn('name', ['view_orders', 'update_order_status', 'cancel_orders', 'process_refunds', 'view_customers'])->get();
        $orderManager->permissions()->attach($orderPermissions);

        // Assign permissions to Product Manager
        $productPermissions = Permission::whereIn('name', ['view_products', 'create_products', 'edit_products', 'delete_products', 'restore_products', 'manage_inventory', 'view_categories', 'create_categories', 'edit_categories', 'delete_categories'])->get();
        $productManager->permissions()->attach($productPermissions);

        // Assign permissions to Content Manager
        $contentPermissions = Permission::whereIn('name', ['manage_blog', 'manage_reviews', 'manage_banners', 'manage_faqs'])->get();
        $contentManager->permissions()->attach($contentPermissions);

        // Assign permissions to Support Manager
        $supportPermissions = Permission::whereIn('name', ['view_orders', 'view_customers', 'process_refunds'])->get();
        $supportManager->permissions()->attach($supportPermissions);
    }
}
