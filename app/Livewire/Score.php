<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;

class Score extends Component
{
    public function render()
    {
        return view('livewire.score', [
            'results' => Result::orderBy('created_at', 'desc')->get()
        ]);
    }
}
