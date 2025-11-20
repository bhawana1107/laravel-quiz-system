<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'correct_ans'
    ];
    function quiz(){
        return $this->belongsTo(Quiz::class);
    }
   
}
