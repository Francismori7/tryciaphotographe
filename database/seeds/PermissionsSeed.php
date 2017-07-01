<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /**
         * @var Role $adminRole
         * @var Role $userRole
         */
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $bothPermissions[] = Permission::create(['name' => 'access website']);
        $bothPermissions[] = Permission::create(['name' => 'see own notifications']);
        $adminPermissions[] = Permission::create(['name' => 'view all users']);
        $adminPermissions[] = Permission::create(['name' => 'create users']);
        $adminPermissions[] = Permission::create(['name' => 'edit users']);
        $adminPermissions[] = Permission::create(['name' => 'impersonate users']);
        $bothPermissions[] = Permission::create(['name' => 'edit own billing info']);
        $bothPermissions[] = Permission::create(['name' => 'edit own settings']);
        $adminPermissions[] = Permission::create(['name' => 'delete users']);
        $bothPermissions[] = Permission::create(['name' => 'view own appointments']);
        $adminPermissions[] = Permission::create(['name' => 'view all appointments']);
        $bothPermissions[] = Permission::create(['name' => 'create appointments']);
        $adminPermissions[] = Permission::create(['name' => 'approve appointments']);
        $adminPermissions[] = Permission::create(['name' => 'decline appointments']);
        $adminPermissions[] = Permission::create(['name' => 'conclude appointments']);
        $adminPermissions[] = Permission::create(['name' => 'edit appointments']);
        $adminPermissions[] = Permission::create(['name' => 'delete appointments']);
        $bothPermissions[] = Permission::create(['name' => 'delete own appointments']);
        $adminPermissions[] = Permission::create(['name' => 'create shootings']);
        $adminPermissions[] = Permission::create(['name' => 'edit shootings']);
        $adminPermissions[] = Permission::create(['name' => 'delete shootings']);
        $adminPermissions[] = Permission::create(['name' => 'view all shootings']);
        $bothPermissions[] = Permission::create(['name' => 'view own shootings']);

        $adminRole->givePermissionTo(array_merge($adminPermissions, $bothPermissions));
        $userRole->givePermissionTo(array_merge($bothPermissions));

        /** @var User $mainAdmin */
        $mainAdmin = User::create([
            'id' => 1,
            'name' => 'Francis Morissette',
            'email' => 'morissette.francis@gmail.com',
            'password' => '$2a$04$Tlj1Yovy80pFVc1UGJkme.M/4UTuwwpUMLpStYswEL81Wr47/cWJ6',
            'activation_code' => null,
            'activated_at' => \Carbon\Carbon::now(),
        ]);

        $mainAdmin->assignRole([$adminRole, $userRole]);

        Model::reguard();
    }
}
