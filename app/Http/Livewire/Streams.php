<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stream;
use Illuminate\Http\Request;

class Streams extends Component
{
    public function render()
    {
        $streams = Stream::all();
        return view('livewire.streams.streams')->with(compact('streams'));
    } 
    public function deleteStream(Request $request, $id)
    {
        try{    
            $stream = Stream::where('id',$id)->delete();
            return redirect()->route('streams');
        }catch(Exception $e){
            Log::error("deleteStream : ".$e->getMessage());
            return redirect()->back();
        }

    }
}
