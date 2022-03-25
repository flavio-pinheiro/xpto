<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BolsaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bolsas')->insert([
            'vagas'     => 3,
        	'inicio'    => '2022-03-03 14:30:00',
            'fim' => '2022-04-03 17:00:00',
            'sorteio'  => '2022-04-05 12:00:00',
            'curso'  => 'Eletrônica',
            'status'  => 'Abertas',
        ]);

        DB::table('bolsas')->insert([
            'vagas'     => 5,
        	'inicio'    => '2022-03-05 14:30:00',
            'fim' => '2022-03-28 17:00:00',
            'sorteio'  => '2022-04-10 12:00:00',
            'curso'  => 'Química',
            'status'  => 'Abertas',
        ]);

        DB::table('bolsas')->insert([
            'vagas'     => 9,
        	'inicio'    => '2022-03-04 15:30:00',
            'fim' => '2022-03-28 17:10:00',
            'sorteio'  => '2022-01-07 11:00:00',
            'curso'  => 'Adm',
            'status'  => 'Abertas',
        ]);
    }
}
