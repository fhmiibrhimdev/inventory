<?php

namespace App\Http\Livewire\SettingUser;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SettingUser extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteConfirmed' => 'delete',
        'activeConfirmed' => 'active',
        'nonActiveConfirmed' => 'nonActive',
    ];
    public $active;
    public $searchTerm, $lengthData;
    public $updateMode = false;
    public $idRemoved = null;
    public $idActive = null;
    public $idNonActive = null;
    protected $paginationTheme = 'bootstrap';

    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
		$lengthData = $this->lengthData;
		
		$data = User::where('name', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orderBy('id', 'ASC')
                    ->paginate($lengthData);

        return view('livewire.setting-user.setting-user', compact('data'))
        ->extends('layouts.apps', ['title' => 'Setting User']);
    }

    public function activeConfirm($idAct)
    {
        $this->idActive = $idAct;
        $this->dispatchBrowserEvent('activeSwal');
    }

    public function active()
    {
        User::findOrFail($this->idActive)->update(array('active' => '1'));
    }

    public function nonActiveConfirm($idNonAct)
    {
        $this->idNonActive = $idNonAct;
        $this->dispatchBrowserEvent('nonActiveSwal');
    }

    public function nonActive()
    {
        User::findOrFail($this->idNonActive)->update(array('active' => '0'));
    }

    public function deleteConfirm($id)
    {
        $this->idRemoved = $id;
        $this->dispatchBrowserEvent('deleteSwal');
    }

    public function delete()
    {
        User::findOrFail($this->idRemoved)->delete();
        RoleUser::where('user_id', $this->idRemoved)->delete();
    }



    
}
