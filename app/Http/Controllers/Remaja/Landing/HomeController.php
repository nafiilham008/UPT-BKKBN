<?php

namespace App\Http\Controllers\Remaja\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        return view('remaja.front.index');
    }
}
