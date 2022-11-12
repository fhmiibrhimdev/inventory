<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'kode_merek'    =>  'INDO',
                'nama_merek'    =>  'INDO',
            ],
            [
                'kode_merek'    =>  'NESTLE',
                'nama_merek'    =>  'NESTLE',
            ],
            [
                'kode_merek'    =>  'INDOFOOD',
                'nama_merek'    =>  'INDOFOOD',
            ],
            [
                'kode_merek'    =>  'MYSTK',
                'nama_merek'    =>  'MAJESTIK',
            ],
            [
                'kode_merek'    =>  'BRCDA',
                'nama_merek'    =>  'BARACUDDA',
            ],
            [
                'kode_merek'    =>  'JYK',
                'nama_merek'    =>  'JOYKO',
            ],
        ];
        DB::table('merek')->insert($data);
    }
}
