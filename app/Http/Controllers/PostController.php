<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    // protected $avatarPath = '/uploads/images/avatars/';

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:content view')->only('index', 'show');
        $this->middleware('permission:content create')->only('create', 'store');
        $this->middleware('permission:content edit')->only('edit', 'update');
        $this->middleware('permission:content delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Call post model with relation categories and users
        $content = Post::with('categories', 'users')->get();

        return view('posts.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();

        return view('posts.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required|min:10',
            'category' => 'required',
            'status' => 'required',
        ]);

        // Dom list for value summernote
        $description = $validated['description'];
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/image-content/" . time() . $k . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();

        $postCreate = Post::create([
            'title' => $validated['title'],
            'user_id' => auth()->user()->id,
            'slug_url' => str_replace(' ', '-', $validated['title']),
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
        ]);


        if ($postCreate) {
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with('success', __('The article was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with('error', __('Failed'));
        }

        // return redirect()
        //     ->route('posts.index')
        //     ->with('success', __('The article was posted successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Call model Post with relationship users and categories
        $post->load('users:id,name', 'categories:id,label');

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Call model Post with relationship users and categories
        $post->load('users:id,name', 'categories:id,label');
        $data = Category::all();

        return view('posts.edit', compact('post', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'category' => 'required',
            'status' => 'required',
        ]);

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        $post->update([
            'title' => $validated['title'],
            'user_id' => auth()->user()->id,
            'slug_url' => str_replace(' ', '-', $validated['title']),
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
            'updated_at' => now()
        ]);


        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with('success', __('The article was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with('error', __('Failed'));
        }
    }

    public function summernoteUpdate($description)
    {
        $dom = new \DomDocument();

        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            $count = Str::length($data);
            // check image before
            if ($count > 100) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/image-content/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $description = $dom->saveHTML();
        return $description;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Check Image
        $description = $post->description;
        $result = strstr($description, 'src="/image-content/');
        
        $result = explode('src="/image-content/', $result);
        $img_src = array();
        foreach ($result as $img) {
            $img_src[] = explode('"', $img)[0];
        }
        $img_src = array_filter($img_src);
        
        foreach ($img_src as $key => $value) {
            // Delete image from local
            $image = public_path('image-content/' . $value);
            unlink($image);
        }
        $post->delete();

        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with('success', __('The article was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with('error', __('Failed'));
        }
    }
}
