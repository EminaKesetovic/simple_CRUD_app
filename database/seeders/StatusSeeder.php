<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses() as $status) {
            DB::table('statuses')->insert($status);
        }
    }

    private function statuses() {
        return [
            [
                'name' => 'aktivan'
            ],
            [
                'name' => 'inaktivan'
            ],
            [
                'name' => 'nepoznato'
            ]
        ];
    }
}
