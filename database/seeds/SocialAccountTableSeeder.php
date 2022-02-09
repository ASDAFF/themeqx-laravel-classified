<?php

use Illuminate\Database\Seeder;

class SocialAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $social_accounts_sql = file_get_contents(__DIR__ . '/dumps/social_accounts.sql');
        // split the statements, so DB::statement can execute them.
        $social_accounts_statements = array_filter(array_map('trim', explode(';', $social_accounts_sql)));
        foreach ($social_accounts_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
