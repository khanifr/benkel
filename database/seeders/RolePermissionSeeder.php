<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Hapus cache permission agar tidak terjadi duplikasi
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definisikan permission untuk users
        $usersPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        // Definisikan permission untuk pelanggan
        $pelangganPermissions = [
            'view pelanggan',
            'create pelanggan',
            'edit pelanggan',
            'delete pelanggan',
        ];

        // Buat permissions untuk users
        foreach ($usersPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat permissions untuk pelanggan
        foreach ($pelangganPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin dan berikan semua permission
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(array_merge($usersPermissions, $pelangganPermissions));

        // Assign role admin ke user dengan ID 3
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
