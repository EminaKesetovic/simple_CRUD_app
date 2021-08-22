<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cities() as $city) {
            DB::table('cities')->insert($city);
        }
    }

    private function cities() {
        return [
            [
                'name' => 'Sarajevo'
            ],
            [
                'name' => 'London'
            ],
            [
                'name' => 'Berlin'
            ],
            [
                'name' => 'Vienna'
            ]
        ];
    }
}
