<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use App\Models\ProjectInvestor;

class ProjectInvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/project_investor.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            ProjectInvestor::create([
                'id' => $item->id,
                'investor_id' => $item->investor_id,
                'project_id' => $item->project_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
