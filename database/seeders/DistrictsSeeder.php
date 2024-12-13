<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/districts.csv');
        $csvData = array_map('str_getcsv', file($path));
        $districts = [];
        foreach ($csvData as $row) {
            $districts[] = [
                'id' => $row[0],
                'name' => $row[1],
                'city_id' => $row[3],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('districts')->insert($districts);
    }
}
