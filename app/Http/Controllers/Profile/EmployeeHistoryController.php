<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\EmployeeHistory;
use Illuminate\Http\Request;

class EmployeeHistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'company_name' => ['required', 'string', 'max:255'],
                'start_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
                'end_year' => ['nullable', 'numeric', 'min:1960', 'max:' . date('Y'), 'gt:start_year'],
                'position' => ['nullable', 'string', 'max:255'],
                'job_desc' => ['nullable', 'string'],
            ]);
            

            // Create a new Education instance
            $employee_history = new EmployeeHistory([
                'company_name' => $validatedData['company_name'],
                'start_year' => $validatedData['start_year'],
                'end_year' => $validatedData['end_year'],
                'position' => $validatedData['position'],
                'job_desc' => $validatedData['job_desc'],
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'employee_id' => $id,
            ]);

            // Save the Education instance to the database
            $employee_history->save();

            // return $refreshData;

            // Send success response with success message
            return response()->json([
                'success' => 'Employee History data saved successfully!',
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
    public function edit($id, $employeeHistoryId)
    {
        $employee_history = EmployeeHistory::where('id', $employeeHistoryId)
            ->where('employee_id', $id)
            ->first();

        return response()->json([
            'success' => true,
            'employee_history' => $employee_history
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $employeeHistoryId)
    {
        try {
            $validatedData = $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'start_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
                'end_year' => ['nullable', 'numeric', 'min:1960', 'max:' . date('Y'), 'gt:start_year'],
                'position' => ['nullable', 'string', 'max:255'],
                'job_desc' => ['nullable', 'string'],
            ]);

            $employeeHistory = EmployeeHistory::where('id', $employeeHistoryId)->where('employee_id', $id)->first();
            
            if (!$employeeHistory) {
                return response()->json(['error' => 'Employee History data not found!']);
            }

            // Update
            $employeeHistory->company_name = $validatedData['company_name'];
            $employeeHistory->start_year = $validatedData['start_year'];
            $employeeHistory->end_year = $validatedData['end_year'];
            $employeeHistory->position = $validatedData['position'];
            $employeeHistory->job_desc = $validatedData['job_desc'];
            $employeeHistory->updated_at = now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');

            $employeeHistory->save();

            // return $refreshData;

            // Send success response with success message
            return response()->json([
                'success' => 'Employee History data saved successfully!',
            ]);
        } catch (\Exception $e) {
            // Send error response with error message
            return response()->json(['error' => $e->getMessage()])
                ->setStatusCode(500, 'Failed to update education data. ' . $e->getMessage());
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
        try {
            $employeeHistory = EmployeeHistory::findOrFail($request->id);
            $employeeHistory->delete();
            return response()->json(['success' => 'Employee History data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
