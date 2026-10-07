<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    // ==========================================
    // USER MANAGEMENT
    // ==========================================

    public function index()
    {
        $users = User::where('role', '!=', 'admin')->oldest()->get();
        $activeUsersCount = User::where('role', '!=', 'admin')
                                ->whereNotNull('email_verified_at')
                                ->count();

        return view('admin.users', compact('users', 'activeUsersCount'));
    }

    public function updateEmail(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update(['email' => $request->email]);

        return back()->with('success', "Email for {$user->name} has been updated successfully.");
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', "Password for {$user->name} has been reset successfully.");
    }

    public function deleteUser(User $user)
    {
        $name = $user->name;
        $user->delete();

        return back()->with('success', "User {$name} has been deleted successfully.");
    }

    // ==========================================
    // QUIZ & QUESTION MANAGEMENT (ADMIN)
    // ==========================================

    public function manageQuizzes()
    {
        $quizzes = Quiz::with('questions')->get();
        return view('admin.quiz-task', compact('quizzes'));
    }

    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
        ]);

        DB::transaction(function () use ($validated) {
            $quiz = Quiz::create(['title' => $validated['title']]);

            foreach ($validated['questions'] as $q) {
                $quiz->questions()->create([
                    'text' => $q['text'],
                    'choices' => $q['choices'], // Automatically cast to JSON in the Model
                    'correct_answer' => $q['correct_answer'],
                ]);
            }
        });

        return response()->json(['success' => true, 'message' => 'Quiz created successfully.']);
    }

    public function updateQuiz(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.id' => 'nullable|integer',
            'questions.*.text' => 'required|string',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
        ]);

        DB::transaction(function () use ($quiz, $validated) {
            $quiz->update(['title' => $validated['title']]);

            $submittedIds = collect($validated['questions'])->pluck('id')->filter()->toArray();
            
            // Delete questions that were removed in the UI
            $quiz->questions()->whereNotIn('id', $submittedIds)->delete();

            foreach ($validated['questions'] as $q) {
                $quiz->questions()->updateOrCreate(
                    ['id' => $q['id'] ?? null, 'quiz_id' => $quiz->id],
                    [
                        'text' => $q['text'],
                        'choices' => $q['choices'],
                        'correct_answer' => $q['correct_answer'],
                    ]
                );
            }
        });

        return response()->json(['success' => true, 'message' => 'Quiz updated successfully.']);
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $quiz->delete();

        return response()->json(['success' => true, 'message' => 'Quiz deleted successfully.']);
    }
}