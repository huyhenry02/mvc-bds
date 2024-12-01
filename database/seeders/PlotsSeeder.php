<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plot;
use Illuminate\Database\Seeder;

class PlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \JsonException
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/plots.json'));
        $data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);

        foreach ($data as $item) {
            Plot::create([
                'id' => $item->id,
                'zone_id' => $item->zone_id,
                'name' => $item->name,
                'size' => $item->size,
                'price' => $item->price,
                'deposit' => $item->deposit,
                'specific_address' => $item->specific_address,
                'status' => $item->status,
                'description' => $item->description,
                'main_image' => $item->main_image,
                'sub_image_1' => $item->sub_image_1,
                'sub_image_2' => $item->sub_image_2,
                'sub_image_3' => $item->sub_image_3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
