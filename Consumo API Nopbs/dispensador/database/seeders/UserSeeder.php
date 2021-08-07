<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'nit' => '12345678',
                'type_user' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'token' => Hash::make('9B30ECF7-F19E-4D93-A13E-395E484FE815'),
                'active' => 1,
                'start_date' => '2021-05-09 00:45:59',
                'end_date' => null,
                'image' => 'logo-xs.png',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Odentis IPS',
                'nit' => '900684525',
                'type_user' => 2,
                'email' => 'odentis@gmail.com',
                'password' => Hash::make('12345678'),
                'token' => Hash::make('9B30ECF7-F19E-4D93-A13E-395E484FE814'),
                'active' => 1,
                'start_date' => '2021-05-09 00:45:59',
                'end_date' => '2022-05-09 00:45:59',
                'image' => 'logo-xs.png',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Prueba IPS',
                'nit' => '54321',
                'type_user' => 2,
                'email' => 'prueba@gmail.com',
                'password' => Hash::make('12345678'),
                'token' => Hash::make('9B30ECF7'),
                'active' => 1,
                'start_date' => '2020-05-09 00:45:59',
                'end_date' => '2021-05-09 00:45:59',
                'image' => 'logo-xs.png',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
