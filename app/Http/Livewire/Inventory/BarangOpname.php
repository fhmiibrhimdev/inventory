<?php

namespace App\Http\Livewire\Inventory;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DataBarang;
use App\Models\Persediaan;
use Livewire\WithPagination;

class BarangOpname extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $tanggal, $id_barang, $qty, $keterangan, $status, $buku, $fisik, $selisih;
    public $filter_id_barang;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
		$lengthData = $this->lengthData;
        $barangs = DataBarang::select('id', 'nama_item')->get();

        if( $this->filter_id_barang == 0 ) {
            $data = Persediaan::select('persediaan.*', 'data_barang.nama_item')
            ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
            ->where(function($query) use ($searchTerm) {
                $query->where('data_barang.nama_item', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.tanggal', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.qty', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.keterangan', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.buku', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.fisik', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.selisih', 'LIKE', $searchTerm);
            })
            ->whereBetween('persediaan.created_at', [$this->filter_dari_tanggal, $this->filter_sampai_tanggal])
            ->where('persediaan.opname', 'yes')
            ->orderBy('persediaan.id', 'DESC')
            ->paginate($lengthData ?? 5);
        } else if ( $this->filter_id_barang > 0 ) {
            $data = Persediaan::select('persediaan.*', 'data_barang.nama_item')
            ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
            ->where(function($query) use ($searchTerm) {
                $query->where('data_barang.nama_item', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.tanggal', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.qty', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.keterangan', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.buku', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.fisik', 'LIKE', $searchTerm);
                $query->orWhere('persediaan.selisih', 'LIKE', $searchTerm);
            })
            ->where('data_barang.id', $this->filter_id_barang)
            ->whereBetween('persediaan.created_at', [$this->filter_dari_tanggal, $this->filter_sampai_tanggal])
            ->where('persediaan.opname', 'yes')
            ->orderBy('persediaan.id', 'DESC')
            ->paginate($lengthData ?? 5);
        }

        if( $this->id_barang ) {
            $this->buku = DataBarang::select('stock')->where('id', $this->id_barang)->first()->stock;
        }

        return view('livewire.inventory.barang-opname', compact('data', 'barangs'))
        ->extends('layouts.apps', ['title' => 'Persediaan - Barang Opname']);;
    }
    
    public function mount()
    {
        $this->tanggal = date('Y-m-d H:i');
        $this->id_barang = DataBarang::min('id');
        $this->keterangan = 'Opname';
        $this->filter_dari_tanggal = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->filter_sampai_tanggal = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->filter_id_barang = 0;

        if( $this->id_barang ) {
            $this->buku = DataBarang::select('stock')->where('id', $this->id_barang)->first()->stock;
            $this->fisik = DataBarang::select('stock')->where('id', $this->id_barang)->first()->stock;
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
    private function resetInputFields()
    {
        $this->id_barang = DataBarang::min('id');
        $this->keterangan = 'Opname';

        if( $this->id_barang ) {
            $this->buku = DataBarang::select('stock')->where('id', $this->id_barang)->first()->stock;
            $this->fisik = DataBarang::select('stock')->where('id', $this->id_barang)->first()->stock;
        }
    }
    
    private function validateInput()
    {
        $this->validate([
            'tanggal'       => 'required',
            'id_barang'     => 'required',
            'keterangan'    => 'required',
            'buku'          => 'required',
            'fisik'         => 'required',
        ]);
    }
    
    public function store()
    {
        $this->validateInput();

        $fisik  = $this->fisik;
        $buku   = $this->buku;

        $selisih = $fisik - $buku;

        if( $selisih > 0 ) {
            $status = 'In';
        } else {
            $status = 'Out';
        }

        Persediaan::create([
            'tanggal'       => $this->tanggal,
            'id_barang'     => $this->id_barang,
            'qty'           => abs($selisih),
            'keterangan'    => $this->keterangan,
            'buku'          => $this->buku,
            'fisik'         => $this->fisik,
            'selisih'       => $selisih,
            'opname'        => 'yes',
            'status'        => $status,
        ]);

        DataBarang::where('id', $this->id_barang)->update([
            'stock' => $this->fisik
        ]);
        $this->successInsert();
    }
    
    public function deleteConfirm($id)
    {
        $this->idRemoved = $id;
        $this->dispatchBrowserEvent('swal');
    }
    
    public function delete()
    {
        $dataPersediaan = Persediaan::select('id_barang', 'selisih')->where('id', $this->idRemoved)->first();
        $id_barang = $dataPersediaan->id_barang;
        $selisih = $dataPersediaan->selisih;
        $stock_barang = DataBarang::select('stock')->where('id', $id_barang)->first()->stock;
        $stock_sekarang = $stock_barang - $selisih;
        DataBarang::where('id', $id_barang)->update([
            'stock'     => $stock_sekarang
        ]);

        $data = Persediaan::findOrFail($this->idRemoved);
        $data->delete();
    }
    
    private function successInsert()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Successfully!', 
            'text' => 'Data Inserted Successfully!.'
        ]);
        $this->resetInputFields();
        $this->emit('dataStore');
    }
    
    private function successUpdate()
    {
        $this->updateMode = false;
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Successfully!', 
            'text' => 'Data Updated Successfully!.'
        ]);
        $this->resetInputFields();
        $this->emit('dataStore');
    }
}

