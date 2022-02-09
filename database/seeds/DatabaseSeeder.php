<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);

        $this->call(AdsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FavoriteTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(ReportAdTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(SocialAccountTableSeeder::class);

    }
}
