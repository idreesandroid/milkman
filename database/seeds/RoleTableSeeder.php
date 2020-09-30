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
        $role_hr = new Role();
        $role_hr->role_title = 'HR';
        $role_hr->save();

        $role_gm = new Role();
        $role_gm->role_title = 'GM';
        $role_gm->save();

        $role_admin = new Role();
        $role_admin->role_title = 'Vendor';
        $role_admin->save();

        $role_manager = new Role();
        $role_manager->role_title = 'Manager';
        $role_manager->save();
    }
}
