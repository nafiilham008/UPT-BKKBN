<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\EducationHistory;
use App\Models\Profile\Employee;
use App\Models\Profile\EmployeeHistory;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;



class EmployeeController extends Controller
{
    /**
     * Path for employee content file.
     *
     * @var string
     */
    protected $imagePath = 'uploads/images/profile/employee-photo/';


    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:employee view')->only('index', 'show');
        $this->middleware('permission:employee create')->only('create', 'store');
        $this->middleware('permission:employee edit')->only('edit', 'update');
        $this->middleware('permission:employee delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return view('profile.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::all();

        $type_employee = Constant::TYPE_OF_EMPLOYEE;

        return view('profile.employee.create', compact('employee', 'type_employee'));
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
            'name' => 'required|unique:employees,name',
            'email' => 'nullable|unique:employees,email',
            'place_of_birth' => 'nullable',
            'birthdate' => 'nullable|date_format:Y-m-d|before:today',
            'position' => 'required',
            'nip' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|mimes:jpeg,png,jpg|image|max:2048',
            'awards' => 'nullable|array', 
            'awards.*' => 'nullable|string', 
            'phone_number' => 'nullable',
            'type_employee' => 'required',
            'rank_group' => 'nullable'
        ], [
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name has already been taken.',
            'email.unique' => 'Email has already been taken.',
            'birthdate.date_format' => 'Birthdate must be in the format YYYY-MM-DD.',
            'birthdate.before' => 'Birthdate must be before today.',
            'position.required' => 'Position field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg.',
            'photo.image' => 'The file must be an image.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'awards.array' => 'Awards must be an array.',
            'awards.*.string' => 'Each award must be a string.',
            'type_employee.required' => 'Type of Employee must be filled.'
        ]);
        



        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();

            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->imagePath . $filename);

            $validated['photo'] = $filename;
        } else {
            $validated['photo'] = null;
        }

        $employeeCreate = Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'place_of_birth' => $validated['place_of_birth'],
            'birthdate' => $validated['birthdate'],
            'position' => $validated['position'],
            'nip' => $validated['nip'],
            'address' => $validated['address'],
            'photo' => $validated['photo'],
            'awards' => json_encode($validated['awards']), 
            'phone_number' => $validated['phone_number'],
            'type_employee' => $validated['type_employee'],
            'rank_group' => $validated['rank_group'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);
        

        if ($employeeCreate) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.employees.index')->with('success', __('The employee was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.employees.index')->with('error', __('Failed'));
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
        $employee = Employee::findOrFail($id);

        return view('profile.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $educationHistory = EducationHistory::where('employee_id', $id)->orderBy('created_at', 'desc')->get();
        $employeeHistory = EmployeeHistory::where('employee_id', $id)->orderBy('created_at', 'desc')->get();

        $type_employee = Constant::TYPE_OF_EMPLOYEE;

        $awards = json_decode($employee->awards, true);

        return view('profile.employee.edit', compact('employee', 'educationHistory', 'type_employee', 'employeeHistory', 'awards'));
    }

    public function getEducationHistory($id)
    {
        $educationHistory = EducationHistory::where('employee_id', $id)->get();

        return Datatables::of($educationHistory)
            ->addColumn('created_at', function ($educationHistory) {
                return \Carbon\Carbon::parse($educationHistory->created_at)->format('j F Y H:i');
            })
            ->addColumn('action', function ($educationHistory) {
                $employeeId = $educationHistory->employee_id;
                return '<td>' .
                    '<button type="button" class="btn btn-outline-primary btn-sm btn-edit" data-employee-id="' .
                    $employeeId . '" data-id="' . $educationHistory->id .
                    '" data-bs-toggle="modal" data-bs-target="#exampleModalScrollableEdit' .
                    $educationHistory->id .
                    '" data-bs-backdrop="static"><i class="fa fa-pencil-alt"></i></button>'.
                    '<button type="button" id="delete-education" class="btn btn-outline-danger btn-sm" data-id="' .
                    $educationHistory->id .
                    '"><i class="fa fa-trash-alt"></i></button>' .
                    '</td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getEmployeeHistory($id)
    {
        $employeeHistory = EmployeeHistory::where('employee_id', $id)->get();

        return Datatables::of($employeeHistory)
            ->addColumn('created_at', function ($employeeHistory) {
                return \Carbon\Carbon::parse($employeeHistory->created_at)->format('j F Y H:i');
            })
            ->addColumn('action', function ($employeeHistory) {
                $employeeId = $employeeHistory->employee_id;
                return '<td>' .
                    '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-employee-history" data-employee-id="' .
                    $employeeId . '" data-id="' . $employeeHistory->id .
                    '" data-bs-toggle="modal" data-bs-target="#modalEmployeeHistoryEdit' .
                    $employeeHistory->id .
                    '" data-bs-backdrop="static"><i class="fa fa-pencil-alt"></i></button>'.
                    '<button type="button" id="delete-employee-history" class="btn btn-outline-danger btn-sm" data-id="' .
                    $employeeHistory->id .
                    '"><i class="fa fa-trash-alt"></i></button>' .
                    '</td>';
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:employees,name,' . $id,
            'email' => 'nullable|unique:employees,email,' . $id,
            'place_of_birth' => 'nullable',
            'birthdate' => 'nullable|date_format:Y-m-d|before:today',
            'position' => 'required',
            'nip' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|mimes:jpeg,png,jpg|image|max:2048',
            'awards' => 'nullable|array', 
            'awards.*' => 'nullable|string', 
            'phone_number' => 'nullable',
            'type_employee' => 'required',
            'rank_group' => 'nullable'
        ], [
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name has already been taken.',
            'email.unique' => 'Email has already been taken.',
            'birthdate.date_format' => 'Birthdate must be in the format YYYY-MM-DD.',
            'birthdate.before' => 'Birthdate must be before today.',
            'position.required' => 'Position field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg.',
            'photo.image' => 'The file must be an image.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'type_employee.required' => 'Type of Employee must be fill.'
        ]);

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $filename = $request->file('photo')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->imagePath) . $filename);

            // delete old avatar from storage
            if ($employee->photo != null && file_exists($oldphoto = public_path($this->imagePath .
                $employee->photo))) {
                unlink($oldphoto);
            }

            $validated['photo'] = $filename;
        } else {
            $validated['photo'] = $employee->photo;
        }

        $employee->update([
            'name' => $validated['name'],
            'photo' => $validated['photo'],
            'email' => $validated['email'],
            'place_of_birth' => $validated['place_of_birth'],
            'birthdate' => $validated['birthdate'],
            'position' => $validated['position'],
            'nip' => $validated['nip'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'type_employee' => $validated['type_employee'],
            'rank_group' => $validated['rank_group'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);
        
        if (isset($validated['awards'])) {
            $employee->awards = json_encode($validated['awards']);
        }
        
        $employee->save();
        

        if ($employee) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.employees.index')->with('success', __('The employee was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.employees.index')->with('error', __('Failed'));
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
        $employee = Employee::findOrFail($id);
        if ($employee->photo != null && file_exists($oldphoto = public_path($this->imagePath . $employee->photo))) {
            unlink($oldphoto);
        }

        // Delete all data
        $employee->delete();

        if ($employee) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.employees.index')->with('success', __('The employee was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.employees.index')->with('error', __('Failed'));
        }
    }
}
