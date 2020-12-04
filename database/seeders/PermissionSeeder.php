<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $permission_1 = new Permission();
        $permission_1->slug = 'See-User';
        $permission_1->name = 'See-User';
        $permission_1->save();

        $permission_2 = new Permission();
        $permission_2->slug = 'Edit-User';
        $permission_2->name = 'Edit-User';
        $permission_2->save();

        $permission_3 = new Permission();
        $permission_3->slug = 'See-Role';
        $permission_3->name = 'See-Role';
        $permission_3->save();

        $permission_3 = new Permission();
        $permission_3->slug = 'Create-Role';
        $permission_3->name = 'Create-Role';
        $permission_3->save();

        $permission_4 = new Permission();
        $permission_4->slug = 'Edit-Role';
        $permission_4->name = 'Edit-Role';
        $permission_4->save();

        $permission_5 = new Permission();
        $permission_5->slug = 'Delete-Role';
        $permission_5->name = 'Delete-Role';
        $permission_5->save();

        $permission_6 = new Permission();
        $permission_6->slug = 'See-Permission';
        $permission_6->name = 'See-Permission';
        $permission_6->save();

        $permission_7 = new Permission();
        $permission_7->slug = 'Create-Permission';
        $permission_7->name = 'Create-Permission';
        $permission_7->save();

        $permission_8 = new Permission();
        $permission_8->slug = 'See-Product';
        $permission_8->name = 'See-Product';
        $permission_8->save();

        $permission_9 = new Permission();
        $permission_9->slug = 'Create-Product';
        $permission_9->name = 'Create-Product';
        $permission_9->save();

        $permission_10 = new Permission();
        $permission_10->slug = 'Edit-Product';
        $permission_10->name = 'Edit-Product';
        $permission_10->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Delete-Product';
        $permission_11->name = 'Delete-Product';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'See-Product-Stock';
        $permission_12->name = 'See-Product-Stock';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Create-Product-Stock';
        $permission_11->name = 'Create-Product-Stock';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'Edit-Product-Stock';
        $permission_12->name = 'Edit-Product-Stock';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Delete-Product-Stock';
        $permission_11->name = 'Delete-Product-Stock';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'See-Vendor';
        $permission_12->name = 'See-Vendor';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Create-Vendor';
        $permission_11->name = 'Create-Vendor';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'Edit-Vendor';
        $permission_12->name = 'Edit-Vendor';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'See-Distributor';
        $permission_11->name = 'See-Distributor';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'Create-Distributor';
        $permission_12->name = 'Create-Distributor';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Edit-Distributor';
        $permission_11->name = 'Edit-Distributor';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'See-Cart';
        $permission_12->name = 'See-Cart';
        $permission_12->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Generate-Invoice';
        $permission_11->name = 'Generate-Invoice';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'Delete-Invoice';
        $permission_12->name = 'Delete-Invoice';
        $permission_12->save();
        
    }
}
