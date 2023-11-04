<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $table = 'questions';
    public $guarded = [];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class,'question_id');
    }
}
