<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
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
                'kode_satuan'    =>  'PCS',
                'nama_satuan'    =>  'PCS',
            ],
            [
                'kode_satuan'    =>  'DUS',
                'nama_satuan'    =>  'DUS',
            ],
            [
                'kode_satuan'    =>  'PAK',
                'nama_satuan'    =>  'PAK',
            ],
            [
                'kode_satuan'    =>  'BOX',
                'nama_satuan'    =>  'BOX',
            ],
            [
                'kode_satuan'    =>  'GRAM',
                'nama_satuan'    =>  'GRAM',
            ],
            [
                'kode_satuan'    =>  'KG',
                'nama_satuan'    =>  'KILOGRAM',
            ],
            [
                'kode_satuan'    =>  'GLS',
                'nama_satuan'    =>  'GELAS',
            ],
            [
                'kode_satuan'    =>  'LSN',
                'nama_satuan'    =>  'LUSIN',
            ],
        ];
        DB::table('satuan')->insert($data);
    }
}
