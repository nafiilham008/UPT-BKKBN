<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;

class DashboardController extends Controller
{
    public function index()
    {
        $post = Post::all();

        $user = User::all();

        return view('dashboard', compact('post', 'user'));
    }

    
}
