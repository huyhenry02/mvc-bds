<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/users.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            User::create([
                'id' => $item->id,
                'full_name' => $item->full_name,
                'email' => $item->email,
                'password' => bcrypt($item->password),
                'phone_number' => $item->phone_number,
                'address' => $item->address,
                'date_of_birth' => $item->date_of_birth,
                'role' => $item->role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
