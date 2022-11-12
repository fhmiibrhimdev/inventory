<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DataBarang as ModelsDataBarang;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Merek;
use App\Models\Rak;
use App\Models\Satuan;

class DataBarang extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_item, $nama_item, $keterangan;
    public $id_jenis, $id_merek, $id_satuan, $id_kategori, $id_rak;
    public $edit_id_jenis, $edit_id_merek, $edit_id_satuan, $edit_id_kategori, $edit_id_rak;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $lengthData = $this->lengthData;
    
        $jenis = Jenis::select('id', 'nama_jenis')->get();
        $mereks = Merek::select('id', 'nama_merek')->get();
        $satuans = Satuan::select('id', 'nama_satuan')->get();
        $kategoris = Kategori::select('id', 'nama_kategori')->get();
        $raks = Rak::select('id', 'nama_rak')->get();

        $data = ModelsDataBarang::select('data_barang.id', 'data_barang.kode_item', 'data_barang.nama_item', 'data_barang.keterangan', 'data_barang.stock', 'jenis.nama_jenis', 'merek.nama_merek', 'satuan.nama_satuan', 'kategori.kode_kategori', 'rak.nama_rak')
                    ->join('jenis', 'jenis.id', 'data_barang.id_jenis')
                    ->join('merek', 'merek.id', 'data_barang.id_merek')
                    ->join('satuan', 'satuan.id', 'data_barang.id_satuan')
                    ->join('kategori', 'kategori.id', 'data_barang.id_kategori')
                    ->join('rak', 'rak.id', 'data_barang.id_rak')
                    ->where(function($query) use ($searchTerm) {
                        $query->where('data_barang.kode_item', 'LIKE', $searchTerm);
                        $query->orWhere('data_barang.nama_item', 'LIKE', $searchTerm);
                        $query->orWhere('jenis.nama_jenis', 'LIKE', $searchTerm);
                        $query->orWhere('merek.nama_merek', 'LIKE', $searchTerm);
                        $query->orWhere('satuan.nama_satuan', 'LIKE', $searchTerm);
                        $query->orWhere('kategori.kode_kategori', 'LIKE', $searchTerm);
                        $query->orWhere('rak.nama_rak', 'LIKE', $searchTerm);
                        $query->orWhere('data_barang.keterangan', 'LIKE', $searchTerm);
                        $query->orWhere('data_barang.stock', 'LIKE', $searchTerm);
                    })
                    ->orderBy('id', 'DESC')
                    ->paginate($lengthData);
    
        return view('livewire.master.data-barang', compact('data', 'jenis', 'mereks', 'satuans', 'kategoris', 'raks'))
        ->extends('layouts.apps', ['title' => 'Master Data - Barang']);;
    }
    
    public function mount()
    {
        $this->kode_item = '';
        $this->nama_item = '';
        $this->id_jenis  = Jenis::min('id');
        $this->id_merek  = Merek::min('id');
        $this->id_satuan  = Satuan::min('id');
        $this->id_kategori  = Kategori::min('id');
        $this->id_rak  = Rak::min('id');
        $this->keterangan = '-';
    }
    
    private function resetInputFields()
    {
        $this->kode_item = '';
        $this->nama_item = '';
    }
    
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
    private function validateInput()
    {
        $this->validate([
            'kode_item'  => 'required',
            'nama_item'  => 'required',
        ]);
    }
    
    public function store()
    {
        $this->validateInput();
        ModelsDataBarang::create([
            'kode_item'     => $this->kode_item,
            'nama_item'     => $this->nama_item,
            'id_jenis'      => $this->id_jenis,
            'id_merek'      => $this->id_merek,
            'id_satuan'     => $this->id_satuan,
            'id_kategori'   => $this->id_kategori,
            'id_rak'        => $this->id_rak,
            'keterangan'    => $this->keterangan,
            'stock'         => '0',
        ]);
        $this->successInsert();
    }
    
    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsDataBarang::where('id',$id)->first();
        $this->dataId = $id;
        $this->kode_item = $data->kode_item;
        $this->nama_item = $data->nama_item;
        $this->id_jenis = $data->id_jenis;
        $this->id_merek = $data->id_merek;
        $this->id_satuan = $data->id_satuan;
        $this->id_kategori = $data->id_kategori;
        $this->id_rak = $data->id_rak;
        $this->keterangan = $data->keterangan;
    }
    
    public function update()
    {
        $this->validateInput();
    
        if ($this->dataId) {
            $data = ModelsDataBarang::findOrFail($this->dataId);
            $data->update([
                'kode_item'     => $this->kode_item,
                'nama_item'     => $this->nama_item,
                'id_jenis'      => $this->id_jenis,
                'id_merek'      => $this->id_merek,
                'id_satuan'     => $this->id_satuan,
                'id_kategori'   => $this->id_kategori,
                'id_rak'        => $this->id_rak,
                'keterangan'    => $this->keterangan,
                'stock'         => '0',
            ]);
            $this->successUpdate();
        }
    }
    
    public function deleteConfirm($id)
    {
        $this->idRemoved = $id;
        $this->dispatchBrowserEvent('swal');
    }
    
    public function delete()
    {
        $data = ModelsDataBarang::findOrFail($this->idRemoved);
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
