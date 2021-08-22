<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->countries() as $country) {
            DB::table('countries')->insert($country);
        }
    }

    private function countries() {
        return [
            [
                'name' => 'Bosnia and Herzegovina'
            ],
            [
                'name' => 'United Kingdom'
            ],
            [
                'name' => 'Njemacka'
            ],
            [
                'name' => 'Austria'
            ],
            [
                'name' => 'Serbia'
            ],
            [
                'name' => 'Croatia'
            ]
        ];
    }
}
