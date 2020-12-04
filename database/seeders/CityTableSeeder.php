<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city_1 = new City();
        $city_1->city_name = 'Lahore';
        $city_1->state_id = 1;
        $city_1->save();

        $city_2 = new City();
        $city_2->city_name = 'Gujranwala';
        $city_1->state_id = 1;
        $city_2->save();

        $city_3 = new City();
        $city_3->city_name = 'Gohtki';
        $city_1->state_id = 3;
        $city_3->save();

        $city_4 = new City();
        $city_4->city_name = 'Pashwer';
        $city_1->state_id = 2;
        $city_4->save();
    }
}
