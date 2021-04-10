<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username'=> 'staff',
                'name'=>'staff',
                'email'=>'staff@test.com',
                'is_staff'=>'1',
                'password'=> bcrypt('test123'),
            ],
            [
                'username'=>'grace',
                'name'=>'grace',
                'email'=>'grace@test.com',
                'is_staff'=>'0',
                'password'=> bcrypt('test123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
        }
    }

