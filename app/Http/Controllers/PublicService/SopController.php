<?php

namespace App\Http\Controllers\PublicService;

use App\Http\Controllers\Controller;
use App\Models\PublicService\Sop;
use Illuminate\Http\Request;

class SopController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sop view')->only('index', 'show');
        $this->middleware('permission:sop create')->only('create', 'store');
        $this->middleware('permission:sop edit')->only('edit', 'update');
        $this->middleware('permission:sop delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sop = Sop::all();

        return view('public-service.sop.index', compact('sop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public-service.sop.create');
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
            'description' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'link.nullable' => 'The link field should be a valid URL.',
            'description.required' => 'The description field is required.',
        ]);

        $sop = Sop::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($sop) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.sops.index')->with('success', __('The SOP was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.sops.index')->with('error', __('Failed'));
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
        $sop = Sop::findOrFail($id);

        return view('public-service.sop.show', compact('sop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sop = Sop::findOrFail($id);

        return view('public-service.sop.edit', compact('sop'));
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
        $sop = Sop::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'link' => 'nullable',
            'description' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'link.nullable' => 'The link field should be a valid URL.',
            'description.required' => 'The description field is required.',
        ]);

        $sop->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($sop) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.sops.index')->with('success', __('The SOP was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.sops.index')->with('error', __('Failed'));
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
        $sop = Sop::findOrFail($id);

        $sop->delete();

        if ($sop) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.sops.index')->with('success', __('The SOP was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.sops.index')->with('error', __('Failed'));
        }
    }
}
