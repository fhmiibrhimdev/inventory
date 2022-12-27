<?php

namespace App\Http\Livewire\KartuStock;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DataBarang;
use App\Models\Persediaan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class KartuStock extends Component
{
    use WithPagination;
    public $searchTerm, $lengthData;
    public $filter_id_barang;
    public $filter_dari_tanggal, $filter_sampai_tanggal;

    public function mount()
    {
        $this->filter_id_barang = 0;
        $this->filter_dari_tanggal = Carbon::now()->startOfMonth()->format('Y-m-d 00:00');
        $this->filter_sampai_tanggal = Carbon::now()->endOfMonth()->format('Y-m-d 23:59');
    }


    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $lengthData = $this->lengthData;
        $barangs = DataBarang::select('id', 'nama_item')->get();

        if ($this->filter_id_barang == 0) {
            $data = '';
        } else if ($this->filter_id_barang > 0) {
            $data = Persediaan::select('tanggal', 'nama_item', 'persediaan.keterangan', 'status', 'qty', DB::raw("SUM(CASE WHEN status = 'Out' THEN -qty ELSE qty END) OVER(ORDER BY tanggal ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS balancing"))
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('tanggal', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.keterangan', 'LIKE', $searchTerm);
                    $query->orWhere('status', 'LIKE', $searchTerm);
                    $query->orWhere('qty', 'LIKE', $searchTerm);
                })
                ->where('id_barang', $this->filter_id_barang)
                ->whereBetween('persediaan.created_at', [$this->filter_dari_tanggal, $this->filter_sampai_tanggal])
                ->orderBy('tanggal', 'ASC')
                ->paginate($lengthData);
        }
        return view('livewire.kartu-stock.kartu-stock', compact('data', 'barangs'))
            ->extends('layouts.apps', ['title' => 'Kartu Stock']);
    }
}
