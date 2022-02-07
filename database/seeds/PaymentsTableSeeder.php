<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $payment_sql = file_get_contents(__DIR__ . '/dumps/payments.sql');
        // split the statements, so DB::statement can execute them.
        $payment_statements = array_filter(array_map('trim', explode(';', $payment_sql)));
        foreach ($payment_statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
