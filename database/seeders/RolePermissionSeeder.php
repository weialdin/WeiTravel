<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        $permissions = [
            'manage categories',
            'manage packages',
            'manage transactions',
            'manage package bank',
            'checkout package',
            'view orders',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $customerRole = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        $customerPermissions = [
            'checkout package',
            'view orders'
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'weialdin@admin.com',
            'phone_number' => '6281334700902',
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('777222'),
        ]);
        $user->assignRole($superAdminRole);
    }
}
