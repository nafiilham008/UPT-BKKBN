<?php

namespace App\Http\Controllers\PublicService;

use App\Http\Controllers\Controller;
use App\Models\PublicService\ServiceInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ServiceInformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:service-information view')->only('index', 'show');
        $this->middleware('permission:service-information create')->only('create', 'store');
        $this->middleware('permission:service-information edit')->only('edit', 'update');
        $this->middleware('permission:service-information delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceInformation = ServiceInformation::all();

        return view('public-service.service-information.index', compact('serviceInformation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public-service.service-information.create');
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
        ], [
            'title.required' => 'Title field is required.',
            'photo.required' => 'Photo field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/public-service/service-information', $filename, 'public');
        } else {
            $pathPhoto = null;
        }

        $serviceInformation = ServiceInformation::create([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($serviceInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.service-informations.index')->with('success', __('The button service information was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.service-informations.index')->with('error', __('Failed'));
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
        $serviceInformation = ServiceInformation::findOrFail($id);

        return view('public-service.service-information.show', compact('serviceInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceInformation = ServiceInformation::findOrFail($id);

        return view('public-service.service-information.edit', compact('serviceInformation'));
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
        $serviceInformation = ServiceInformation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Title field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus file gambar lama
            if ($serviceInformation->photo) {
                Storage::disk('public')->delete($serviceInformation->photo);
            }

            $filename = $request->file('photo')->hashName();
            $pathPhoto = $request->file('photo')->storeAs('images/public-service/service-information', $filename, 'public');
        } else {
            $pathPhoto = $serviceInformation->photo;
        }

        $serviceInformation->update([
            'title' => $validated['title'],
            'photo' => $pathPhoto,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($serviceInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.service-informations.index')->with('success', __('The service information was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.service-informations.index')->with('error', __('Failed'));
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
        $serviceInformation = ServiceInformation::findOrFail($id);

        if ($serviceInformation->photo) {
            Storage::disk('public')->delete($serviceInformation->photo);
        }

        // Delete all data
        $serviceInformation->delete();

        if ($serviceInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.service-informations.index')->with('success', __('The button banner was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.service-informations.index')->with('error', __('Failed'));
        }
    }
}
