<?php

use Illuminate\Database\Seeder;
use App\Vendor_Route;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route_1 = new Vendor_Route();
        $route_1->route_name = 'I-8';
        $route_1->route_description = 'Islamabad I-8';
        $route_1->save();

        $route_2 = new Vendor_Route();
        $route_2->route_name = 'H-8';
        $route_2->route_description = 'Islamabad H-8';
        $route_2->save();

        $route_3 = new Vendor_Route();
        $route_3->route_name = 'G-13';
        $route_3->route_description = 'Islamabad G-13';
        $route_3->save();

        $route_4 = new Vendor_Route();
        $route_4->route_name = 'Chak Shahzad';
        $route_4->route_description = 'Islamabad Chak Shahzad';
        $route_4->save();
    }
}
