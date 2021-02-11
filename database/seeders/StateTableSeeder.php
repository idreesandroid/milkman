<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\CollectionArea;
class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area_1 = new CollectionArea();
        $area_1->areaTitle = 'i-8';
        $area_1->areaDimension = 'Json string here';
        $area_1->areaStatus = 'inActive';
        $area_1->save();

        $area_1 = new CollectionArea();
        $area_1->areaTitle = 'i-9';
        $area_1->areaDimension = 'Json string here';
        $area_1->areaStatus = 'inActive';
        $area_1->save();

        $area_1 = new CollectionArea();
        $area_1->areaTitle = 'g-8';
        $area_1->areaDimension = 'Json string here';
        $area_1->areaStatus = 'inActive';
        $area_1->save();

        $area_1 = new CollectionArea();
        $area_1->areaTitle = 'g-9';
        $area_1->areaDimension = 'Json string here';
        $area_1->areaStatus = 'inActive';
        $area_1->save();

        
    }
}
