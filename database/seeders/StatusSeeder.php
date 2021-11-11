<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'description' => 'Iniciada'
        ]);

        DB::table('status')->insert([
            'description' => 'Em processo'
        ]);

        DB::table('status')->insert([
            'description' => 'Finalizada'
        ]);
    }
}
