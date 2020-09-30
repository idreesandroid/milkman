<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(RoleTableSeeder::class);
         $this->call(StateTableSeeder::class);
        // $this->call(CityTableSeeder::class);
         $this->call(RouteTableSeeder::class);

	         
    }
}
