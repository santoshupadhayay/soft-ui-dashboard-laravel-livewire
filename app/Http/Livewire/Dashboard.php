<?php

namespace App\Http\Livewire;

use App\Models\Stream;
use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\Registration;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $streamsCount = Stream::pluck('id')->count();
        $chaptersCount = Chapter::pluck('id')->count();
        $quizsCount = Quiz::pluck('id')->count();
        $regCount = Registration::pluck('id')->count();
        return view('livewire.dashboard')->with(compact('streamsCount','chaptersCount','quizsCount','regCount'));
    }
}
