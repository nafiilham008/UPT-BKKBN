<?php

namespace App\Http\Controllers\Remaja\Landing;

use App\Http\Controllers\Controller;
use App\Models\Remaja\CategoryQuiz;
use App\Models\Remaja\Question;
use App\Models\Remaja\Quiz;
use App\Models\Remaja\Ranking;
use App\Models\Remaja\ResultAnswer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
            ->get();


        $totalCorrectAnswers = 0;
        $totalPoints = 0;

        foreach ($results as $result) {
            if ($result->is_correct) {
                $totalCorrectAnswers++;
                $totalPoints += $result->points;
            }
        }

        $scorePercentage = ($totalCorrectAnswers / count($results)) * 100;
        $finalScore = round($scorePercentage);

        // save coba
        $ranking = Ranking::where('user_id', $results[0]->users->id)
        ->first();
        // $ranking = Ranking::all();
        
        
        if ($ranking) {
            $ranking->final_score += $finalScore;
        } else {
            // dd('no');
            $ranking = new Ranking();
            $ranking->final_score = $finalScore;
            $ranking->user_id = $results->first()->users->id;
        }

        // Save the ranking to the database
        $ranking->save();


        return view('remaja.front.nilai', compact('results', 'totalCorrectAnswers', 'totalPoints', 'finalScore'));
    }

    public function ranking()
    {
        $ranking = Ranking::with('users')->get();
        // dd($ranking);
        return view('remaja.front.ranking', compact('ranking'));
    }
}
