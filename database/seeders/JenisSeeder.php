<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
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
                'kode_jenis'    =>  'MKN',
                'nama_jenis'    =>  'MAKANAN',
            ],
            [
                'kode_jenis'    =>  'MNM',
                'nama_jenis'    =>  'MINUMAN',
            ],
            [
                'kode_jenis'    =>  'DAPUR',
                'nama_jenis'    =>  'DAPUR',
            ],
            [
                'kode_jenis'    =>  'FSHN',
                'nama_jenis'    =>  'FASHION',
            ],
            [
                'kode_jenis'    =>  'GMNG',
                'nama_jenis'    =>  'GAMING',
            ],
            [
                'kode_jenis'    =>  'HNDPHN',
                'nama_jenis'    =>  'HANDPHONE',
            ],
            [
                'kode_jenis'    =>  'CMRA',
                'nama_jenis'    =>  'CAMERA',
            ],
            [
                'kode_jenis'    =>  'OTMTF',
                'nama_jenis'    =>  'OTOMOTIF',
            ],
            [
                'kode_jenis'    =>  'KMPTR',
                'nama_jenis'    =>  'KOMPUTER',
            ],
            [
                'kode_jenis'    =>  'LPTP',
                'nama_jenis'    =>  'LAPTOP',
            ],
            [
                'kode_jenis'    =>  'OLHRGA',
                'nama_jenis'    =>  'OLAHRAGA',
            ],
            [
                'kode_jenis'    =>  'PRKTNGN',
                'nama_jenis'    =>  'PERTUKANGAN',
            ],
        ];
        DB::table('jenis')->insert($data);
    }
}
