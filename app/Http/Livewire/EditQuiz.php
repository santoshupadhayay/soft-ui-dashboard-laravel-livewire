<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use App\Models\Stream;
use App\Models\Quiz;
use Illuminate\Http\Request;

class EditQuiz extends Component
{
    public function render(Request $request)
    {   
        $id = request('id');
        $chapters = Chapter::all();
        $quiz = Quiz::find($id);
        return view('livewire.quizs.editQuiz')->with(compact('quiz','chapters'));
    }

    public function updateQuiz(Request $request)
    {
        try{
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('chapter_files', $fileName, 'public');
                $filenameToStore = '/storage/' . $filePath;
            }
    
            $quiz = Quiz::find($request->id);
            $data = [
                'name' => $request->name,
                'status' => isset($request->status) ? true : false,
                'chapter_id' => $request->chapter_id,
                'description' => $request->description,
            ];
            $quiz->fill($data);
            $quiz->save();
            return redirect()->route('quizs');

        }catch(Exception $e){
            Log::error("updateQuiz : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
