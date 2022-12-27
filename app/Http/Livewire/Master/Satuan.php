<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Satuan as ModelsSatuan;

class Satuan extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_satuan, $nama_satuan;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $lengthData = $this->lengthData;

        $data = ModelsSatuan::where('kode_satuan', 'LIKE', $searchTerm)
            ->orWhere('nama_satuan', 'LIKE', $searchTerm)
            ->orderBy('id', 'DESC')
            ->paginate($lengthData);

        return view('livewire.master.satuan', compact('data'))
            ->extends('layouts.apps', ['title' => 'Mater Data - Satuan']);;
    }

    public function mount()
    {
        $this->kode_satuan = '';
        $this->nama_satuan = '';
    }

    private function resetInputFields()
    {
        $this->kode_satuan = '';
        $this->nama_satuan = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function validateInput()
    {
        $this->validate([
            'kode_satuan'  => 'required',
            'nama_satuan'  => 'required',
        ]);
    }

    public function store()
    {
        $this->validateInput();
        ModelsSatuan::create([
            'kode_satuan'  => $this->kode_satuan,
            'nama_satuan'  => $this->nama_satuan,
        ]);
        $this->alertSuccess('insert');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsSatuan::where('id', $id)->first();
        $this->dataId = $id;
        $this->kode_satuan = $data->kode_satuan;
        $this->nama_satuan = $data->nama_satuan;
    }

    public function update()
    {
        $this->validateInput();

        if ($this->dataId) {
            $data = ModelsSatuan::findOrFail($this->dataId);
            $data->update([
                'kode_satuan'  => $this->kode_satuan,
                'nama_satuan'  => $this->nama_satuan,
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
        $data = ModelsSatuan::findOrFail($this->idRemoved);
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
