<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersArr = [];
         // Generate 10 dummy users
        while(count($usersArr) < 10){
            $usersArr[] = [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        // Insert dummy users into database
        User::insert($usersArr);
    }
}
