<?php

namespace Database\Seeders;

use App\Models\Auth\Permission;
use App\Models\Auth\PermissionRole;
use App\Models\Auth\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PermissionRole::truncate();
        Permission::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->updateOrCreateRoles();

        $permission_ids = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route) {
            if (false !== mb_strpos($route->action['namespace'], 'App\Http\Controllers\Admin')) {
                // get route action
                $action = $route->getActionname();
                // separating controller and method
                $_action = explode('@', $action);

                $controller = $_action[0];
                $method = end($_action);

                // check if this permission is already exists
                $permission_check = Permission::where(
                    ['controller' => $controller, 'method' => $method]
                )->first();
                $name = explode('\\', $controller);
                $name = str_replace('Controller', '', end($name));
                if (! $permission_check) {
                    $permission = Permission::firstOrCreate(
                        ['name' => $name . '@' . $method],
                        [
                            'controller' => $controller,
                            'method'     => $method,
                        ]
                    );
                    // add stored permission id in array
                    $permission_ids[] = $permission->id;
                }
            }
        }
        // SYNC ADMIN ROLES.
        $admin_role = Role::where('name', 'super-admin')->first();
        $adminPermissions = Permission::select('id')->whereNotIn('name', Permission::adminExcludePermissions())->get('id')->pluck('id')->toarray();
        $admin_role->permissions()->sync($adminPermissions);

        // SYNC STORE ROLES.
        $storePermissions = Permission::select('id')->whereIn('name', Permission::storeRoles())->get('id')->pluck('id')->toarray();
        $storeRole = Role::where('name', 'store')->first();
        $storeRole->permissions()->sync($storePermissions);

        // SYNC MANAGER ROLES.
        $managerPermissions = Permission::select('id')->whereIn('name', Permission::managerRoles())->get('id')->pluck('id')->toarray();
        $managerRole = Role::where('name', 'manager')->first();
        $managerRole->permissions()->sync($managerPermissions);

        // SYNC FORUM MANAGER ROLES.
        $managerForumPermissions = Permission::select('id')->whereIn('name', Permission::forumManagerRoles())->get('id')->pluck('id')->toarray();
        $forumManagerRole = Role::where('name', 'forum-manager')->first();
        $forumManagerRole->permissions()->sync($managerForumPermissions);
    }

    private function updateOrCreateRoles()
    {
        $roles = [
            ['name' => 'super-admin','description' => 'Süper Admin'],
            ['name' => 'store','description' => 'Mağaza'],
            ['name' => 'store-worker','description' => 'Mağaza Çalışan'],
            ['name' => 'company','description' => 'Firma'],
            ['name' => 'manager','description' => 'Yönetici'],
            ['name' => 'forum-manager','description' => 'Forum Yönetici'],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role], $role);
        }
    }
}
