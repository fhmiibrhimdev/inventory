<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RakSeeder extends Seeder
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
                'kode_rak'    =>  'R001',
                'nama_rak'    =>  'RAK-001',
            ],
            [
                'kode_rak'    =>  'R002',
                'nama_rak'    =>  'RAK-002',
            ],
            [
                'kode_rak'    =>  'R003',
                'nama_rak'    =>  'RAK-003',
            ],
            [
                'kode_rak'    =>  'R004',
                'nama_rak'    =>  'RAK-004',
            ],
            [
                'kode_rak'    =>  'R005',
                'nama_rak'    =>  'RAK-005',
            ],
        ];
        DB::table('rak')->insert($data);
    }
}
