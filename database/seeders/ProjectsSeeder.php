<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/projects.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Project::create([
                'id' => $item->id,
                'category_id' => $item->category_id,
                'name' => $item->name,
                'description' => $item->description,
                'city_id' => $item->city_id,
                'district_id' => $item->district_id,
                'specific_address' => $item->specific_address,
                'account_holder' => $item->account_holder,
                'account_number' => $item->account_number,
                'bank' => $item->bank,
                'start_date' => $item->start_date,
                'end_date' => $item->end_date,
                'status' => $item->status,
                'image_project' => $item->image_project,
                'qr_code' => "/assets/img/qr-code.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
