<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
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
                'kode_kategori'    =>  'UMUM',
                'nama_kategori'    =>  'BARANG-UMUM',
            ],
            [
                'kode_kategori'    =>  'EKONOMI',
                'nama_kategori'    =>  'BARANG-EKONOMI',
            ],
            [
                'kode_kategori'    =>  'PUBLIK',
                'nama_kategori'    =>  'BARANG-PUBLIK',
            ],
            [
                'kode_kategori'    =>  'MODAL',
                'nama_kategori'    =>  'BARANG-MODAL',
            ],
            [
                'kode_kategori'    =>  'KONSUMEN',
                'nama_kategori'    =>  'BARANG-KONSUMEN',
            ],
        ];
        DB::table('kategori')->insert($data);
    }
}
