<?php

namespace App\Http\Livewire\Inventory;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DataBarang;
use App\Models\Persediaan;
use Livewire\WithPagination;

class SaldoAwalItem extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $tanggal, $id_barang, $qty, $keterangan;
    public $filter_dari_tanggal, $filter_sampai_tanggal, $filter_id_barang;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $lengthData = $this->lengthData;

        $barangs    = DataBarang::select('id', 'nama_item')
                        ->get();
        if ($this->filter_id_barang == 0) 
        {
            $data = Persediaan::select('persediaan.*', 'data_barang.nama_item')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('data_barang.nama_item', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.tanggal', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.qty', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.keterangan', 'LIKE', $searchTerm);
                })
                ->whereBetween('persediaan.tanggal', [$this->filter_dari_tanggal, $this->filter_sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->paginate($lengthData ?? 5);
        } else if ($this->filter_id_barang > 0) 
        {
            $data = Persediaan::select('persediaan.*', 'data_barang.nama_item')
                ->join('data_barang', 'data_barang.id', 'persediaan.id_barang')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('data_barang.nama_item', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.tanggal', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.qty', 'LIKE', $searchTerm);
                    $query->orWhere('persediaan.keterangan', 'LIKE', $searchTerm);
                })
                ->where('data_barang.id', $this->filter_id_barang)
                ->whereBetween('persediaan.tanggal', [$this->filter_dari_tanggal, $this->filter_sampai_tanggal])
                ->where('persediaan.status', 'Balance')
                ->orderBy('persediaan.id', 'DESC')
                ->paginate($lengthData ?? 5);
        }

        return view('livewire.inventory.saldo-awal-item', compact('data', 'barangs'))
            ->extends('layouts.apps', ['title' => 'Persediaan - Saldo Awal item']);
    }

    public function mount()
    {
        $this->tanggal              = date('Y-m-d H:i');
        $this->id_barang            = DataBarang::min('id');
        $this->qty                  = '1';
        // $this->filter_dari_tanggal = Carbon::now()->startOfMonth()->format('Y-m-d');
        // $this->filter_sampai_tanggal = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->filter_dari_tanggal  = date('Y-m-d 00:00');
        $this->filter_sampai_tanggal= date('Y-m-d 23:59');
        $this->filter_id_barang     = 0;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        // $this->tanggal = date('Y-m-d H:i');
        $this->qty = '1';
    }

    private function alertStockMinus()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type'      => 'error',
            'message'   => 'Gagal!',
            'text'      => 'Stock minus tidak diperbolehkan!.'
        ]);
        return false;
    }

    private function alertSuccess($status)
    {
        switch ($status) 
        {
            case 'insert':
                $text = 'Data Inserted Successfully!.';
                break;
            case 'update':
                $this->updateMode = false;
                $text = 'Data Updated Successfully!.';
                break;
            default:
                break;
        }
        $this->dispatchBrowserEvent('swal:modal', [
            'type'      => 'success',
            'message'   => 'Successfully!',
            'text'      => $text,
        ]);
        $this->resetInputFields();
        $this->emit('dataStore');
    }

    private function validateInput()
    {
        $this->validate([
            'tanggal'       => 'required',
            'id_barang'     => 'required',
            'qty'           => 'required',
        ]);
    }

    public function store()
    {
        $this->validateInput();

        $stock_terakhir_barang  = DataBarang::where('id', $this->id_barang)
                                    ->first()
                                    ->stock;
        $tambah_stock           = $stock_terakhir_barang + $this->qty;

        if ($tambah_stock < 0) // jika stock pengurangan minus
        { 
            $this->alertStockMinus();
        } else // jika stock pengurangan tidak minus
        { 
            Persediaan::create([
                'tanggal'       => $this->tanggal,
                'id_barang'     => $this->id_barang,
                'qty'           => $this->qty,
                'keterangan'    => 'Saldo awal item',
                'status'        => 'Balance',
            ]);
            DataBarang::where('id', $this->id_barang)
                ->update(array(
                    'stock' => $tambah_stock
                ));
            $this->alertSuccess('insert');
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $data               = Persediaan::where('id', $id)->first();
        $this->dataId       = $id;
        $this->tanggal      = $data->tanggal;
        $this->id_barang    = $data->id_barang;
        $this->qty          = $data->qty;
        $this->keterangan   = $data->keterangan;
    }

    private function logicStock($total_stock_sekarang, $qty_baru, $qty_lama, $id_barang)
    {
        $total          = $qty_baru - $qty_lama; // 10 - 7 = 3
        $total_stock    = $total_stock_sekarang + $total; // 20 + 3 = 23
        if ( $total_stock < 0 ) // jika stock minus
        { 
            $this->alertStockMinus();
        } else 
        { // jika stock tidak minus
            DataBarang::where('id', $id_barang)
                ->update(array(
                    'stock' => $total_stock
                ));
        }
    }

    public function update()
    {
        $this->validateInput();

        $id_barang = Persediaan::where('id', $this->dataId)->first()->id_barang; // ambil id barang
        $total_stock_sekarang = DataBarang::where('id', $id_barang)->first()->stock; // Stock di tb data_barang : 20
        $qty_lama = Persediaan::where('id', $this->dataId)->first()->qty; // Quantity Lama : 7
        $qty_baru = $this->qty; // Quantity Baru : 10

        switch (true) {
            case ((int)$qty_baru > (int)$qty_lama):
            case ((int)$qty_lama > (int)$qty_baru):
                $this->logicStock($total_stock_sekarang, $qty_baru, $qty_lama, $id_barang);
                break;
            default:
                break;
        }

        if ($this->dataId) {
            $data = Persediaan::findOrFail($this->dataId);
            $data->update([
                'tanggal'       => $this->tanggal,
                'id_barang'     => $this->id_barang,
                'qty'           => $this->qty,
                'keterangan'    => 'Saldo awal item',
                'status'        => 'Balance',
            ]);
            $this->alertSuccess('update');
        }
    }

    public function deleteConfirm($id)
    {
        $this->idRemoved = $id;
        $this->dispatchBrowserEvent('swal');
    }

    public function delete()
    {
        $qty_terakhir   = Persediaan::where('id', $this->idRemoved)->first()->qty; // 10
        $id_barang      = Persediaan::where('id', $this->idRemoved)->first()->id_barang;
        $stock_terakhir = DataBarang::where('id', $id_barang)->first()->stock; // Stock : 10

        $total_stock    = $stock_terakhir - $qty_terakhir;

        DataBarang::where('id', $id_barang)
            ->update(array(
                'stock' => $total_stock
            ));

        $data = Persediaan::findOrFail($this->idRemoved);
        $data->delete();
    }
}
