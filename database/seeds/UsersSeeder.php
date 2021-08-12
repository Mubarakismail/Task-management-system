<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $len=rand(10,50);
        $faker = Faker::create();
        for ($i=0; $i < $len; $i++) {

            $array=[
                'name'=>$faker->name,
                'phone_number'=>$faker->phoneNumber,
                'type'=>(rand(1,2)%2==0?'developer':'leader'),
                'email'=>$faker->email,
                'password'=>bcrypt('123456'),
            ];
            User::create($array);
        }
    }
}
