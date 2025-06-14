<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['title' => 'user_management_access',],
            ['title' => 'user_management_create',],
            ['title' => 'user_management_edit',],
            ['title' => 'user_management_view',],
            ['title' => 'user_management_delete',],
            ['title' => 'permission_access',],
            ['title' => 'permission_create',],
            ['title' => 'permission_edit',],
            ['title' => 'permission_view',],
            [ 'title' => 'permission_delete',],
            [ 'title' => 'role_access',],
            [ 'title' => 'role_create',],
            [ 'title' => 'role_edit',],
            [ 'title' => 'role_view',],
            [ 'title' => 'role_delete',],
            [ 'title' => 'user_access',],
            [ 'title' => 'user_create',],
            [ 'title' => 'user_edit',],
            [ 'title' => 'user_view',],
            [ 'title' => 'user_delete',],
            [ 'title' => 'currency_access',],
            [ 'title' => 'currency_create',],
            [ 'title' => 'currency_edit',],
            [ 'title' => 'currency_view',],
            [ 'title' => 'currency_delete',],
            ['title' => 'expense_management_access',],
            ['title' => 'expense_management_create',],
            ['title' => 'expense_management_edit',],
            ['title' => 'expense_management_view',],
            ['title' => 'expense_management_delete',],
            ['title' => 'income_management_access',],
            ['title' => 'income_management_create',],
            ['title' => 'income_management_edit',],
            ['title' => 'income_management_view',],
            ['title' => 'income_management_delete',],
        ];

            Permission::insert($permissions);

    }
}
