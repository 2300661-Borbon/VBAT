<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'quiz_name',
        'score',
        'total_questions',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}