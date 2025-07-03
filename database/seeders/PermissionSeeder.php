<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesStructure = [
            'Super Admin' => [
                'dashboard' => 'r',
                'users' => 'r,c,u,d',

                // settings
                'settings' => 'r,u',
                'roles' => 'r,c,u,d',
                'permissions' => 'r,c',
                'notifications' => 'r,u',
                'currencies' => 'r,c,u,d',
                'report-types' => 'r,c,u,d',
                'gateways' => 'r,u',
                'payment-type' => 'r,c,u,d',
                'categories' => 'r,c,u,d',
                'services' => 'r,u',
                'influencers' => 'r,c,u,d',
                'clients' => 'r,c,u,d',
                'coupons' => 'r,c,u,d',
                'orders' => 'r,u,d',
                'complains' => 'r,d',
                'supports' => 'r,u,d',
                'expense-categories' => 'r,c,u,d',
                'expenses' => 'r,c,u,d',
                'reports' => 'r,u',
                'blogs' => 'r,c,u,d',
                'term-conditions' => 'r,u',
                'about-us' => 'r,u',
                'help-supports' => 'r,u',
                'withdraw-methods' => 'r,c,u,d',
                'withdraw-request' => 'r,u',
                'banners' => 'r,c,u,d',
                'refunds' => 'r,c,u,d',
                'social-medias' => 'r,c,u,d'

            ],

            'Admin' => [
                'dashboard' => 'r',
                'users' => 'r,c,u,d',

                // settings
                'settings' => 'r,u',
                'notifications' => 'r,u',
                'report-types' => 'r,c,u,d',
                'categories' => 'r,c',
                'services' => 'r,u',
                'influencers' => 'r,c',
                'clients' => 'r,c',
                'coupons' => 'r,c',
                'orders' => 'r,u,d',
                'complains' => 'r,d',
                'supports' => 'r,u,d',
                'expense-categories' => 'r,c',
                'expenses' => 'r,c,u,d',
                'reports' => 'r,u',
                'blogs' => 'r,c,u,d',
                'term-conditions' => 'r,u',
                'about-us' => 'r,u',
                'help-supports' => 'r,u',
                'withdraw-methods' => 'r,c',
                'withdraw-request' => 'r,u',
                'banners' => 'r,c,u,d',
                'refunds' => 'r,c,u,d',
                'social-medias' => 'r,c,u,d'
            ],

            'Manager' => [
                'dashboard' => 'r',

                // settings
                'notifications' => 'r,u',
                'categories' => 'r,c',
                'services' => 'r,u',
                'coupons' => 'r,c,u',
                'orders' => 'r,u,d',
                'complains' => 'r,d',
                'supports' => 'r,u,d',
                'expenses' => 'r,c,u,d',
                'blogs' => 'r,c,u,d',
                'term-conditions' => 'r,u',
                'about-us' => 'r,u',
                'help-supports' => 'r,u',
                'withdraw-methods' => 'r',
                'withdraw-request' => 'r',
                'banners' => 'r',
                'refunds' => 'r,u',
                'social-medias' => 'r'
            ],
        ];

        foreach ($rolesStructure as $key => $modules) {
            // Create a new role
            $role = Role::firstOrCreate([
                'name' => str($key)->remove(' ')->lower(),
                'guard_name' => 'web'
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $perm) {

                    $permissionValue = $this->permissionMap()->get($perm);

                    $permissions[] = Permission::firstOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'guard_name' => 'web'
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");
            // Create default user for each role
            $user = User::create([
                'role' => str($key)->remove(' ')->lower(),
                'name' => ucwords(str_replace('_', ' ', $key)),
                'password' => bcrypt(str($key)->remove(' ')->lower()),
                'email' => str($key)->remove(' ')->lower().'@'.str($key)->remove(' ')->lower().'.com',
                'image' => 'https://avatars.dicebear.com/api/adventurer/'.str($key)->slug().'.svg',
                'email_verified_at' => now(),
            ]);

            $user->assignRole($role);
        }
    }

    private function permissionMap() {
        return collect([
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete',
        ]);
    }
}
