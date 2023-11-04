<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use App\Models\Stream;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use DB;

class AddQuiz extends Component
{
    public function render()
    {
        $quizs = Quiz::all();
        $chapters = Chapter::all();
        return view('livewire.quizs.addQuiz')->with(compact('quizs','chapters'));
    }

    public function saveQuiz(Request $request)
    {
        try{
            $quiz = new Quiz();
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
            Log::error("saveQuiz : ".$e->getMessage());
            return redirect()->back();

        }

    }

    public function addQuestion(Request $request)
    {
        try{
            DB::beginTransaction();
            // dd($request->all());
            $question = new Question();
            $data = [
                'quesion' => $request->name,
                'status' => isset($request->status) ? true : false,
                'quiz_id' => $request->id,
                'description' => $request->description,
            ];
            $question->fill($data);
            if($question->save()){
                foreach($request->optionsText as $key => $opt){
                    // dd($opt, $request->all());
                    $option = new QuestionOption();
                    $data = [
                        'question_id' => $question->id,
                        'option' => $opt,
                        'is_correct' => $opt ==  $request->optionsCorrect ? true : false
                    ];
                    $option->fill($data);
                    $option->save();
                }
            }
            DB::commit();
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            Log::error("saveQuiz : ".$e->getMessage());
            return redirect()->back();

        }

    }

    public function removeQuestion(Request $request,$id)
    {
        try{
            $question = Question::where('id',$id)->delete();
            return redirect()->back();
        }catch(Exception $e){
            Log::error("removeQuestion : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
