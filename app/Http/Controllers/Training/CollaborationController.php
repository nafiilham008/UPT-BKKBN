<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Training\Collaboration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CollaborationController extends Controller
{


    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:collaboration view')->only('index', 'show');
        $this->middleware('permission:collaboration create')->only('create', 'store');
        $this->middleware('permission:collaboration edit')->only('edit', 'update');
        $this->middleware('permission:collaboration delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaboration = Collaboration::all();
        return view('training.collaboration.index', compact('collaboration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training.collaboration.create');
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
            'institution_name' => 'required',
            'logo' => 'required|mimes:jpeg,png,jpg|image|max:2048',
        ], [
            'institution_name.required' => 'Institution name is required.',
            'logo.required' => 'Logo is required.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg.',
            'logo.image' => 'The file must be an image.',
            'logo.max' => 'The logo may not be greater than 2048 kilobytes.',
        ]);

        if ($request->file('logo') && $request->file('logo')->isValid()) {

            $filename = $request->file('logo')->hashName();
            $pathLogo = $request->file('logo')->storeAs('images/training/collaboration-logo', $filename, 'public');
        } else {
            $pathLogo = null;
        }

        $collaboration = Collaboration::create([
            'institution_name' => $validated['institution_name'],
            'logo' => $pathLogo,
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($collaboration) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.collaborations.index')->with('success', __('The collaboration was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.collaborations.index')->with('error', __('Failed'));
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
        $collaboration = Collaboration::findOrFail($id);

        return view('training.collaboration.show', compact('collaboration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collaboration = Collaboration::findOrFail($id);
        return view('training.collaboration.edit', compact('collaboration'));
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
        $collaboration = Collaboration::findOrFail($id);

        $validated = $request->validate([
            'institution_name' => 'required',
            'logo' => 'required|mimes:jpeg,png,jpg|image|max:2048',
        ], [
            'institution_name.required' => 'Institution name is required.',
            'logo.required' => 'Logo is required.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg.',
            'logo.image' => 'The file must be an image.',
            'logo.max' => 'The logo may not be greater than 2048 kilobytes.',
        ]);

        if ($request->hasFile('logo')) {
            // Hapus file gambar lama
            if ($collaboration->logo) {
                Storage::disk('public')->delete($collaboration->logo);
            }

            $filename = $request->file('logo')->hashName();
            $pathlogo = $request->file('logo')->storeAs('images/training/collaboration-logo', $filename, 'public');
        } else {
            $pathlogo = $collaboration->logo;
        }

        $collaboration->update([
            'institution_name' => $validated['institution_name'],
            'logo' => $pathlogo,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($collaboration) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.collaborations.index')->with('success', __('The collaboration was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.collaborations.index')->with('error', __('Failed'));
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
        $collaboration = Collaboration::findOrFail($id);
        if ($collaboration->logo) {
            Storage::disk('public')->delete($collaboration->logo);
        }

        // Delete all data
        $collaboration->delete();

        if ($collaboration) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.collaborations.index')->with('success', __('The collaboration was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.collaborations.index')->with('error', __('Failed'));
        }
    }
}
