<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use App\Models\Download\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:material view')->only('index', 'show');
        $this->middleware('permission:material create')->only('create', 'store');
        $this->middleware('permission:material edit')->only('edit', 'update');
        $this->middleware('permission:material delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material = Material::all();

        return view('download.material.index', compact('material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('download.material.create');
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
        ], [
            'title.required' => 'Title field is required.',
        ]);

        $material = Material::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($material) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.materials.index')->with('success', __('The material was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.materials.index')->with('error', __('Failed'));
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
        $material = Material::findOrFail($id);

        return view('download.material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);

        return view('download.material.edit', compact('material'));
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
        $material = Material::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'link' => 'nullable',
        ], [
            'title.required' => 'Title field is required.',
        ]);

        
        $material->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($material) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.materials.index')->with('success', __('The material was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.materials.index')->with('error', __('Failed'));
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
        $material = Material::findOrFail($id);


        // Delete all data
        $material->delete();

        if ($material) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.materials.index')->with('success', __('The material was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.materials.index')->with('error', __('Failed'));
        }
    }
}
