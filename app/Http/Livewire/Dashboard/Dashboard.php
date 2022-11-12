<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        if( Auth::user()->hasRole('admin') ){
            return view('livewire.dashboard.dashboard-admin')
            ->extends('layouts.apps', ['title' => 'Dashboard']);
        } else if ( Auth::user()->hasRole('user') ) {
            return view('livewire.dashboard.dashboard-user')
            ->extends('layouts.apps', ['title' => 'Dashboard']);
        }

    }
}
