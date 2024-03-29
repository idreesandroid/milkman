<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_ad = new Role();
        $role_ad->slug = 'admin';
        $role_ad->name = 'Admin';
        $role_ad->save();

        $role_r_d = new Role();
        $role_r_d->slug = 'collection-manager';
        $role_r_d->name = 'Collection Manager';
        $role_r_d->save();

        $role_c_ad = new Role();
        $role_c_ad->slug = 'distributor';
        $role_c_ad->name = 'Distributor';
        $role_c_ad->save();

        $role_a_ad = new Role();
        $role_a_ad->slug = 'milk-bank-Manager';
        $role_a_ad->name = 'Milk Bank Manager';
        $role_a_ad->save();

        $role_col = new Role();
        $role_col->slug = 'collector';
        $role_col->name = 'Collector';
        $role_col->save();

        $role_ven = new Role();
        $role_ven->slug = 'vendor';
        $role_ven->name = 'Vendor';
        $role_ven->save();

        $role_ven = new Role();
        $role_ven->slug = 'process-Manager';
        $role_ven->name = 'Process Manager';
        $role_ven->save();

        $role_ven = new Role();
        $role_ven->slug = 'developer';
        $role_ven->name = 'Developer';
        $role_ven->save();
    }
}
