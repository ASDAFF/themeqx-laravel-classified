<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ads_sql = file_get_contents(__DIR__ . '/dumps/ads.sql');
        // split the statements, so DB::statement can execute them.
        $ads_statements = array_filter(array_map('trim', explode(';', $ads_sql)));
        foreach ($ads_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
