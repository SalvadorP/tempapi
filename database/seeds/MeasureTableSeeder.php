<?php

use App\Measure;
use Illuminate\Database\Seeder;

class MeasureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $measures = factory(Measure::class, 10)->create();
    }
}
