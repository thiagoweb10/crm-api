<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'department_id' => 6,
            'phone' => '1199999999',
            'password' => 123
        ])->roles()->attach(1);

        User::create([
            'name'  => 'Admin',
            'email' => 'adm@admin.com',
            'department_id' => 6,
            'phone' => '1199999999',
            'password' => 123
        ])->roles()->attach(2);

        User::create([
            'name'  => 'Developer',
            'email' => 'devvelop@admin.com',
            'department_id' => 6,
            'phone' => '1199999999',
            'password' => 123
        ])->roles()->attach(3);

        User::create([
            'name'  => 'Usuario Comum',
            'email' => 'user@user.com',
            'department_id' => 5,
            'phone' => '1199999999',
            'password' => 123
        ])->roles()->attach(4);

        User::create([
            'name'  => 'Thiago Melo',
            'email' => 'thiago_melo18@yahoo.com.br',
            'department_id' => 6,
            'phone' => '1199999999',
            'password' => 123
        ])->roles()->attach(3);
    }
}
