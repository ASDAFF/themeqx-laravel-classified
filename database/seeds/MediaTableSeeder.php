<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $media_sql = file_get_contents(__DIR__ . '/dumps/media.sql');
        // split the statements, so DB::statement can execute them.
        $media_statements = array_filter(array_map('trim', explode(';', $media_sql)));
        foreach ($media_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
