<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use App\Models\Quiz;
use Illuminate\Http\Request;

class Quizs extends Component
{
    public function render()
    {
        $quizs = Quiz::all();
        return view('livewire.quizs.quizs')->with(compact('quizs'));
    } 
    public function deleteQuiz(Request $request, $id)
    {
        try{    
            $quiz = Quiz::where('id',$id)->delete();
            return redirect()->route('quizs');
        }catch(Exception $e){
            Log::error("deleteQuiz : ".$e->getMessage());
            return redirect()->back();
        }

    }
}
