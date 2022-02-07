<?php

use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $favorite_sql = file_get_contents(__DIR__ . '/dumps/favorites.sql');
        // split the statements, so DB::statement can execute them.
        $favorite_statements = array_filter(array_map('trim', explode(';', $favorite_sql)));
        foreach ($favorite_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
