<?php

namespace App\Http\Controllers\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HighlightController extends Controller
{

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:highlight view')->only('index', 'show', 'update');
        // $this->middleware('permission:highlight create')->only('create', 'store');
        // $this->middleware('permission:highlight edit')->only('edit', 'update');
        // $this->middleware('permission:highlight delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Call post model with relation categories and users
        $content = Post::with('categories', 'users')->where('status', 1)->get();


        return view('highlights.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        // Call model Post with relationship users and categories
        $post = Post::with('categories', 'users')->where('id', $post)->first();
        // dd($content);



        return view('highlights.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Post::findOrFail($id);

        $data->update([
            'highlight' => $request->highlight,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($data) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.highlights.index')->with('success', __('The article was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.highlights.index')->with('error', __('Failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
