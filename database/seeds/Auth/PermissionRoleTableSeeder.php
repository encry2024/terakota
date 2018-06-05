<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin      = Role::create(['name' => config('access.users.admin_role')]);
        $executive  = Role::create(['name' => 'executive']);
        $user       = Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);

        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'store product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'force delete product']);
        Permission::create(['name' => 'restore product']);

        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'store category']);
        Permission::create(['name' => 'update category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'force delete category']);
        Permission::create(['name' => 'restore category']);

        Permission::create(['name' => 'view shifts']);
        Permission::create(['name' => 'store shift']);
        Permission::create(['name' => 'update shift']);
        Permission::create(['name' => 'delete shift']);
        Permission::create(['name' => 'force delete shift']);
        Permission::create(['name' => 'restore shift']);

        Permission::create(['name' => 'view dinings']);
        Permission::create(['name' => 'store dining']);
        Permission::create(['name' => 'update dining']);
        Permission::create(['name' => 'delete dining']);
        Permission::create(['name' => 'force delete dining']);
        Permission::create(['name' => 'restore dining']);

        Permission::create(['name' => 'view discounts']);
        Permission::create(['name' => 'store discount']);
        Permission::create(['name' => 'update discount']);
        Permission::create(['name' => 'delete discount']);
        Permission::create(['name' => 'force delete discount']);
        Permission::create(['name' => 'restore discount']);

        Permission::create(['name' => 'store order']);
        Permission::create(['name' => 'remove item']);

        Permission::create(['name' => 'view report']);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view backend');

        $admin->givePermissionTo('view products');
        $admin->givePermissionTo('store product');
        $admin->givePermissionTo('update product');
        $admin->givePermissionTo('delete product');
        $admin->givePermissionTo('force delete product');
        $admin->givePermissionTo('restore product');

        $admin->givePermissionTo('view categories');
        $admin->givePermissionTo('store category');
        $admin->givePermissionTo('update category');
        $admin->givePermissionTo('delete category');
        $admin->givePermissionTo('force delete category');
        $admin->givePermissionTo('restore category');

        $admin->givePermissionTo('view shifts');
        $admin->givePermissionTo('store shift');
        $admin->givePermissionTo('update shift');
        $admin->givePermissionTo('delete shift');
        $admin->givePermissionTo('force delete shift');
        $admin->givePermissionTo('restore shift');

        $admin->givePermissionTo('view dinings');
        $admin->givePermissionTo('store dining');
        $admin->givePermissionTo('update dining');
        $admin->givePermissionTo('delete dining');
        $admin->givePermissionTo('force delete dining');
        $admin->givePermissionTo('restore dining');

        $admin->givePermissionTo('view discounts');
        $admin->givePermissionTo('store discount');
        $admin->givePermissionTo('update discount');
        $admin->givePermissionTo('delete discount');
        $admin->givePermissionTo('force delete discount');
        $admin->givePermissionTo('restore discount');

        $user->givePermissionTo('store order');
        $user->givePermissionTo('remove item');
        $user->givePermissionTo('view report');

        $admin->givePermissionTo('view report');

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
