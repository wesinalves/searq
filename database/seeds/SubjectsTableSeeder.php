<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i < 10; $i++){
        	DB::table('subjects')->insert([
        		'created_at'=> date("Y-m-d H:i:s"),
        		'updated_at'=> date("Y-m-d H:i:s"),
        		'name'=> str_random(20),
        	]);
        }
    }
}
