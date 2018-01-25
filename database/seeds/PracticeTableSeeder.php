<?php

use Illuminate\Database\Seeder;

class PracticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practiceValues = \App\Practice::$values;

        foreach($practiceValues as $value) {
            \App\Practice::create(array(
                'name' => $value
            ));
        }
    }
}
