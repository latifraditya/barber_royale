<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Grouping permissions
        $permissions = [
            // Booking permissions
            'booking.create',
            'booking.edit',
            'booking.delete',

            // Barber permissions
            'barber.create',
            'barber.edit',  
            'barber.delete',

            // Service permissions
            'service.create',
            'service.edit',
            'service.delete',

            // Booking history permissions
            'booking-history.read',
            'booking-history.delete',

            // Booking details permissions
            'booking-details.read',

            // Payment permissions
            'payment.read',


            // Financial report permissions
            'financial-report.view',
            'financial-report.manage',

            // Admin dashboard permissions
            'admin-dashboard.view',
            'admin-dashboard.manage',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::updateOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $admin = \Spatie\Permission\Models\Role::findByName('admin');
        $admin->givePermissionTo($permissions);

        $user = \Spatie\Permission\Models\Role::findByName('user');
        $user->givePermissionTo(['booking.create','booking.edit', 'booking.delete', 'booking-history.read', 'payment.read']);

        $barber = \Spatie\Permission\Models\Role::findByName('barber');
        $barber->givePermissionTo(['booking.create', 'booking.edit', 'booking.delete']);

        $superadmin = \Spatie\Permission\Models\Role::findByName('superadmin');
        $superadmin->givePermissionTo($permissions);

        $manager = \Spatie\Permission\Models\Role::findByName('manager');
        $manager->givePermissionTo(['booking.create', 'booking.edit', 'booking.delete', 'financial-report.view', 'financial-report.manage']);
    }
}
