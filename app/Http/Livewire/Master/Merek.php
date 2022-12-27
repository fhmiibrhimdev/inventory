<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Merek as ModelsMerek;

class Merek extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];
    public $kode_merek, $nama_merek;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $lengthData = $this->lengthData;

        $data = ModelsMerek::where('kode_merek', 'LIKE', $searchTerm)
            ->orWhere('nama_merek', 'LIKE', $searchTerm)
            ->orderBy('id', 'DESC')
            ->paginate($lengthData);

        return view('livewire.master.merek', compact('data'))
            ->extends('layouts.apps', ['title' => 'Mater Data - Merek']);;
    }

    public function mount()
    {
        $this->kode_merek = '';
        $this->nama_merek = '';
    }

    private function resetInputFields()
    {
        $this->kode_merek = '';
        $this->nama_merek = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function validateInput()
    {
        $this->validate([
            'kode_merek'  => 'required',
            'nama_merek'  => 'required',
        ]);
    }

    public function store()
    {
        $this->validateInput();
        ModelsMerek::create([
            'kode_merek'  => $this->kode_merek,
            'nama_merek'  => $this->nama_merek,
        ]);
        $this->alertSuccess('insert');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ModelsMerek::where('id', $id)->first();
        $this->dataId = $id;
        $this->kode_merek = $data->kode_merek;
        $this->nama_merek = $data->nama_merek;
    }

    public function update()
    {
        $this->validateInput();

        if ($this->dataId) {
            $data = ModelsMerek::findOrFail($this->dataId);
            $data->update([
                'kode_merek'  => $this->kode_merek,
                'nama_merek'  => $this->nama_merek,
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
        $data = ModelsMerek::findOrFail($this->idRemoved);
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
