<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('languages')->insert([
            'id' => 3,
            'language_name' => 'Bangla',
            'language_code' => 'bn',
        ]);
    }
}
