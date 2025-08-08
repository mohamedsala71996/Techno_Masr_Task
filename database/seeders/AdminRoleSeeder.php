<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class AdminRoleSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = require base_path('app/Helpers/dashboard_permissions.php');
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'admin']);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'admin']);

        $superAdmin->syncPermissions($permissions);
      
        // Assign super-admin role to first admin
        $firstAdmin = Admin::orderBy('id')->first();
        if ($firstAdmin) {
            $firstAdmin->assignRole('super-admin');
        }
    }
}
