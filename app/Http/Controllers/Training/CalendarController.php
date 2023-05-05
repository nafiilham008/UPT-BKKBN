<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Training\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:calendar view')->only('index', 'show');
        $this->middleware('permission:calendar create')->only('create', 'store');
        $this->middleware('permission:calendar edit')->only('edit', 'update');
        $this->middleware('permission:calendar delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar = Calendar::all();
        return view('training.calendar.index', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training.calendar.create');
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
            'title' => 'required|unique:calendars',
            'link' => ['required', 'url'],
        ], [
            'title.required' => 'The Title field is required.',
            'title.unique' => 'The Title has already been taken.',
            'link.required' => 'The Link Calendar (drive) field is required.',
            'link.url' => 'The Link Calendar (drive) field must be a valid URL.'
        ]);

        $calendar = Calendar::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($calendar) {
            //redirect dengan pesan sukses
            return redirect()->route('calendars.index')->with('success', __('The Training Calendar was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('calendars.index')->with('error', __('Failed'));
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
        $calendar = calendar::findOrFail($id);

        return view('training.calendar.show', compact('calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('training.calendar.edit', compact('calendar'));
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
        $validated = $request->validate([
            'title' => 'required|unique:calendars,title,' . $id,
            'link' => ['required', 'url'],
        ], [
            'title.required' => 'The Title field is required.',
            'title.unique' => 'The Title has already been taken.',
            'link.required' => 'The Link Calendar (drive) field is required.',
            'link.url' => 'The Link Calendar (drive) field must be a valid URL.'
        ]);

        $calendar = Calendar::findOrFail($id);

        $calendar->title = $validated['title'];
        $calendar->link = $validated['link'];
        $calendar->updated_at = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        $updateCalendar = $calendar->save();
        if ($updateCalendar) {
            //redirect dengan pesan sukses
            return redirect()->route('calendars.index')->with('success', __('The Training Calendar was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('calendars.index')->with('error', __('Failed'));
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
        $calendar = Calendar::findOrFail($id);

        // Delete all data
        $calendar->delete();

        if ($calendar) {
            //redirect dengan pesan sukses
            return redirect()->route('calendars.index')->with('success', __('The Training Calendar was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('calendars.index')->with('error', __('Failed'));
        }
    }
}
