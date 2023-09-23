<?php

namespace App\Http\Controllers;

use App\Exports\Excel\UsersExport;
use App\Models\Remaja\Ranking;
use App\Models\Remaja\ResultAnswer;
use App\Models\Remaja\ResultQuiz;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class UserRemajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-remaja view')->only('index');
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::role('User Remaja')->with(['results.quiz', 'ranking'])->get();

            return DataTables::of($users)
                ->addColumn('avatar', function ($user) {
                    if ($user->avatar) {
                        return asset('storage/' . $user->avatar);
                    }
                    return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=500';
                })
                ->addColumn('total_score', function ($user) {
                    return $user->ranking->final_score ?? 0;
                })
                ->addColumn('action', 'users-remaja.include.action')
                ->addColumn('quizzes', function ($user) {
                    return $user->results->count();
                })
                ->toJson();
        }

        return view('users-remaja.index');
    }

    public function exportToExcel()
    {
        return Excel::download(new UsersExport, 'users-remaja.xlsx');
    }

    public function resetQuiz($id)
    {
        try {
            $user = User::findOrFail($id);
            if (!$user) {
                return redirect()->route('dashboard.user-remajas.index')->with('error', 'User id is empty!');

            }

            ResultQuiz::where('user_id', $id)->delete();
            ResultAnswer::where('user_id', $id)->delete();
            Ranking::where('user_id', $id)->delete();

            return redirect()->route('dashboard.user-remajas.index')->with('success', 'The User has been reset');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.user-remajas.index')->withErrors(['error' => 'Failed to reset user: ' . $e->getMessage()]);
        }
    }
}
