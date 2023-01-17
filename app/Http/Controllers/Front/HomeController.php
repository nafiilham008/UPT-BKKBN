<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Utilities\Constant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Post::where('highlight', 1)->get();

        $postNews = Post::with('categories', 'users')->where('status', 1)->whereHas('categories', function ($query) {
            $query->where('label', '=', 'Berita');
        })->get();

        $postArticle = Post::with('categories', 'users')->where('status', 1)->whereHas('categories', function ($query) {
            $query->where('label', '=', 'Artikel');
        })->get();

        $postInformation = Post::with('categories', 'users')->where('status', 1)->whereHas('categories', function ($query) {
            $query->where('label', '=', 'Informasi');
        })->get();

        // dd($postNews);
        $constant = Constant::CATEGORY;

        // foreach ($constant as $key => $value) {
        //         # code...
        //     $label = $value['label'];
        //     // dump($label);
        // }



        return view('front.index', compact('banner', 'postNews', 'postArticle', 'postInformation', 'constant'));
    }
}
