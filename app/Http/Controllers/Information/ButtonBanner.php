<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Information\ButtonBanner as InformationButtonBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ButtonBanner extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:button-banner view')->only('index', 'show');
        $this->middleware('permission:button-banner create')->only('create', 'store');
        $this->middleware('permission:button-banner edit')->only('edit', 'update');
        $this->middleware('permission:button-banner delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buttonBanner = InformationButtonBanner::all();

        return view('information.button-banner.index', compact('buttonBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('information.button-banner.create');
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
            'photo' => 'required|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Title field is required.',
            'photo.required' => 'Photo field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/information/button-banner', $filename, 'public');
        } else {
            $pathPhoto = null;
        }

        $buttonBanner = InformationButtonBanner::create([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($buttonBanner) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.button-banners.index')->with('success', __('The button banner was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.button-banners.index')->with('error', __('Failed'));
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
        $buttonBanner = InformationButtonBanner::findOrFail($id);

        return view('information.button-banner.show', compact('buttonBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buttonBanner = InformationButtonBanner::findOrFail($id);

        return view('information.button-banner.edit', compact('buttonBanner'));
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
        $buttonBanner = InformationButtonBanner::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
            'link' => 'nullable',
        ], [
            'title.required' => 'Title field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus file gambar lama
            if ($buttonBanner->photo) {
                Storage::disk('public')->delete($buttonBanner->photo);
            }

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/information/button-banner', $filename, 'public');
        } else {
            $pathPhoto = $buttonBanner->photo;
        }

        $buttonBanner->update([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'link' => $validated['link'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($buttonBanner) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.button-banners.index')->with('success', __('The button banner was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.button-banners.index')->with('error', __('Failed'));
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
        $buttonBanner = InformationButtonBanner::findOrFail($id);

        if ($buttonBanner->photo) {
            Storage::disk('public')->delete($buttonBanner->photo);
        }

        // Delete all data
        $buttonBanner->delete();

        if ($buttonBanner) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.button-banners.index')->with('success', __('The button banner was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.button-banners.index')->with('error', __('Failed'));
        }
    }
}
