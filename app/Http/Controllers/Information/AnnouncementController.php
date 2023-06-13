<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementDocument;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class AnnouncementController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:announcement view')->only('index', 'show');
        $this->middleware('permission:announcement create')->only('create', 'store');
        $this->middleware('permission:announcement edit')->only('edit', 'update');
        $this->middleware('permission:announcement delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcement = AnnouncementDocument::all();

        return view('information.announcement.index', compact('announcement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('information.announcement.create');
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
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
        ]);

        $announcement = AnnouncementDocument::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($announcement) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.announcements.index')->with('success', __('The announcement was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.announcements.index')->with('error', __('Failed'));
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
        $announcement = AnnouncementDocument::findOrFail($id);

        return view('information.announcement.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = AnnouncementDocument::findOrFail($id);

        return view('information.announcement.edit', compact('announcement'));
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
        $announcement = AnnouncementDocument::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'link' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
        ]);

        

        $announcement->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($announcement) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.announcements.index')->with('success', __('The announcement was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.announcements.index')->with('error', __('Failed'));
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
        $announcement = AnnouncementDocument::findOrFail($id);


        // Delete all data
        $announcement->delete();

        if ($announcement) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.announcements.index')->with('success', __('The announcement was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.announcements.index')->with('error', __('Failed'));
        }
    }
}
