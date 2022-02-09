<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $slider_sql = file_get_contents(__DIR__ . '/dumps/sliders.sql');
        // split the statements, so DB::statement can execute them.
        $slider_statements = array_filter(array_map('trim', explode(';', $slider_sql)));
        foreach ($slider_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
