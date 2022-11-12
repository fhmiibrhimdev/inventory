<?php

namespace App\Http\Livewire\Master;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;
use Livewire\WithPagination;

class Kategori extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_kategori, $nama_kategori;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $lengthData = $this->lengthData;
    
        $data = ModelsKategori::where('kode_kategori', 'LIKE', $searchTerm)
                    ->orWhere('nama_kategori', 'LIKE', $searchTerm)
                    ->orderBy('id', 'DESC')
                    ->paginate($lengthData);
    
        return view('livewire.master.kategori', compact('data'))
        ->extends('layouts.apps', ['title' => 'Mast Data - Kategori']);;
    }
    
    public function mount()
    {
        $this->kode_kategori = '';
        $this->nama_kategori = '';
    }
    
    private function resetInputFields()
    {
        $this->kode_kategori = '';
        $this->nama_kategori = '';
    }
    
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
    private function validateInput()
    {
        $this->validate([
            'kode_kategori'  => 'required',
            'nama_kategori'  => 'required'
        ]);
    }
    
    public function store()
    {
        $this->validateInput();
        ModelsKategori::create([
            'kode_kategori'  => $this->kode_kategori,
            'nama_kategori'  => $this->kode_kategori,
        ]);
        $this->successInsert();
    }
    
    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsKategori::where('id',$id)->first();
        $this->dataId = $id;
        $this->kode_kategori = $data->kode_kategori;
        $this->nama_kategori = $data->nama_kategori;
    }
    
    public function update()
    {
        $this->validateInput();
    
        if ($this->dataId) {
            $data = ModelsKategori::findOrFail($this->dataId);
            $data->update([
                'kode_kategori'  => $this->kode_kategori,
                'nama_kategori'  => $this->nama_kategori,
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
        $data = ModelsKategori::findOrFail($this->idRemoved);
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
