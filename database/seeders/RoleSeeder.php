<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrcreate(['name' => 'admin']);
        Role::updateOrcreate(['name' => 'user']);
        Role::updateOrcreate(['name' => 'barber']);
        Role::updateOrcreate(['name' => 'superadmin']);
        Role::updateOrcreate(['name' => 'manager']);
        Role::updateOrcreate(['name' => 'staff']);
        Role::updateOrcreate(['name' => 'customer']);
        Role::updateOrcreate(['name' => 'guest']);       
    }
}
