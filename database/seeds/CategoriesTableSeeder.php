<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category_sql = file_get_contents(__DIR__ . '/dumps/categories.sql');
        // split the statements, so DB::statement can execute them.
        $category_statements = array_filter(array_map('trim', explode(';', $category_sql)));
        foreach ($category_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
