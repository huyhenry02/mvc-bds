<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/categories.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Category::create([
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
