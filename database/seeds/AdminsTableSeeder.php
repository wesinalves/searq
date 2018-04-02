<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        DB::table('admins')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'wesin ribeiro alves',
        	'email'=>'wesinalves@iec.pa.gov.br',
        	'job_title'=>'administrator',
        	'password'=>bcrypt('123456'),
        ]);
    }
}
