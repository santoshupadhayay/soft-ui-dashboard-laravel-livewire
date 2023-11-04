<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public $table = 'quizs';
    public $guarded = [];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class,'chapter_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class,'quiz_id');
    }

    public static function questionsWithOptions($id)
    {
        $questions = Question::where('quiz_id',$id)->get();
        foreach($questions as $q){
            $options = QuestionOption::where('question_id', $q->id)->get();
            $q->options= $options;
        }
        return $questions;
    }
    

    
}
