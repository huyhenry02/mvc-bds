<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitiesSeeder::class,
            DistrictsSeeder::class,
            CategoriesSeeder::class,
            UsersSeeder::class,
            InvestorsSeeder::class,
            ProjectsSeeder::class,
            ZonesSeeder::class,
            PlotsSeeder::class,
            ProjectInvestorSeeder::class,
        ]);
    }
}
