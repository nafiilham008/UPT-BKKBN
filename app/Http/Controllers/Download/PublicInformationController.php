<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use App\Models\Download\PublicInformation;
use App\Utilities\Constant;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class   PublicInformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:public-information view')->only('index', 'show');
        $this->middleware('permission:public-information create')->only('create', 'store');
        $this->middleware('permission:public-information edit')->only('edit', 'update');
        $this->middleware('permission:public-information delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $typePublicInformation = Constant::TYPE_OF_PUBLIC_INFORMATION;

        // dd($typePublicInformation);

        $publicInformation = PublicInformation::all();

        return view('public-service.public-information.index', compact('publicInformation', 'typePublicInformation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typePublicInformation = Constant::TYPE_OF_PUBLIC_INFORMATION;

        return view('public-service.public-information.create', compact('typePublicInformation'));
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
            'link' => 'required',
            'type_public_information' => 'required'
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
            'type_public_information.required' => 'Type Public Information field is required.',
        ]);

        $publicInformation = PublicInformation::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'type' => $validated['type_public_information'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($publicInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.public-informations.index')->with('success', __('The public information was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.public-informations.index')->with('error', __('Failed'));
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
        $publicInformation = PublicInformation::findOrFail($id);

        $typePublicInformation = Constant::TYPE_OF_PUBLIC_INFORMATION;


        return view('public-service.public-information.show', compact('publicInformation', 'typePublicInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publicInformation = PublicInformation::findOrFail($id);

        $typePublicInformation = Constant::TYPE_OF_PUBLIC_INFORMATION;


        return view('public-service.public-information.edit', compact('publicInformation', 'typePublicInformation'));
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
        $publicInformation = PublicInformation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'type_public_information' => 'required'
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
            'type_public_information.required' => 'Type Public Information field is required.',
        ]);

        
        $publicInformation->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'type' => $validated['type_public_information'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($publicInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.public-informations.index')->with('success', __('The public information was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.public-informations.index')->with('error', __('Failed'));
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
        $publicInformation = PublicInformation::findOrFail($id);


        // Delete all data
        $publicInformation->delete();

        if ($publicInformation) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.public-informations.index')->with('success', __('The public information was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.public-informations.index')->with('error', __('Failed'));
        }
    }
}
