<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(IdiomsTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(LocalesTableSeeder::class);
        $this->call(ProducersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
    }
}
