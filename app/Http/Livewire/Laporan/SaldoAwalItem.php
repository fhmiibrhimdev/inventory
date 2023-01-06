<?php

namespace App\Http\Livewire\Laporan;

use App\Models\DataBarang;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SaldoAwalItem extends Component
{
    public $id_user, $id_barang;
    public $dari_tanggal, $sampai_tanggal;

    public function render()
    {
        if ( $this->id_user == 'ALL' && $this->id_barang == 'ALL' )
        {
            $data = Persediaan::select('persediaan.id', 'persediaan.tanggal', 'persediaan.keterangan', 'persediaan.qty', 'data_barang.nama_item' ,'users.name')
                        ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                        ->join('users', 'users.id', 'persediaan.id_user')
                        ->where('status', 'Balance')
                        ->whereBetween('tanggal', [$this->dari_tanggal, $this->sampai_tanggal])
                        ->get();

        } else if ( $this->id_user == 'ALL' && $this->id_barang > 0 )
        {
            $data = Persediaan::select('persediaan.id', 'persediaan.tanggal', 'persediaan.keterangan', 'persediaan.qty', 'data_barang.nama_item' ,'users.name')
                        ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                        ->join('users', 'users.id', 'persediaan.id_user')
                        ->where('status', 'Balance')
                        ->where('data_barang.id', $this->id_barang)
                        ->whereBetween('tanggal', [$this->dari_tanggal, $this->sampai_tanggal])
                        ->get();
        } else if ( $this->id_user > 0 && $this->id_barang == 'ALL' )
        {
            $data = Persediaan::select('persediaan.id', 'persediaan.tanggal', 'persediaan.keterangan', 'persediaan.qty', 'data_barang.nama_item' ,'users.name')
                        ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                        ->join('users', 'users.id', 'persediaan.id_user')
                        ->where('status', 'Balance')
                        ->where('persediaan.id_user', $this->id_user)
                        ->whereBetween('tanggal', [$this->dari_tanggal, $this->sampai_tanggal])
                        ->get();
        } else if ( $this->id_user > 0 && $this->id_barang > 0 )
        {
            $data = Persediaan::select('persediaan.id', 'persediaan.tanggal', 'persediaan.keterangan', 'persediaan.qty', 'data_barang.nama_item' ,'users.name')
                        ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                        ->join('users', 'users.id', 'persediaan.id_user')
                        ->where('status', 'Balance')
                        ->where('persediaan.id_user', $this->id_user)
                        ->where('data_barang.id', $this->id_barang)
                        ->whereBetween('tanggal', [$this->dari_tanggal, $this->sampai_tanggal])
                        ->get();
        }

        $users = User::select('id', 'name')->get();
        $barangs = DataBarang::select('id', 'nama_item')->get();

        return view('livewire.laporan.saldo-awal-item', compact('data', 'users', 'barangs'))
            ->extends('layouts.apps', ['title' => 'Laporan Inventory - Saldo Awal Barang']);
    }

    public function mount()
    {
        $this->id_user          = '0';
        $this->id_barang        = '0';
        $this->dari_tanggal     = Carbon::now()->startOfMonth()->toDateTimeLocalString();;
        $this->sampai_tanggal   = Carbon::now()->endOfMonth()->toDateTimeLocalString();;
    }

    public function exportExcel($id_barang, $dari_tanggal, $sampai_tanggal)
    {
        if ($id_barang == 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->get()
                ->toArray();
        } else if ($id_barang > 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%d-%m-%y') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where('data_barang.id', $id_barang)
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->get()
                ->toArray();
        }

        $fileName = "INV/" . date("Ymd") . "/SALDOAWAL" . ".xls";
        if ($data) {
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
                if (!$flag) 
                {
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
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%a, %d %b %Y %h:%m:%s') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->get();
        } else if ($id_barang > 0) 
        {
            $data = Persediaan::select(DB::raw("DATE_FORMAT(tanggal, '%a, %d %b %Y %h:%m:%s') as tanggal"), 'data_barang.nama_item', 'qty', 'persediaan.keterangan')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where('data_barang.id', $id_barang)
                ->whereBetween('persediaan.created_at', [$dari_tanggal, $sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->get();
        }

        $pdf = Pdf::loadview('livewire.laporan.saldo-awal-item', ['data' => $data, 'no' => 1]);
        return $pdf->download('laporan-pegawai.pdf');
    }
}
