<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = \App\Models\UserAdministration\Role::create([
            'name'=>'Administradores',
        ]);
        $usersRole = \App\Models\UserAdministration\Role::create([
            'name'=>'Usuarios',
        ]);
        $adminRole->users()->create([
            'username'=>'admin',
            'password'=>'admin',
        ]);
        $folder = \App\Models\ReportsFolders\Folder::create([
            'name'=>'Mis Reportes',
        ]);
    }
}
