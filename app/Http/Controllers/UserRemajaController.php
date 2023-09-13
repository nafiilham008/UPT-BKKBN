<?php

namespace App\Http\Controllers;

use App\Exports\Excel\UsersExport;
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
}
