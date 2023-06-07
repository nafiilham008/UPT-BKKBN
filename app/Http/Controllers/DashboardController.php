<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $post = Post::all();

        $user = User::all();

        $visitors = Visitor::all();

        return view('dashboard', compact('post', 'user', 'visitors'));
    }

    
}
