<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Investor;
use Illuminate\Database\Seeder;

class InvestorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/investors.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Investor::create([
                'id' => $item->id,
                'full_name' => $item->full_name,
                'email' => $item->email,
                'phone_number' => $item->phone_number,
                'description' => $item->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
