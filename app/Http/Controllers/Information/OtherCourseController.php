<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\OtherCourse as ModelsOtherCourse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class OtherCourseController extends Controller
{

    protected $imagePath = 'uploads/images/information/other-course/';

    public function __construct()
    {
        $this->middleware('permission:course view')->only('index', 'show');
        $this->middleware('permission:course create')->only('create', 'store');
        $this->middleware('permission:course edit')->only('edit', 'update');
        $this->middleware('permission:course delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = ModelsOtherCourse::all();

        return view('information.other-course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('information.other-course.create');
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
            'image' => 'required|mimes:jpeg,png|max:2048',
            'link' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'Image must be a file of type: jpeg, png.',
            'image.max' => 'The Image may not be greater than 2048 kilobytes.',
            'link.required' => 'Link field is required.',
        ]);

        if ($request->file('image') && $request->file('image')->isValid()) {

            $filename = $request->file('image')->hashName();

            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->imagePath . $filename);

            $validated['image'] = $filename;
        } else {
            $validated['image'] = null;
        }

        $course = ModelsOtherCourse::create([
            'title' => $validated['title'],
            'image' => $validated['image'],
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($course) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.courses.index')->with('success', __('The course was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.courses.index')->with('error', __('Failed'));
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
        $course = ModelsOtherCourse::findOrFail($id);

        return view('information.other-course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = ModelsOtherCourse::findOrFail($id);

        return view('information.other-course.edit', compact('course'));
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
        $course = ModelsOtherCourse::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,png|max:2048',
            'link' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'image.mimes' => 'image must be a file of type: jpeg, png.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'link.required' => 'Link field is required.',
        ]);

        if ($request->file('image') && $request->file('image')->isValid()) {

            $filename = $request->file('image')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->imagePath) . $filename);

            // delete old avatar from storage
            if ($course->image != null && file_exists($oldImage = public_path($this->imagePath .
                $course->image))) {
                unlink($oldImage);
            }

            $validated['image'] = $filename;
        } else {
            $validated['image'] = $course->image;
        }

        $course->update([
            'title' => $validated['title'],
            'image' => $validated['image'],
            'link' => $validated['link'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($course) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.courses.index')->with('success', __('The course was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.courses.index')->with('error', __('Failed'));
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
        $course = ModelsOtherCourse::findOrFail($id);

        if ($course->image != null && file_exists($oldImage = public_path($this->imagePath . $course->image))) {
            unlink($oldImage);
        }

        // Delete all data
        $course->delete();

        if ($course) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.courses.index')->with('success', __('The course was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.courses.index')->with('error', __('Failed'));
        }
    }
}
