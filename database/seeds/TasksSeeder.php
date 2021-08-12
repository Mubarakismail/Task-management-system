<?php

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TasksSeeder extends Seeder
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
        $id=[];
        for ($i=0; $i < $len; $i++) {
            array_push($id,rand(1,$len));
        }
        for ($i=0; $i < $len; $i++) {

            $start=Carbon::now();
            $end=Carbon::now()->addDay(rand(1,20));
            $array=[
                'task_title'=>$faker->word,
                'task_desc'=>$faker->paragraph,
                'start_time'=>$start,
                'end_time'=>$end,
            ];
            $tasks=Task::create($array);
            $tasks->users()->attach(array_rand($id,2));
        }
    }
}
