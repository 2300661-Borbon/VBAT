<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function userDashboard()
    {
        $userId = Auth::id();

        $userResults = QuizResult::where('user_id', $userId)
            ->with('quiz')
            ->orderBy('id', 'desc')
            ->get();

        $quizzes = Quiz::with(['questions' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->get()->map(function ($quiz) {
            $quiz->questions->transform(function ($question) {
                $question->choices_array = $question->formatted_choices ?? $question->choices ?? [];
                $question->question_title = $question->text ?? $question->question_text ?? $question->title;
                return $question;
            });
            return $quiz;
        });

        return view('user-dash', compact('userResults', 'quizzes'));
    }

    public function storeResult(Request $request)
    {
        $validated = $request->validate([
            'quiz_id'         => 'required|exists:quizzes,id',
            'quiz_name'       => 'required|string',
            'answers'         => 'nullable|array',
            'score'           => 'nullable|integer|min:0',
            'total_questions' => 'nullable|integer|min:1',
        ]);

        $quiz = Quiz::with(['questions' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->findOrFail($validated['quiz_id']);

        $totalQuestions = $quiz->questions->count();
        $score = 0;

        if (!empty($validated['answers']) && is_array($validated['answers'])) {
            foreach ($quiz->questions as $index => $question) {
                $submitted = $validated['answers'][$question->id] 
                          ?? $validated['answers'][(string)$question->id] 
                          ?? $validated['answers'][$index] 
                          ?? $validated['answers'][(string)$index] 
                          ?? null;

                if (is_array($submitted)) {
                    $submitted = $submitted['text'] ?? $submitted['option'] ?? $submitted['label'] ?? $submitted['value'] ?? reset($submitted);
                }

                if ($submitted !== null && method_exists($question, 'isCorrect')) {
                    if ($question->isCorrect($submitted)) {
                        $score++;
                    }
                }
            }
        } else {
            $score = $validated['score'] ?? 0;
            $totalQuestions = $validated['total_questions'] ?? max($totalQuestions, 1);
        }

        $result = QuizResult::create([
            'user_id'         => Auth::id(),
            'quiz_id'         => $quiz->id,
            'quiz_name'       => $validated['quiz_name'],
            'score'           => $score,
            'total_questions' => $totalQuestions,
        ]);

        $result->load('quiz');

        return response()->json([
            'message' => 'Result saved successfully.',
            'score'   => $score,
            'total'   => $totalQuestions,
            'result'  => $result
        ]);
    }
}