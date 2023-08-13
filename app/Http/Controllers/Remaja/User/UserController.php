<?php

namespace App\Http\Controllers\Remaja\User;

use App\Http\Controllers\Controller;
use App\Models\Remaja\DetailUser;
use App\Models\Remaja\Ranking;
use App\Models\Remaja\ResultAnswer;
use App\Models\Remaja\ResultQuiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $ranking = $this->myRanking();

        $detailUser = $this->myDetailProfile();

        $totalQuiz = $this->myTotalQuiz();

        $quiz = $this->myQuiz();
        // dd($quiz);

        return view('remaja.profile-user.index', compact('ranking', 'detailUser', 'totalQuiz', 'quiz'));
    }

    public function myRanking()
    {
        return Ranking::select('*', DB::raw('FIND_IN_SET(final_score, (SELECT GROUP_CONCAT(final_score ORDER BY final_score DESC) FROM rankings)) as ranking'))
            ->with('users')
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('final_score')
            ->first();
    }

    public function myDetailProfile()
    {
        return DetailUser::with('users')
            ->where('user_id', auth()->user()->id)
            ->first();
    }

    public function myTotalQuiz()
    {
        $quiz = ResultAnswer::with('quiz', 'users', 'question')
            ->where('user_id', Auth::user()->id)
            ->get();

        $groupedQuiz = $quiz->groupBy('quiz_id');
        $totalQuizIds = $groupedQuiz->count();

        return $totalQuizIds;
    }

    public function myQuiz()
    {
        $quiz = ResultAnswer::with('quiz', 'users', 'question')
            ->where('user_id', Auth::user()->id)
            ->get();

        $groupedQuiz = $quiz->groupBy('quiz_id');

        $listQuiz = $groupedQuiz->map(function ($group) {
            return $group->first();
        });

        return $listQuiz;
        //     $quizTitle = $resultAnswer->quiz->title;

    }

    public function myCertificate($slug_url)
    {
        $resultQuiz = ResultQuiz::with('users', 'quiz')
            ->whereHas('quiz', function ($query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->where('user_id', auth()->user()->id)
            ->first();

        // dd($resultQuiz);

        return view('remaja.front.certificate', compact('resultQuiz'));
    }

    public function myPrintCertificate($slug_url)
    {
        $resultQuiz = ResultQuiz::with('users', 'quiz')
            ->whereHas('quiz', function ($query) use ($slug_url) {
                $query->where('slug_url', $slug_url);
            })
            ->where('user_id', auth()->user()->id)
            ->first();

        // dd($slug_url);

        return view('remaja.front.print-certificate', compact('resultQuiz'));
    }

    public function editProfile()
    {
        $detail = $this->myDetailProfile();

        $user = User::where('id', auth()->user()->id)->first();
        return view('remaja.profile-user.edit', compact('detail', 'user'));
    }

    public function updateProfile($id, Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'birthdate' => 'required',
            'gender' => 'required|in:man,woman',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'gender.in' => 'The gender must be either "man" or "woman".',
        ]);

        $user = User::findOrFail($id);
        $detail = $this->myDetailProfile();

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // Hapus file gambar lama
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $filename = $request->file('avatar')->hashName();
            $path = $request->file('avatar')->storeAs('images/profile/user', $filename, 'public');
        } else {
            $path = $user->avatar;
        }

        $user->name = $validated['name'];
        $user->avatar = $path;
        $user->save();

        if (!$detail) {
            $detail = new DetailUser();
            $detail->birthdate = $validated['birthdate'];
            $detail->gender = $validated['gender'];
            $detail->user_id = auth()->user()->id;
            $detail->save();
        } else {
            $detail->birthdate = $validated['birthdate'];
            $detail->gender = $validated['gender'];
            $detail->save();
        }

        return redirect()->route('user.profile');
    }
}
