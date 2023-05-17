<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Training\ProfileTraining as ModelProfileTraining;
use Illuminate\Http\Request;

class ProfileTrainingController extends Controller
{

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:profiletraining view')->only('index', 'show');
        $this->middleware('permission:profiletraining create')->only('create', 'store');
        $this->middleware('permission:profiletraining edit')->only('edit', 'update');
        $this->middleware('permission:profiletraining delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileTraining = ModelProfileTraining::all();
        return view('training.profiletraining.index', compact('profileTraining'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training.profiletraining.create');
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
            'type' => 'required',
            'model' => 'required',
            'training_name' => 'required',
            'description' => 'required',
            'training_goal' => 'required',
        ], [
            'type.required' => 'The Type field is required.',
            'model.required' => 'The Model field is required.',
            'training_name.required' => 'The Training Name field is required.',
            'description.required' => 'The Description field is required.',
            'training_goal.required' => 'The Training Goal field is required.',
        ]);
        

        $profileTraining = ModelProfileTraining::create([
            'type' => $validated['type'],
            'model' => $validated['model'],
            'training_name' => $validated['training_name'],
            'description' => $validated['description'],
            'training_goal' => $validated['training_goal'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($profileTraining) {
            // Redirect with success message
            return redirect()->route('profiletrainings.index')->with('success', __('The Profile Training was created successfully.'));
        } else {
            // Redirect with error message
            return redirect()->route('profiletrainings.index')->with('error', __('Failed to create Profile Training.'));
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
        $profileTraining = ModelProfileTraining::findOrFail($id);

        return view('training.profiletraining.show', compact('profileTraining'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profileTraining = ModelProfileTraining::findOrFail($id);
        return view('training.profiletraining.edit', compact('profileTraining'));
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
            'type' => 'required',
            'model' => 'required',
            'training_name' => 'required',
            'description' => 'required',
            'training_goal' => 'required',
        ], [
            'type.required' => 'The Type field is required.',
            'model.required' => 'The Model field is required.',
            'training_name.required' => 'The Training Name field is required.',
            'description.required' => 'The Description field is required.',
            'training_goal.required' => 'The Training Goal field is required.',
        ]);

        $profileTraining = ModelProfileTraining::findOrFail($id);

        $profileTraining->type = $validated['type'];
        $profileTraining->model = $validated['model'];
        $profileTraining->training_name = $validated['training_name'];
        $profileTraining->description = $validated['description'];
        $profileTraining->training_goal = $validated['training_goal'];
        $profileTraining->updated_at = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        $updateProfileTraining = $profileTraining->save();

        if ($updateProfileTraining) {
            // Redirect with success message
            return redirect()->route('profiletrainings.index')->with('success', 'The Profile Training was updated successfully.');
            } else {
            // Redirect with error message
            return redirect()->route('profiletrainings.index')->with('error', 'Failed to update the Profile Training.');
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
        $profileTraining = ModelProfileTraining::findOrFail($id);

        // Delete all data
        $profileTraining->delete();

        if ($profileTraining) {
            //redirect dengan pesan sukses
            return redirect()->route('calendars.index')->with('success', __('The Profile Training was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('calendars.index')->with('error', __('Failed'));
        }
    }
}
