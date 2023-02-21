<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filter extends Component
{
    public $selectedDate = '';

    public function render()
    {
        $this->emit('date-selected', $this->selectedDate);
        return view('livewire.filter');
    }
}
