<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    public $timestamps = false; 

    protected $fillable = ['title', 'description'];

    // Explicitly define keys to match Supabase schema
    public function questions() 
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public function results() 
    {
        return $this->hasMany(QuizResult::class, 'quiz_id', 'id');
    }
}