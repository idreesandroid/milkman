<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	$this->call(CountriesTableSeeder::class);
$this->call(StatesTableSeeder::class);
$this->call(CitiesTableSeeder::class);
         
    }
}
