<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jenis as ModelsJenis;

class Jenis extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_jenis, $nama_jenis;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $lengthData = $this->lengthData;
    
        $data = ModelsJenis::where('kode_jenis', 'LIKE', $searchTerm)
                    ->orWhere('nama_jenis', 'LIKE', $searchTerm)
                    ->orderBy('id', 'DESC')
                    ->paginate($lengthData);
    
        return view('livewire.master.jenis', compact('data'))
        ->extends('layouts.apps', ['title' => 'Mater Data - Jenis']);;
    }
    
    public function mount()
    {
        $this->kode_jenis = '';
        $this->nama_jenis = '';
    }
    
    private function resetInputFields()
    {
        $this->kode_jenis = '';
        $this->nama_jenis = '';
    }
    
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
    private function validateInput()
    {
        $this->validate([
            'kode_jenis'  => 'required',
            'nama_jenis'  => 'required',
        ]);
    }
    
    public function store()
    {
        $this->validateInput();
        ModelsJenis::create([
            'kode_jenis'  => $this->kode_jenis,
            'nama_jenis'  => $this->nama_jenis,
        ]);
        $this->successInsert();
    }
    
    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsJenis::where('id',$id)->first();
        $this->dataId = $id;
        $this->kode_jenis = $data->kode_jenis;
        $this->nama_jenis = $data->nama_jenis;
    }
    
    public function update()
    {
        $this->validateInput();
    
        if ($this->dataId) {
            $data = ModelsJenis::findOrFail($this->dataId);
            $data->update([
                'kode_jenis'  => $this->kode_jenis,
                'nama_jenis'  => $this->nama_jenis,
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
        $data = ModelsJenis::findOrFail($this->idRemoved);
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
