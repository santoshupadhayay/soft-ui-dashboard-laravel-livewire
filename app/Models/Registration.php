<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    public $table = 'registrations';
    public $guarded = [];

    public function stream()
    {
        return $this->belongsTo(Stream::class,'stream_id');
    }

}
