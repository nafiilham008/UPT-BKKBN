<?php

namespace App\Http\Controllers\Remaja\Landing;

use App\Http\Controllers\Controller;
use App\Models\Remaja\CategoryQuiz;
use App\Models\Remaja\Question;
use App\Models\Remaja\Quiz;
use App\Models\Remaja\Ranking;
use App\Models\Remaja\ResultAnswer;
use App\Models\Remaja\ResultQuiz;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('remaja.front.index');
    }

    public function listGame()
    {
        $category = CategoryQuiz::all();

        $quiz = Quiz::with('category_quiz', 'users')
            ->get();


        return view('remaja.front.list-game', compact('category', 'quiz'));
    }

    public function gameDetail($slug_url)
    {
        $userId = Auth::id();
        $resultCheck = ResultAnswer::with('users', 'quiz')
            ->where('user_id', $userId)
            ->whereHas('quiz', function ($query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->first();

        // dd($resultCheck);

        if (isset($resultCheck)) {
            return redirect()->back()->with('error', 'Game ini hanya dapat dimainkan sekali. Anda sudah memainkan game ini sebelumnya.');
        }

        // dd('kosong');

        $question = Question::with(['quiz', 'users'])
            ->whereHas('quiz', function (Builder $query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->get();


        return view('remaja.front.game', compact('question'));
    }

    public function gameResult($slug_url)
    {
        $results = ResultAnswer::with('quiz', 'users', 'question')
            ->whereHas('quiz', function ($query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->where('user_id', Auth::user()->id)
            ->get();



        $totalCorrectAnswers = 0;
        $totalPoints = 0;

        // Dapatkan semua ID pertanyaan unik dari hasil
        $uniqueQuestionIds = $results->pluck('question_id')->unique();

        foreach ($uniqueQuestionIds as $questionId) {
            $relatedResults = $results->where('question_id', $questionId);


            if (count($relatedResults) > 1) { // Multiple choice question
                $correctCount = $relatedResults->where('is_correct', true)->count(); // Jumlah jawaban yang benar dari user

                $actualCorrectCount = $relatedResults->count(); // Total jawaban yang benar untuk pertanyaan ini di database (semua opsi yang seharusnya benar)

                // Hitung presentase kebenaran jawaban user
                $percentageCorrect = $correctCount / $actualCorrectCount;


                // Jika semua jawaban user benar, tambahkan ke total jawaban yang benar
                if ($percentageCorrect == 1) {
                    $totalCorrectAnswers++;
                }

                // Tambahkan presentase ke total poin
                $totalPoints += $percentageCorrect;
                // $isCorrect = $relatedResults->first()->is_correct;
                // dd($isCorrect);


            } else { // Single choice question
                $isCorrect = $relatedResults->first()->is_correct;

                if ($isCorrect) {
                    // dd('cek');
                    $totalCorrectAnswers++;
                    $totalPoints++;
                }
                // dd($totalPoints);

            }
        }


        // $scorePercentage = ($totalCorrectAnswers / count($uniqueQuestionIds)) * 100;
        $scorePercentage = ($totalPoints / count($uniqueQuestionIds)) * 100;

        // dd(count($uniqueQuestionIds));
        $finalScore = round($scorePercentage);

        $uniqueQuizIds = $results->groupBy('quiz_id')->keys();
        foreach ($uniqueQuizIds as $quizId) {
            $checkResultQuiz = ResultQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quizId)
                ->first();

            if (!$checkResultQuiz) {
                $resultQuiz = new ResultQuiz([
                    'user_id' => Auth::user()->id,
                    'quiz_id' => $quizId,
                    'score' => $finalScore,
                ]);

                $resultQuiz->save();
                $this->saveScore($finalScore);
            }
        }

        return view('remaja.front.nilai', compact('results', 'totalCorrectAnswers', 'totalPoints', 'finalScore'));
    }

    public function saveScore($finalScore)
    {
        $userId = Auth::id();
        $ranking = Ranking::firstOrNew(['user_id' => $userId]);

        $ranking->final_score += $finalScore;
        $ranking->save();
    }



    public function gameResultView($slug_url)
    {
        $results = ResultAnswer::with('quiz', 'users', 'question')
            ->whereHas('quiz', function ($query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->where('user_id', Auth::user()->id)
            ->get();


        $totalCorrectAnswers = 0;
        $totalPoints = 0;

        // Dapatkan semua ID pertanyaan unik dari hasil
        $uniqueQuestionIds = $results->pluck('question_id')->unique();

        foreach ($uniqueQuestionIds as $questionId) {
            $relatedResults = $results->where('question_id', $questionId);

            if (count($relatedResults) > 1) { // Multiple choice question
                $correctCount = $relatedResults->where('is_correct', true)->count(); // Jumlah jawaban yang benar dari user

                $actualCorrectCount = $relatedResults->count(); // Total jawaban yang benar untuk pertanyaan ini di database (semua opsi yang seharusnya benar)

                // Hitung presentase kebenaran jawaban user
                $percentageCorrect = $correctCount / $actualCorrectCount;

                // Jika semua jawaban user benar, tambahkan ke total jawaban yang benar
                if ($percentageCorrect == 1) {
                    $totalCorrectAnswers++;
                }

                // Tambahkan presentase ke total poin
                $totalPoints += $percentageCorrect;
            } else { // Single choice question
                $isCorrect = $relatedResults->first()->is_correct;
                if ($isCorrect) {
                    $totalCorrectAnswers++;
                    $totalPoints++;
                }
            }
        }

        // $scorePercentage = ($totalCorrectAnswers / count($uniqueQuestionIds)) * 100;
        $scorePercentage = ($totalPoints / count($uniqueQuestionIds)) * 100;
        $finalScore = round($scorePercentage);

        return view('remaja.front.nilai', compact('results', 'totalCorrectAnswers', 'totalPoints', 'finalScore'));
    }


    public function ranking()
    {
        $topRanking = Ranking::with('users')
            ->orderByDesc('final_score')
            ->take(3)
            ->get();

        $topRankingIds = $topRanking->pluck('id')->toArray();

        $all = Ranking::with('users')
            ->whereNotIn('id', $topRankingIds)
            ->get();


        $totalQuiz = ResultAnswer::select('user_id', DB::raw('count(distinct quiz_id) as total_quiz'))
            ->groupBy('user_id')
            ->get();

        // dd($totalQuiz);
        return view('remaja.front.ranking', compact('topRanking', 'all', 'totalQuiz'));
    }
}
