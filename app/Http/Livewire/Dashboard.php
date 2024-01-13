<?php

namespace App\Http\Livewire;

use App\Models\Stream;
use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\Registration;
use Livewire\Component;
use DB;

class Dashboard extends Component
{
    public function render()
    {
        $streamsCount = Stream::pluck('id')->count();
        $chaptersCount = Chapter::pluck('id')->count();
        $quizsCount = Quiz::pluck('id')->count();
        $regCount = Registration::pluck('id')->count();

        $userByMonth = Registration::select(DB::raw("DATE_FORMAT(created_at, '%b %y') AS month"),DB::raw('COUNT(*) AS registration_count'))
        ->groupBy(['month'])->get();  

        $dataForGraph['labels'] = [];
        $dataForGraph['values'] = [];
        foreach($userByMonth as $month){
            array_push($dataForGraph['labels'], $month->month);
            array_push($dataForGraph['values'], $month->registration_count);
        }   

        $streamUsers = Registration::select(DB::raw("sum(registrations.id) as total"),'s.name')
        ->leftJoin('streams as s', 's.id', 'registrations.stream_id')
        ->groupBy(['s.name'])->get();

        return view('livewire.dashboard')->with(compact('streamsCount','chaptersCount','quizsCount','regCount', 'streamUsers','dataForGraph'));
    }
}
