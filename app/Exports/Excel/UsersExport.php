<?php

namespace App\Exports\Excel;

use App\Models\Remaja\Quiz;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $maxQuizzes;

    public function __construct()
    {
        $this->maxQuizzes = User::role('User Remaja')
            ->withCount('results')
            ->get()
            ->max('results_count');
    }


    public function collection()
    {
        $quizzes = Quiz::all();
        $users = User::role('User Remaja')
            ->with(['results.quiz', 'ranking'])
            ->get()
            ->sortByDesc(function ($user) {
                return $user->ranking->final_score ?? 0;
            })
            ->values();

        $rank = 0;
        $lastScore = PHP_INT_MAX;
        $currentRank = 0;

        return $users->map(function ($user) use (&$rank, &$lastScore, &$currentRank, $quizzes) {
            $data = [
                $user->name,
                $user->email,
            ];

            foreach ($quizzes as $quiz) {
                $result = $user->results->firstWhere('quiz_id', $quiz->id);
                $data[] = $result ? $result->score : 'N/A';
            }

            $data[] = $user->results->count();
            $finalScore = $user->ranking->final_score ?? 0;
            $data[] = $finalScore;

            // Logic ranking
            $rank++;
            if ($finalScore < $lastScore) {
                $currentRank = $rank;
            }
            $data[] = $currentRank;
            $lastScore = $finalScore;

            return $data;
        });
    }

    public function headings(): array
    {
        $headers = ['Name', 'Email'];

        $quizzes = Quiz::all();
        foreach ($quizzes as $quiz) {
            $headers[] = $quiz->title;
        }

        $headers[] = 'Quizzes Taken';
        $headers[] = 'Total Score';
        $headers[] = 'Ranking';

        return $headers;
    }
}
