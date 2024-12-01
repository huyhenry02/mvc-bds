<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/zones.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Zone::create([
                'id' => $item->id,
                'code' => $item->code,
                'name' => $item->name,
                'description' => $item->description,
                'project_id' => $item->project_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
