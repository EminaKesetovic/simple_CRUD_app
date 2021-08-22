<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->contactTypes() as $contactType) {
            DB::table('contact_types')->insert($contactType);
        }
    }

    private function contactTypes() {
        return [
            [
                'name' => 'Phone'
            ],
            [
                'name' => 'Mobile'
            ],
            [
                'name' => 'Email'
            ],
            [
                'name' => 'Skype'
            ]
        ];
    }
}
