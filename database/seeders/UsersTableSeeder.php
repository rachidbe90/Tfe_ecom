<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        //Customer
        DB::table('users')->insert([
            [
                'first_name'=>'First',
                'last_name'=>'Customer',
                'username'=>'Customer',
                'photo'=>$this->faker->imageUrl('60','60'),
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('1111'),
                'status'=>'active',
                'role'=>'customer',
            ],
            [
                'first_name'=>'Rachid',
                'last_name'=>'Vendor',
                'username'=>'Vendor',
                'photo'=>'',
                'email'=>'rachidbe90@gmail.com',
                'password'=>Hash::make('1111'),
                'status'=>'active',
                'role'=>'customer',
            ]
        ]);
        $this->faker = Faker::create();
        //admin
        DB::table('admins')->insert([
            [
                'first_name'=>'Rachid',
                'last_name'=>'Ahggoune',
                'photo'=>$this->faker->imageUrl('60','60'),
                'email'=>'Admin@gmail.com',
                'password'=>Hash::make('1111'),
                'status'=>'active',
            ],
            [
                'first_name'=>'Samira',
                'last_name'=>'Zamzam',
                'photo'=>$this->faker->imageUrl('60','60'),
                'email'=>'Admin1@gmail.com',
                'password'=>Hash::make('1111'),
                'status'=>'active',
            ]
        ]);
    }
}
