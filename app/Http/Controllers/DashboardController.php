<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();
        $userResults = QuizResult::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user_dashboard', compact('quizzes', 'userResults'));
    }

    public function storeQuizResult(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|integer',
            'quiz_name' => 'required|string',
            'score' => 'required|integer',
            'total_questions' => 'required|integer',
        ]);

        $result = QuizResult::create([
            'user_id' => Auth::id(),
            'quiz_id' => $validated['quiz_id'],
            'quiz_name' => $validated['quiz_name'],
            'score' => $validated['score'],
            'total_questions' => $validated['total_questions'],
        ]);

        return response()->json([
            'success' => true,
            'result' => $result
        ]);
    }
}