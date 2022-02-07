<?php

use Illuminate\Database\Seeder;

class ReportAdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $report_ad_sql = file_get_contents(__DIR__ . '/dumps/report_ads.sql');
        // split the statements, so DB::statement can execute them.
        $report_ad_statements = array_filter(array_map('trim', explode(';', $report_ad_sql)));
        foreach ($report_ad_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
