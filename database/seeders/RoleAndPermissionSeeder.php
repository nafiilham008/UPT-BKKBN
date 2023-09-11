<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Role, Permission};

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUserRemaja = Role::create(['name' => 'User Remaja']);
        $roleAdminRemaja = Role::create(['name' => 'Admin Remaja']);

        foreach (config('permission.permissions') as $permission) {
            foreach ($permission['access'] as $access) {
                Permission::create(['name' => $access]);
            }
        }

        $userAdmin = User::first();
        $userAdmin->assignRole('Admin');
        $allPermissions = Permission::all()->pluck('name');
        $filteredPermissions = $allPermissions->filter(function ($permissionName) {
            return $permissionName !== 'dashboard-user';
        });
        $roleAdmin->givePermissionTo($filteredPermissions);


        // $userAdminRemaja = User::find(2);
        // $userAdminRemaja->assignRole('User Remaja');
    }
}
