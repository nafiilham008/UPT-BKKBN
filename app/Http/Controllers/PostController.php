<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Path for post content file.
     *
     * @var string
     */
    protected $thumbnailPath = 'uploads/images/content/thumbnail/';

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
        $content = Post::with('categories', 'users')->orderBy('created_at', 'desc')->get();



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
        $validated = $request->validate(
            [
                'title' => 'required|unique:posts',
                'thumbnail' => 'required|mimes:jpeg,png,jpg|image|max:2048',
                'description' => 'required|min:10',
                'category' => 'required',
                'status' => 'required',
                'created_at' => 'nullable|date',
            ],
            [
                'title.required' => 'The title field is required.',
                'title.unique' => 'The title has already been taken.',
                'thumbnail.required' => 'The thumbnail field is required.',
                'thumbnail.mimes' => 'The thumbnail must be a JPEG, PNG, or JPG image.',
                'thumbnail.image' => 'The thumbnail must be an image.',
                'thumbnail.max' => 'The thumbnail may not be greater than 2048 kilobytes.',
                'description.required' => 'The description field is required.',
                'description.min' => 'The description must be at least 10 characters.',
                'category.required' => 'The category field is required.',
                'status.required' => 'The status field is required.',
                'created_at.date' => 'The publication date must be a valid date.',
            ]
        );


        if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {

            $filename = $request->file('thumbnail')->hashName();
            $pathThumbnail = $request->file('thumbnail')->storeAs('images/post/thumbnail', $filename, 'public');
        } else {
            $pathThumbnail = null;
        }


        $description = $validated['description'];
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/uploads/images/content/image-content/" . time() . $k . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.html';
        $dom->saveHTMLFile($tempFilePath);
        $description = file_get_contents($tempFilePath);
        unlink($tempFilePath);

        // Title
        // $slug = str_replace([' ', '/'], '-', $validated['title']);
        $slug = Str::slug($validated['title'], '-');
        $slug = Str::lower($slug);


        // Created_at
        if (!empty($validated['created_at'])) {
            $publicationDate = $validated['created_at'];
        } else {
            $publicationDate = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
        }



        $postCreate = Post::create([
            'title' => $validated['title'],
            'thumbnail' => $pathThumbnail,
            'user_id' => auth()->user()->id,
            'slug_url' => $slug,
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
            'created_at' => $publicationDate,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')

        ]);

        // dd($postCreate->id);
        $gallery = new Gallery();
        $gallery->post_id = $postCreate->id;
        $gallery->title = $postCreate->title;
        $gallery->save();



        if ($postCreate) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.posts.index')->with('success', __('The article was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.posts.index')->with('error', __('Failed'));
        }
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
            'title' => 'required|unique:posts,title,' . $post->id,
            'thumbnail' => 'nullable|mimes:jpeg,png,jpg|image|max:2048',
            'description' => 'required|min:10',
            'category' => 'required',
            'status' => 'required',
            'created_at' => 'nullable|date',
        ], [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title has already been taken.',
            'thumbnail.mimes' => 'The thumbnail must be a JPEG, PNG, or JPG image.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2048 kilobytes.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least 10 characters.',
            'category.required' => 'The category field is required.',
            'status.required' => 'The status field is required.',
            'created_at.date' => 'The publication date must be a valid date.',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus file gambar lama
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            $filename = $request->file('thumbnail')->hashName();
            $pathThumbnail = $request->file('thumbnail')->storeAs('images/post/thumbnail', $filename, 'public');
        } else {
            $pathThumbnail = $post->thumbnail;
        }

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        // $slug = str_replace([' ', '/'], '-', $validated['title']);
        $slug = Str::slug($validated['title'], '-');
        $slug = Str::lower($slug);



        $post->update([
            'title' => $validated['title'],
            'thumbnail' => $pathThumbnail,
            'user_id' => auth()->user()->id,
            'slug_url' => $slug,
            'description' => $description,
            'categories_id' => $validated['category'],
            'status' => $validated['status'],
            'created_at' => $validated['created_at'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        $gallery = Gallery::where('post_id', $post->id)->first();
        $gallery->title = $post->title;
        $gallery->save();



        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.posts.index')->with('success', __('The article was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.posts.index')->with('error', __('Failed'));
        }
    }

    public function summernoteUpdate($description)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');

            // Check if the image is from a URL or base64 data
            if (Str::startsWith($data, 'data:image')) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/uploads/images/content/image-content/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.html';
        $dom->saveHTMLFile($tempFilePath);
        $updatedDescription = file_get_contents($tempFilePath);
        unlink($tempFilePath);

        return $updatedDescription;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Jika highlight true, maka data tidak dapat dihapus
        if ($post->highlight == 1) {
            return redirect()->route('dashboard.posts.index')->with('error', __('Failed'));
        } else {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
    
            // Check Image
            $description = $post->description;
            $result = strstr($description, 'src="/uploads/images/content/image-content/');

            $result = explode('src="/uploads/images/content/image-content/', $result);
            $img_src = array();
            foreach ($result as $img) {
                $img_src[] = explode('"', $img)[0];
            }
            $img_src = array_filter($img_src);

            foreach ($img_src as $key => $value) {
                // Delete image from local
                $image = public_path('uploads/images/content/image-content/' . $value);
                unlink($image);
            }

            // Delete all data
            $post->delete();

            if ($post) {
                //redirect dengan pesan sukses
                return redirect()->route('dashboard.posts.index')->with('success', __('The article was deleted successfully.'));
            } else {
                //redirect dengan pesan error
                return redirect()->route('dashboard.posts.index')->with('error', __('Failed'));
            }
        }


        // if ($post->thumbnail != null && file_exists($oldThumbnail = public_path($this->thumbnailPath . $post->thumbnail))) {
        //     unlink($oldThumbnail);
        // }

        // // Check Image
        // $description = $post->description;
        // $result = strstr($description, 'src="/uploads/images/content/image-content/');

        // $result = explode('src="/uploads/images/content/image-content/', $result);
        // $img_src = array();
        // foreach ($result as $img) {
        //     $img_src[] = explode('"', $img)[0];
        // }
        // $img_src = array_filter($img_src);

        // foreach ($img_src as $key => $value) {
        //     // Delete image from local
        //     $image = public_path('uploads/images/content/image-content/' . $value);
        //     unlink($image);
        // }

        // // Delete all data
        // $post->delete();

        // if ($post) {
        //     //redirect dengan pesan sukses
        //     return redirect()->route('dashboard.posts.index')->with('success', __('The article was deleted successfully.'));
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('dashboard.posts.index')->with('error', __('Failed'));
        // }
    }
}
