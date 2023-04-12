<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\EducationHistory;
use Illuminate\Http\Request;

class EducationHistoryController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    public function getEducationHistory($id)
    {
        return EducationHistory::where('employee_id', $id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'institution_name' => ['required', 'string', 'max:255'],
                'degree' => ['required', 'string', 'max:255'],
                'graduation_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
                'major' => ['nullable', 'string', 'max:255'],
                'gpa' => ['nullable', 'numeric', 'between:0.00,4.00'],
                'description' => ['nullable', 'string'],
            ]);

            // Create a new Education instance
            $education = new EducationHistory([
                'institution_name' => $validatedData['institution_name'],
                'degree' => $validatedData['degree'],
                'graduation_year' => $validatedData['graduation_year'],
                'major' => $validatedData['major'],
                'gpa' => $validatedData['gpa'],
                'description' => $validatedData['description'],
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'employee_id' => $id,
            ]);

            // Save the Education instance to the database
            $education->save();

            $refreshData = $this->getEducationHistory($id);
            // return $refreshData;

            // Send success response with success message
            return response()->json([
                'success' => 'Education data saved successfully!',
                'data' => $refreshData,
            ]);
        } catch (\Exception $e) {
            // Send error response with error message
            return response()->json(['error' => $e->getMessage()])
                ->setStatusCode(500, 'Failed to save education data. ' . $e->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $educationId)
    {
        try {
            $validatedData = $request->validate([
                'institution_name' => ['required', 'string', 'max:255'],
                'degree' => ['required', 'string', 'max:255'],
                'graduation_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
                'major' => ['nullable', 'string', 'max:255'],
                'gpa' => ['nullable', 'numeric', 'between:0.00,4.00'],
                'description' => ['nullable', 'string'],
            ]);

            $education = EducationHistory::where('id', $educationId)->where('employee_id', $id)->first();

            if (!$education) {
                return response()->json(['error' => 'Education data not found!']);
            }

            $education->institution_name = $validatedData['institution_name'];
            $education->degree = $validatedData['degree'];
            $education->graduation_year = $validatedData['graduation_year'];
            $education->major = $validatedData['major'];
            $education->gpa = $validatedData['gpa'];
            $education->description = $validatedData['description'];
            $education->updated_at = now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');

            $education->save();

            $educationAll = $this->getEducationHistory($id);

            // Send success response
            return response()->json([
                'success' => 'Education data updated successfully!',
                'data' => $educationAll
            ]);
        } catch (\Exception $e) {
            // Send error response with error message
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $education = EducationHistory::findOrFail($request->id);
        $education->delete();

        return response()->json(['success' => 'Education data deleted successfully.']);
    }
}
