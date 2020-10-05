<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_ad = new Role();
        $role_ad->role_id = 1;
        $role_ad->role_title = 'Admin';
        $role_ad->save();

       

        $role_c_ad = new Role();
        $role_c_ad->role_id = 10;
        $role_c_ad->role_title = 'City Manager';
        $role_c_ad->save();

        $role_a_ad = new Role();
        $role_a_ad->role_id = 15;
        $role_a_ad->role_title = 'Area Manager';
        $role_a_ad->save();

        $role_col = new Role();
        $role_col->role_id = 20;
        $role_col->role_title = 'Collector';
        $role_col->save();

        $role_ven = new Role();
        $role_ven->role_id = 25;
        $role_ven->role_title = 'Vendor';
        $role_ven->save();

    }

}

