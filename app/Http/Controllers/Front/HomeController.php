<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Profile\Employee;
use App\Models\Profile\Historical;
use App\Models\Profile\Jobandfunc;
use App\Utilities\Constant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Post::where('highlight', 1)->get();

        $postNews = $this->getPostNews();
        $postArticle = $this->getPostArticle();
        $postInformation = $this->getPostInformation();

        $history = Historical::all();

        $constant = Constant::CATEGORY;

        return view('front.landing.index', compact('banner', 'postNews', 'postArticle', 'postInformation', 'constant', 'history'));
    }

    public function getPostNews()
    {
        $postNews = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Berita');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);


        if (request()->ajax()) {

            return view('front.landing.components.postnews', compact('postNews'))->render();
            // return response()->json(['html' => $view]);
        }
        return $postNews;
    }

    public function getPostArticle()
    {
        $postArticle = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Artikel');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return $postArticle;
    }

    public function getPostInformation()
    {
        $postInformation = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Informasi');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return $postInformation;
    }

    public function getCategory($categories, $slug_url)
    {

        $getCategory = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) use ($categories) {
                $query->where('label',  $categories);
            })
            ->where('slug_url', '!=', $slug_url)
            ->inRandomOrder()
            ->paginate(4);

        return $getCategory;
    }

    public function detail($categories, $slug_url)
    {
        // $post->load('users:id,name', 'categories:id,label');
        // $post = Post::with('categories', 'users')->where('slug_url', $slug_url)->first();

        $post = Post::with('categories', 'users')
            ->where('slug_url', $slug_url)
            ->whereHas('categories', function ($query) use ($categories) {
                $query->where('label', $categories);
            })
            ->first();

        $getCategory = $this->getCategory($categories, $slug_url);



        return view('front.landing.detail', compact('post', 'getCategory'));
    }

    // Profile Menu
    public function profile()
    {
        $history = Historical::all();
        $jobandfunc = Jobandfunc::all();
        $employee = Employee::all();

        return view('front.profile.index', compact('history', 'jobandfunc', 'employee'));
    }
}
