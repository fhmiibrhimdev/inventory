<?php

namespace App\Http\Livewire\Laporan;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluar extends Component
{
    public function render()
    {
        return view('livewire.laporan.barang-keluar');
    }

    public function exportExcel($id_barang, $dari_tanggal, $sampai_tanggal)
    {
        if ($id_barang == 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Out')
                ->orderBy('persediaan.id', 'DESC')
                ->get()
                ->toArray();
        } else if ($id_barang > 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where('data_barang.id', $id_barang)
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Out')
                ->orderBy('persediaan.id', 'DESC')
                ->get()
                ->toArray();
        }

        $fileName = "INV/" . date("Ymd") . "/BARANG-KELUAR" . ".xls";
        if ($data) 
        {
            function filterData(&$str)
            {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            }
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: application/vnd.ms-excel");
            $flag = false;
            foreach ($data as $row) 
            {
                if (!$flag) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $flag = true;
                }
                array_walk($row, __NAMESPACE__ . '\filterData');
                echo implode("\t", array_values($row)) . "\n";
            }
            exit;
        }
    }

    public function exportPDF($id_barang, $dari_tanggal, $sampai_tanggal)
    {
        if ($id_barang == 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Out')
                ->orderBy('persediaan.id', 'DESC')
                ->get();
        } else if ($id_barang > 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where('data_barang.id', $id_barang)
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Out')
                ->orderBy('persediaan.id', 'DESC')
                ->get();
        }

        $pdf = Pdf::loadview('livewire.laporan.saldo-awal-item', ['data' => $data, 'no' => 1]);
        return $pdf->download('laporan-pegawai.pdf');
    }
}
