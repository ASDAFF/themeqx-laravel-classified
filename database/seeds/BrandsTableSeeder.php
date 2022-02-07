<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $brands_sql = file_get_contents(__DIR__ . '/dumps/brands.sql');
        // split the statements, so DB::statement can execute them.
        $brands_statements = array_filter(array_map('trim', explode(';', $brands_sql)));
        foreach ($brands_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
