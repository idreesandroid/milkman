<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\assetsType;
class assetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $assetsType_1 = new assetsType();
        $assetsType_1->typeName = 'vehicle';
        $assetsType_1->assetUnit = 'cc';
        $assetsType_1->description = 'Type vehicle unit is cc.';
        $assetsType_1->save();

        $assetsType_1 = new assetsType();
        $assetsType_1->typeName = 'Drum';
        $assetsType_1->assetUnit = 'ltr';
        $assetsType_1->description = 'Type Drum for Milk unit is ltr.';
        $assetsType_1->save();

        $assetsType_1 = new assetsType();
        $assetsType_1->typeName = 'Device';
        $assetsType_1->assetUnit = 'Active';
        $assetsType_1->description = 'Type Device that is Active.';
        $assetsType_1->save();


    }
}
