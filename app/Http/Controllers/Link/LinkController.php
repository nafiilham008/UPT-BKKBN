<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;
use App\Models\Link\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class LinkController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:link view')->only('index', 'show');
        $this->middleware('permission:link create')->only('create', 'store');
        $this->middleware('permission:link edit')->only('edit', 'update');
        $this->middleware('permission:link delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $link = Link::all();

        return view('link.index', compact('link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'link' => 'nullable',
            'type' => 'required',
            'photo' => 'required|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Title field is required.',
            'photo.required' => 'Photo field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'type.required' => 'Type field is required.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/link', $filename, 'public');
        } else {
            $pathPhoto = null;
        }

        $link = Link::create([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'type' => $validated['type'],
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($link) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.links.index')->with('success', __('The link was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.links.index')->with('error', __('Failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = Link::findOrFail($id);

        return view('link.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::findOrFail($id);

        return view('link.edit', compact('link'));
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
        $link = Link::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
            'link' => 'nullable',
            'type' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'link' => 'Link field is required.',
            'type' => 'Type field is required.',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus file gambar lama
            if ($link->photo) {
                Storage::disk('public')->delete($link->photo);
            }

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/link', $filename, 'public');
        } else {
            $pathPhoto = $link->photo;
        }

        $link->update([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'link' => $validated['link'],
            'type' => $validated['type'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($link) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.links.index')->with('success', __('The link was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.links.index')->with('error', __('Failed'));
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
        $link = Link::findOrFail($id);

        if ($link->photo) {
            Storage::disk('public')->delete($link->photo);
        }

        // Delete all data
        $link->delete();

        if ($link) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.links.index')->with('success', __('The link was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.links.index')->with('error', __('Failed'));
        }
    }
}
