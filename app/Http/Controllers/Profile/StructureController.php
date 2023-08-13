<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class StructureController extends Controller
{
    /**
     * Path for historical content file.
     *
     * @var string
     */

    public function __construct()
    {
        $this->middleware('permission:structure view')->only('index', 'show');
        $this->middleware('permission:structure create')->only('create', 'store');
        $this->middleware('permission:structure edit')->only('edit', 'update');
        $this->middleware('permission:structure delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structure = Structure::all();


        return view('profile.structure.index', compact('structure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $structure = Structure::all();

        if ($structure->count() == 1) {
            return redirect()->route('dashboard.structures.index')->with('error', __('Structure already exists'));
        } else {
            return view('profile.structure.create', compact('structure'));
        }
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
            'title' => 'nullable',
            'photo' => 'required|mimes:jpeg,png,svg|max:5120',
        ], [
            'photo.required' => 'Photo field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, svg.',
            'photo.max' => 'The photo may not be greater than 5120 kilobytes.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/profile/structure', $filename, 'public');
        } else {
            $pathPhoto = null;
        }

        $structure = Structure::create([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($structure) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.structures.index')->with('success', __('The button structure was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.structures.index')->with('error', __('Failed'));
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
        $structure = Structure::findOrFail($id);

        return view('profile.structure.show', compact('structure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $structure = Structure::findOrFail($id);

        return view('profile.structure.edit', compact('structure'));
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
        $structure = Structure::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable',
            'photo' => 'nullable|mimes:jpeg,png,svg|max:5120',
        ], [
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 5120 kilobytes.',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus file gambar lama
            if ($structure->photo) {
                Storage::disk('public')->delete($structure->photo);
            }

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/profile/structure', $filename, 'public');
        } else {
            $pathPhoto = $structure->photo;
        }

        $structure->update([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($structure) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.structures.index')->with('success', __('The structure was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.structures.index')->with('error', __('Failed'));
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
        $structure = Structure::findOrFail($id);

        if ($structure->photo) {
            Storage::disk('public')->delete($structure->photo);
        }

        // Delete all data
        $structure->delete();

        if ($structure) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.structures.index')->with('success', __('The structure was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.structures.index')->with('error', __('Failed'));
        }
    }
}
