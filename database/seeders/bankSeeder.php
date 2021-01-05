<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bankList;
class bankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_ad = new bankList();
        $role_ad->bankName = 'UBL';
        $role_ad->save();

        $role_r_d = new bankList();
        $role_r_d->bankName = 'HBL';
        $role_r_d->save();

        $role_c_ad = new bankList();
        $role_c_ad->bankName = 'MCB';
        $role_c_ad->save();
    }
}
