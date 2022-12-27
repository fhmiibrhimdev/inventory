<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rak as ModelsRak;

class Rak extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_rak, $nama_rak;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $lengthData = $this->lengthData;

        $data = ModelsRak::where('kode_rak', 'LIKE', $searchTerm)
            ->orWhere('nama_rak', 'LIKE', $searchTerm)
            ->orderBy('id', 'DESC')
            ->paginate($lengthData);

        return view('livewire.master.rak', compact('data'))
            ->extends('layouts.apps', ['title' => 'Mater Data - Rak']);;
    }

    public function mount()
    {
        $this->kode_rak = '';
        $this->nama_rak = '';
    }

    private function resetInputFields()
    {
        $this->kode_rak = '';
        $this->nama_rak = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function validateInput()
    {
        $this->validate([
            'kode_rak'  => 'required',
            'nama_rak'  => 'required',
        ]);
    }

    public function store()
    {
        $this->validateInput();
        ModelsRak::create([
            'kode_rak'  => $this->kode_rak,
            'nama_rak'  => $this->nama_rak,
        ]);
        $this->alertSuccess('insert');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsRak::where('id', $id)->first();
        $this->dataId = $id;
        $this->kode_rak = $data->kode_rak;
        $this->nama_rak = $data->nama_rak;
    }

    public function update()
    {
        $this->validateInput();

        if ($this->dataId) {
            $data = ModelsRak::findOrFail($this->dataId);
            $data->update([
                'kode_rak'  => $this->kode_rak,
                'nama_rak'  => $this->nama_rak,
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
        $data = ModelsRak::findOrFail($this->idRemoved);
        $data->delete();
    }

    private function alertSuccess($status)
    {
        switch ($status) {
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
}
