<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Counter extends Component
{
    public int $counter;

    public function mount(?int $initial=0) { 
        $this->counter = $initial; 
    }

    public function increment()
    {
        $this->counter++;
    }

    public function decrement()
    {
        $this->counter--;
    }
    
    public function render()
    {
        return view('livewire.utils.counter');
    }
}
