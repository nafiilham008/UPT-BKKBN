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
        $roleAdmin->givePermissionTo(Permission::all());

        // $userAdmin->assignRole('Admin');
        // $allPermissions = Permission::all()->pluck('name');
        // $filteredPermissions = $allPermissions->filter(function ($permissionName) {
        //     return $permissionName !== 'dashboard-user';
        // });
        // $roleAdmin->givePermissionTo($filteredPermissions);

        // $permissions = ['dashboard-user'];
        // $roleUserRemaja->givePermissionTo($permissions);

        $adminRemaja = User::find(2);
        $adminRemaja->assignRole('Admin Remaja');
        $permissions = [
            'dashboard-admin',
            'question view', 'question create', 'question edit', 'question delete',
            'quiz-category view', 'quiz-category create', 'quiz-category edit', 'quiz-category delete',
            'quiz view', 'quiz create', 'quiz edit', 'quiz delete',
            'user-remaja view'
        ];
        $roleAdminRemaja->givePermissionTo($permissions);


        // $userAdminRemaja = User::find(2);
        // $userAdminRemaja->assignRole('User Remaja');
    }
}
