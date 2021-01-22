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
        $permission_1->slug = 'Register-User';
        $permission_1->name = 'Register-User';
        $permission_1->save();
    
        $permission_2 = new Permission();
        $permission_2->slug = 'See-User';
        $permission_2->name = 'See-User';
        $permission_2->save();

        $permission_3 = new Permission();
        $permission_3->slug = 'Edit-User';
        $permission_3->name = 'Edit-User';
        $permission_3->save();

        $permission_4 = new Permission();
        $permission_4->slug = 'See-Role';
        $permission_4->name = 'See-Role';
        $permission_4->save();

        $permission_5 = new Permission();
        $permission_5->slug = 'Create-Role';
        $permission_5->name = 'Create-Role';
        $permission_5->save();

        $permission_6 = new Permission();
        $permission_6->slug = 'Edit-Role';
        $permission_6->name = 'Edit-Role';
        $permission_6->save();

        $permission_7 = new Permission();
        $permission_7->slug = 'Delete-Role';
        $permission_7->name = 'Delete-Role';
        $permission_7->save();

        $permission_8 = new Permission();
        $permission_8->slug = 'See-Permission';
        $permission_8->name = 'See-Permission';
        $permission_8->save();

        $permission_9 = new Permission();
        $permission_9->slug = 'Create-Permission';
        $permission_9->name = 'Create-Permission';
        $permission_9->save();

        $permission_10 = new Permission();
        $permission_10->slug = 'See-Product';
        $permission_10->name = 'See-Product';
        $permission_10->save();

        $permission_11 = new Permission();
        $permission_11->slug = 'Create-Product';
        $permission_11->name = 'Create-Product';
        $permission_11->save();

        $permission_12 = new Permission();
        $permission_12->slug = 'Edit-Product';
        $permission_12->name = 'Edit-Product';
        $permission_12->save();

        $permission_13 = new Permission();
        $permission_13->slug = 'Delete-Product';
        $permission_13->name = 'Delete-Product';
        $permission_13->save();

        $permission_14 = new Permission();
        $permission_14->slug = 'See-Product-Stock';
        $permission_14->name = 'See-Product-Stock';
        $permission_14->save();

        $permission_15 = new Permission();
        $permission_15->slug = 'Create-Product-Stock';
        $permission_15->name = 'Create-Product-Stock';
        $permission_15->save();

        $permission_16 = new Permission();
        $permission_16->slug = 'Edit-Product-Stock';
        $permission_16->name = 'Edit-Product-Stock';
        $permission_16->save();

        $permission_17 = new Permission();
        $permission_17->slug = 'Delete-Product-Stock';
        $permission_17->name = 'Delete-Product-Stock';
        $permission_17->save();

        $permission_18 = new Permission();
        $permission_18->slug = 'See-Vendor';
        $permission_18->name = 'See-Vendor';
        $permission_18->save();

        $permission_19 = new Permission();
        $permission_19->slug = 'Create-Vendor';
        $permission_19->name = 'Create-Vendor';
        $permission_19->save();

        $permission_20 = new Permission();
        $permission_20->slug = 'Edit-Vendor';
        $permission_20->name = 'Edit-Vendor';
        $permission_20->save();

        $permission_21 = new Permission();
        $permission_21->slug = 'See-Distributor';
        $permission_21->name = 'See-Distributor';
        $permission_21->save();

        $permission_22 = new Permission();
        $permission_22->slug = 'Create-Distributor';
        $permission_22->name = 'Create-Distributor';
        $permission_22->save();

        $permission_23 = new Permission();
        $permission_23->slug = 'Edit-Distributor';
        $permission_23->name = 'Edit-Distributor';
        $permission_23->save();

        $permission_24 = new Permission();
        $permission_24->slug = 'See-Cart';
        $permission_24->name = 'See-Cart';
        $permission_24->save();

        $permission_25 = new Permission();
        $permission_25->slug = 'Generate-Invoice';
        $permission_25->name = 'Generate-Invoice';
        $permission_25->save();

        $permission_26 = new Permission();
        $permission_26->slug = 'Delete-Invoice';
        $permission_26->name = 'Delete-Invoice';
        $permission_26->save();

        $permission_27 = new Permission();
        $permission_27->slug = 'Edit-Company-Detail';
        $permission_27->name = 'Edit-Company-Detail';
        $permission_27->save();

        $permission_28 = new Permission();
        $permission_28->slug = 'Edit-Agreement-Detail';
        $permission_28->name = 'Edit-Agreement-Detail';
        $permission_28->save();        

        $permission_29 = new Permission();
        $permission_29->slug = 'Edit-Bank-Detail';
        $permission_29->name = 'Edit-Bank-Detail';
        $permission_29->save();

        $permission_30 = new Permission();
        $permission_30->slug = 'See-profile';
        $permission_30->name = 'See-profile';
        $permission_30->save();

        $permission_31 = new Permission();
        $permission_31->slug = 'Make-Transaction';
        $permission_31->name = 'Make-Transaction';
        $permission_31->save();        

        $permission_32 = new Permission();
        $permission_32->slug = 'See-Transactions';
        $permission_32->name = 'See-Transactions';
        $permission_32->save();

        $permission_33 = new Permission();
        $permission_33->slug = 'Verify-Transaction';
        $permission_33->name = 'Verify-Transaction';
        $permission_33->save();

        $permission_34 = new Permission();
        $permission_34->slug = 'See-Personal-Transaction';
        $permission_34->name = 'See-Personal-Transaction';
        $permission_34->save();

        $permission_35 = new Permission();
        $permission_35->slug = 'See-All-Transactions';
        $permission_35->name = 'See-All-Transactions';
        $permission_35->save();

        $permission_34 = new Permission();
        $permission_34->slug = 'See-Personal-Profile';
        $permission_34->name = 'See-Personal-Profile';
        $permission_34->save();

        $permission_35 = new Permission();
        $permission_35->slug = 'Edit-Personal-Profile';
        $permission_35->name = 'Edit-Personal-Profile';
        $permission_35->save();

        $permission_35 = new Permission();
        $permission_35->slug = 'Login';
        $permission_35->name = 'Login';
        $permission_35->save();

        $permission_34 = new Permission();
        $permission_34->slug = 'See-My-Orders';
        $permission_34->name = 'See-My-Orders';
        $permission_34->save();

        $permission_35 = new Permission();
        $permission_35->slug = 'See-Invoice-Detail';
        $permission_35->name = 'See-Invoice-Detail';
        $permission_35->save();

        
    }
}
