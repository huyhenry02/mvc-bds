<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/cities.csv');
        $csvData = array_map('str_getcsv', file($path));
        $cities = [];
        foreach ($csvData as $row) {
            $cities[] = [
                'id' => $row[0],
                'name' => $row[1],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('cities')->insert($cities);
    }
}
