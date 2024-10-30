<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => 'Client access']);
        $permission = Permission::create(['name' => 'Client edit']);
        $permission = Permission::create(['name' => 'Client add']);
        $permission = Permission::create(['name' => 'Client create']);
        $permission = Permission::create(['name' => 'Client delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Category access']);
        $permission = Permission::create(['name' => 'Category add']);
        $permission = Permission::create(['name' => 'Category edit']);
        $permission = Permission::create(['name' => 'Category delete']);

        $permission = Permission::create(['name' => 'Product access']);
        $permission = Permission::create(['name' => 'Product add']);
        $permission = Permission::create(['name' => 'Product edit']);
        $permission = Permission::create(['name' => 'Product delete']);

        $permission = Permission::create(['name' => 'Schedule access']);
        $permission = Permission::create(['name' => 'Schedule add']);
        $permission = Permission::create(['name' => 'Schedule edit']);
        $permission = Permission::create(['name' => 'Schedule delete']);


        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        
        $admin_role->givePermissionTo(Permission::all());
    }
}
