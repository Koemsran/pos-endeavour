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
            'phone_number' => '0984214124',
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '0984214123',
        ]);



        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'owner']);
        Role::create(['name' => 'customer']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

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

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        $permission = Permission::create(['name' => 'Field access']);
        $permission = Permission::create(['name' => 'Field add']);
        $permission = Permission::create(['name' => 'Field edit']);
        $permission = Permission::create(['name' => 'Field delete']);

        $permission = Permission::create(['name' => 'Category access']);
        $permission = Permission::create(['name' => 'Category add']);
        $permission = Permission::create(['name' => 'Category edit']);
        $permission = Permission::create(['name' => 'Category delete']);

        $permission = Permission::create(['name' => 'Booking access']);
        $permission = Permission::create(['name' => 'Booking add']);
        $permission = Permission::create(['name' => 'Booking edit']);
        $permission = Permission::create(['name' => 'Booking delete']);

        $permission = Permission::create(['name' => 'Product access']);
        $permission = Permission::create(['name' => 'Product add']);
        $permission = Permission::create(['name' => 'Product edit']);
        $permission = Permission::create(['name' => 'Product delete']);

        $permission = Permission::create(['name' => 'Payment access']);
        $permission = Permission::create(['name' => 'Payment add']);
        $permission = Permission::create(['name' => 'Payment edit']);
        $permission = Permission::create(['name' => 'Payment delete']);

        $permission = Permission::create(['name' => 'Feedback access']);
        $permission = Permission::create(['name' => 'Feedback add']);
        $permission = Permission::create(['name' => 'Feedback edit']);
        $permission = Permission::create(['name' => 'Feedback delete']);

        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        
        $admin_role->givePermissionTo(Permission::all());
    }
}
