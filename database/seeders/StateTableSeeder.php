<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state_1 = new State();
        $state_1->state_name = 'Punjab';
        $state_1->save();

        $state_2 = new State();
        $state_2->state_name = 'Kpk';
        $state_2->save();

        $state_3 = new State();
        $state_3->state_name = 'Sindh';
        $state_3->save();

        $state_4 = new State();
        $state_4->state_name = 'Blochistan';
        $state_4->save();
    }
}
