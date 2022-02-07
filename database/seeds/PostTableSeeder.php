<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $post_sql = file_get_contents(__DIR__ . '/dumps/posts.sql');
        // split the statements, so DB::statement can execute them.
        $post_statements = array_filter(array_map('trim', explode(';', $post_sql)));
        foreach ($post_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
