<?php

namespace App\Http\Controllers\PublicService;

use App\Http\Controllers\Controller;
use App\Models\PublicService\WorkAccountability;
use Illuminate\Http\Request;

class WorkAccountabilityController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:work-accountability view')->only('index', 'show');
        $this->middleware('permission:work-accountability create')->only('create', 'store');
        $this->middleware('permission:work-accountability edit')->only('edit', 'update');
        $this->middleware('permission:work-accountability delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workAccountability = WorkAccountability::all();

        return view('public-service.work-accountability.index', compact('workAccountability'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('public-service.work-accountability.create');
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
            'year' => ['required', 'numeric', 'max:' . date('Y')],
            'link' => 'required',
            'additional' => 'nullable'
        ], [
            'year.required' => 'year field is required.',
            'link.required' => 'Link field is required.',
        ]);

        $workAccountability = WorkAccountability::create([
            'year' => $validated['year'],
            'link' => $validated['link'],
            'additional' => $validated['additional'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($workAccountability) {
            //redirect dengan pesan sukses
            return redirect()->route('work-accountabilities.index')->with('success', __('The work accountability was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('work-accountabilities.index')->with('error', __('Failed'));
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
        $workAccountability = WorkAccountability::findOrFail($id);


        return view('public-service.work-accountability.show', compact('workAccountability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workAccountability = WorkAccountability::findOrFail($id);


        return view('public-service.work-accountability.edit', compact('workAccountability'));
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
        $workAccountability = WorkAccountability::findOrFail($id);

        $validated = $request->validate([
            'year' => ['required', 'numeric', 'max:' . date('Y')],
            'link' => 'required',
            'additional' => 'nullable'
        ], [
            'year.required' => 'year field is required.',
            'link.required' => 'Link field is required.',
        ]);

        
        $workAccountability->update([
            'year' => $validated['year'],
            'link' => $validated['link'],
            'additional' => $validated['additional'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($workAccountability) {
            //redirect dengan pesan sukses
            return redirect()->route('work-accountabilities.index')->with('success', __('The work accountability was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('work-accountabilities.index')->with('error', __('Failed'));
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
        $workAccountability = WorkAccountability::findOrFail($id);


        // Delete all data
        $workAccountability->delete();

        if ($workAccountability) {
            //redirect dengan pesan sukses
            return redirect()->route('work-accountabilities.index')->with('success', __('The work accountability was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('work-accountabilities.index')->with('error', __('Failed'));
        }
    }
}
