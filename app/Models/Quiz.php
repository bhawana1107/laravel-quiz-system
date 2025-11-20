<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable = [
        'name',
        'category_id',
    ];

    function category(){
        return $this->belongsTo(Category::class);
    }

    function mcqs(){
        return $this->hasMany(MCQ::class);
    }  
    
    function records(){
        return $this->hasMany(Record::class);
    }
}
