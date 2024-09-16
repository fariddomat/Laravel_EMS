<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\UserQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function show($lessonId)
    {
        $lesson = Lesson::with('quizzes')->findOrFail($lessonId);
        $quizzes = Quiz::where('lesson_id', $lessonId)->get();
        return view('quizzes.show', compact('lesson', 'quizzes'));
    }

    public function submit(Request $request, $lessonId)
    {
        $quizzes = Quiz::where('lesson_id', $lessonId)->get();
        if ($request->quiz) {
            if (count($request->quiz) != $quizzes->count()) {

                return redirect()->back()->withErrors(['message' => ' please fill all fields']);
            } else {

                foreach ($quizzes as $quiz) {
                    $selectedOption = $request->input("quiz.{$quiz->id}");
                    $isCorrect = $selectedOption == $quiz->correct_option;

                    UserQuiz::create([
                        'user_id' => auth()->id(),
                        'quiz_id' => $quiz->id,
                        'selected_option' => $selectedOption,
                        'is_correct' => $isCorrect,
                    ]);
                }
            }
        }else{
            return redirect()->back()->withErrors(['message' => ' please fill all fields']);

        }


        return redirect()->route('lessons.show', $lessonId)
            ->with('success', 'Quiz submitted successfully!');
    }
}
