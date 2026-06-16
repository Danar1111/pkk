<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = [
            'super_admin',
            'Admin_Sistem',
            'Pengurus_Inti',
            'Staf_Ahli',
            'Pengurus_Pokja_1',
            'Pengurus_Pokja_2',
            'Pengurus_Pokja_3',
            'Pengurus_Pokja_4',
        ];

        foreach ($roles as $role) {
            Role::findOrCreate($role, 'web');
        }
    }
}
