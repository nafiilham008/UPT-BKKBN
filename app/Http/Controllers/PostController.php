<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    protected $thumbnailPath = 'uploads/images/thumbnail/';

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
        $validated = $request->validate(
            [
                'title' => 'required|unique:posts',
                'thumbnail' => 'required|mimes:jpeg,png,jpg|image|max:1024',
                'description' => 'required|min:10',
                'category' => 'required',
                'status' => 'required',
            ],
            [
                'description.min' => 'Required min 10 characters',
                'thumbnail.mimes' => 'Required image JPEG, PNG, or JPG'
            ]
        );
        // dd($validated['thumbnail']);


        if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {

            $filename = $request->file('thumbnail')->hashName();

            if (!file_exists($folder = public_path($this->thumbnailPath))) {
                mkdir($folder, 0777, true);
            }
            // dd($folder, $filename);

            Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->thumbnailPath . $filename);

            // $image = $request->file('thumbnail');
            // $image->save($this->thumbnailPath . $filename);

            $validated['thumbnail'] = $filename;
        }


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
            'thumbnail' => $validated['thumbnail'],
            'user_id' => auth()->user()->id,
            'slug_url' => str_replace(' ', '-', $validated['title']),
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')

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
            'thumbnail' => 'mimes:jpeg,png,jpg|image|max:1024',
            'description' => 'required|min:10',
            'category' => 'required',
            'status' => 'required',
        ],[
            'thumbnail.mimes' => 'Required image JPEG, PNG, or JPG'
        ]);

        if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {

            $filename = $request->file('thumbnail')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->thumbnailPath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->thumbnailPath) . $filename);

            // delete old avatar from storage
            if ($post->thumbnail != null && file_exists($oldThumbnail = public_path($this->thumbnailPath .
                $post->thumbnail))) {
                unlink($oldThumbnail);
            }

            $validated['thumbnail'] = $filename;
        } else {
            $validated['thumbnail'] = $post->thumbnail;
        }

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        $post->update([
            'title' => $validated['title'],
            'thumbnail' => $validated['thumbnail'],
            'user_id' => auth()->user()->id,
            'slug_url' => str_replace(' ', '-', $validated['title']),
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
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

        if ($post->thumbnail != null && file_exists($oldThumbnail = public_path($this->thumbnailPath . $post->thumbnail))) {
            unlink($oldThumbnail);
        }

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

        // Delete all data
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
