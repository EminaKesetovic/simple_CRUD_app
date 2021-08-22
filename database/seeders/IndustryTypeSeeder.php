<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->industryTypes() as $industryType) {
            DB::table('industry_types')->insert($industryType);
        }
    }

    private function industryTypes() {
        return [
            [
                'name' => 'Chemical industry'
            ],
            [
                'name' => 'Rail Industry'
            ],
            [
                'name' => 'Energy Industry'
            ],
            [
                'name' => 'Toy Industry'
            ]
        ];
    }
}
