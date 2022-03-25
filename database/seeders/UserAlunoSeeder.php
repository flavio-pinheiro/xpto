<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        // 	'name'     => 'Flavio Pinheiro',
        // 	'email'    => 'teste@teste.com',
        // 	'password' => '1234',
        // ])

        // DB::table('users')->insert([
        //     'name'     => 'Flavio Pinheiro',
        // 	'email'    => 'teste@teste.com',
        //     'password' => Hash::make('1234'),
        // ]);

    }
}
