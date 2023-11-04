<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use Illuminate\Http\Request;

class Chapters extends Component
{
    public function render()
    {
        $chapters = Chapter::all();
        return view('livewire.chapters.chapters')->with(compact('chapters'));
    } 
    public function deleteChapter(Request $request, $id)
    {
        try{    
            $chapter = Chapter::where('id',$id)->delete();
            return redirect()->route('chapters');
        }catch(Exception $e){
            Log::error("deleteChapter : ".$e->getMessage());
            return redirect()->back();
        }

    }
}
