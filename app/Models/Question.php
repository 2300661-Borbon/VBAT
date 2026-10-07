<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'text',
        'question_text',
        'choices',
        'options',
        'correct_answer'
    ];

    protected $casts = [
        'choices' => 'array',
        'options' => 'array',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    /**
     * Get clean choices array without relationship method collisions.
     */
    public function getFormattedChoicesAttribute(): array
    {
        $raw = $this->attributes['choices'] ?? $this->attributes['options'] ?? [];

        if (is_string($raw)) {
            $raw = json_decode($raw, true) ?? [];
        }

        if (!is_array($raw)) {
            return [];
        }

        return array_values(array_map(function ($item) {
            if (is_array($item)) {
                return (string) ($item['text'] ?? $item['option'] ?? $item['label'] ?? implode('', $item));
            }
            return (string) $item;
        }, $raw));
    }

    /**
     * Verify submitted answer against correct_answer column.
     */
    public function isCorrect($submittedAnswer): bool
    {
        if (is_null($submittedAnswer) || $submittedAnswer === '') {
            return false;
        }

        $clean = function ($str) {
            if (!is_string($str) && !is_numeric($str)) return '';
            $s = (string) $str;
            $s = str_replace(["\xc2\xa0", "\u{00A0}", "\r", "\n", "’", "‘", "“", "”"], [' ', ' ', '', '', "'", "'", '"', '"'], $s);
            return mb_strtolower(trim(preg_replace('/\s+/', ' ', $s)));
        };

        $choices = array_values($this->formatted_choices);
        $cleanChoices = array_map($clean, $choices);

        $submittedRaw = (string) $submittedAnswer;
        $correctRaw = (string) $this->correct_answer;

        $submittedClean = $clean($submittedRaw);
        $correctClean = $clean($correctRaw);

        // 1. Direct text match
        if ($submittedClean !== '' && $correctClean !== '' && $submittedClean === $correctClean) {
            return true;
        }

        // Identify submitted choice index
        $submittedIdx = -1;
        $submittedText = $submittedClean;
        if (is_numeric($submittedRaw) && isset($choices[(int)$submittedRaw])) {
            $submittedIdx = (int) $submittedRaw;
            $submittedText = $cleanChoices[$submittedIdx] ?? $submittedClean;
        } else {
            $idx = array_search($submittedClean, $cleanChoices, true);
            if ($idx !== false) {
                $submittedIdx = $idx;
            }
        }

        // Identify correct choice index
        $correctIdx = -1;
        $correctText = $correctClean;
        $letterMap = ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3, 'e' => 4];

        if (is_numeric($correctRaw)) {
            $num = (int) $correctRaw;
            if (isset($choices[$num])) {
                $correctIdx = $num;
                $correctText = $cleanChoices[$num] ?? $correctClean;
            } elseif (isset($choices[$num - 1])) {
                $correctIdx = $num - 1;
                $correctText = $cleanChoices[$num - 1] ?? $correctClean;
            }
        } elseif (strlen($correctClean) === 1 && isset($letterMap[$correctClean])) {
            $correctIdx = $letterMap[$correctClean];
            $correctText = $cleanChoices[$correctIdx] ?? $correctClean;
        } else {
            $idx = array_search($correctClean, $cleanChoices, true);
            if ($idx !== false) {
                $correctIdx = $idx;
            }
        }

        // 2. Choice index match
        if ($submittedIdx !== -1 && $correctIdx !== -1 && $submittedIdx === $correctIdx) {
            return true;
        }

        // 3. Resolved text match
        if ($submittedText !== '' && $correctText !== '' && $submittedText === $correctText) {
            return true;
        }

        // 4. Substring match
        if ($submittedText !== '' && $correctText !== '' && (str_contains($submittedText, $correctText) || str_contains($correctText, $submittedText))) {
            return true;
        }

        return false;
    }
}