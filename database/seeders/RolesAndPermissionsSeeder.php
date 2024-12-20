<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define the permissions
        $permissions = [
            // User Permissions
            'view_products',
            'add_to_cart',
            'place_order',
            'leave_review',
            'update_profile',
            'subscribe_newsletter',
            'add_to_wishlist',

            // Admin Permissions
            'manage_users',
            'manage_roles',
            'manage_products',
            'manage_orders',
            'manage_payments',
            'manage_reviews',
            'view_reports',
            'manage_promotions',
            'access_settings',

            // Product Manager Permissions
            'create_product',
            'edit_product',
            'delete_product',
            'update_inventory',
            'view_product_reports',

            // Order Manager Permissions
            'process_order',
            'update_order_status',
            'manage_shipping',
            'manage_returns',

            // Marketing Manager Permissions
            'manage_campaigns',
            'manage_email_campaigns',
            'manage_social_media',

            // Customer Support Permissions
            'assist_with_orders',
            'handle_returns',
            'respond_to_inquiries',
        ];

        // Create Permissions if they don't exist (using firstOrCreate)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles and Assign Permissions

        // Admin Role
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());

        // Customer Role
        $customer = Role::create(['name' => 'Customer']);
        $customer->givePermissionTo([
            'view_products',
            'add_to_cart',
            'place_order',
            'leave_review',
            'update_profile',
            'subscribe_newsletter',
            'add_to_wishlist',
        ]);

        // Guest Role
        $guest = Role::create(['name' => 'Guest']);
        $guest->givePermissionTo([
            'view_products',
            'add_to_cart', // Optional: depends on if you want guests to add to the cart
        ]);

        // VIP Role (Customer Plus)
        $vip = Role::create(['name' => 'VIP']);
        $vip->givePermissionTo([
            'view_products',
            'add_to_cart',
            'place_order',
            'leave_review',
            'update_profile',
            'subscribe_newsletter',
            'add_to_wishlist',
            'manage_campaigns', // Optional: for VIP privileges like special offers
        ]);

        // Product Manager Role
        $productManager = Role::create(['name' => 'Product Manager']);
        $productManager->givePermissionTo([
            'create_product',
            'edit_product',
            'delete_product',
            'update_inventory',
            'view_product_reports',
        ]);

        // Order Manager Role
        $orderManager = Role::create(['name' => 'Order Manager']);
        $orderManager->givePermissionTo([
            'process_order',
            'update_order_status',
            'manage_shipping',
            'manage_returns',
        ]);

        // Marketing Manager Role
        $marketingManager = Role::create(['name' => 'Marketing Manager']);
        $marketingManager->givePermissionTo([
            'manage_campaigns',
            'manage_email_campaigns',
            'manage_social_media',
        ]);

        // Customer Support Role
        $customerSupport = Role::create(['name' => 'Customer Support']);
        $customerSupport->givePermissionTo([
            'assist_with_orders',
            'handle_returns',
            'respond_to_inquiries',
        ]);
    }
}
