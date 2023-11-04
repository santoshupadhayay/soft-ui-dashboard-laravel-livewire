<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $table = 'chapters';
    public $guarded = [];

    public function stream()
    {
        return $this->belongsTo(Stream::class,'stream_id');
    }
}
