<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Information\Scholarship;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ScholarshipController extends Controller
{

    protected $imagePath = 'uploads/images/information/scholarship/';


    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:scholarship view')->only('index', 'show');
        $this->middleware('permission:scholarship create')->only('create', 'store');
        $this->middleware('permission:scholarship edit')->only('edit', 'update');
        $this->middleware('permission:scholarship delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarship = Scholarship::all();

        return view('information.scholarship.index', compact('scholarship'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('information.scholarship.create');
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
            'photo' => 'required|mimes:jpeg,png|max:2048',
            'link' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'photo.required' => 'Photo field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'link.required' => 'Link field is required.',
            'description.required' => 'Description field is required.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();

            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->imagePath . $filename);

            $validated['photo'] = $filename;
        } else {
            $validated['photo'] = null;
        }

        $scholarship = Scholarship::create([
            'title' => $validated['title'],
            'photo' => $validated['photo'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($scholarship) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.scholarships.index')->with('success', __('The scholarship was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.scholarships.index')->with('error', __('Failed'));
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
        $scholarship = Scholarship::findOrFail($id);

        return view('information.scholarship.show', compact('scholarship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        return view('information.scholarship.edit', compact('scholarship'));

        
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
        $scholarship = Scholarship::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
            'link' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'link.required' => 'Link field is required.',
            'description.required' => 'Description field is required.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->imagePath) . $filename);

            // delete old avatar from storage
            if ($scholarship->photo != null && file_exists($oldphoto = public_path($this->imagePath .
                $scholarship->photo))) {
                unlink($oldphoto);
            }

            $validated['photo'] = $filename;
        } else {
            $validated['photo'] = $scholarship->photo;
        }

        $scholarship->update([
            'title' => $validated['title'],
            'photo' => $validated['photo'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($scholarship) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.scholarships.index')->with('success', __('The scholarship was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.scholarships.index')->with('error', __('Failed'));
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
        $scholarship = Scholarship::findOrFail($id);

        if ($scholarship->photo != null && file_exists($oldphoto = public_path($this->imagePath . $scholarship->photo))) {
            unlink($oldphoto);
        }

        // Delete all data
        $scholarship->delete();

        if ($scholarship) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.scholarships.index')->with('success', __('The scholarship was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.scholarships.index')->with('error', __('Failed'));
        }
        
    }
}
