<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\EducationHistory;
use App\Models\Profile\Employee;
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

        return view('profile.employee.create', compact('employee'));
    }

    // public function storeTemporary(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'institution_name' => ['required', 'string', 'max:255'],
    //         'degree' => ['required', 'string', 'max:255'],
    //         'graduation_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
    //         'major' => ['nullable', 'string', 'max:255'],
    //         'gpa' => ['nullable', 'numeric', 'between:0.00,4.00'],
    //         'description' => ['nullable', 'string'],
    //     ]);

    //     $educationHistory = session('educationHistory', []);

    //     // Pengecekan apakah data sudah ada di session
    //     $isDuplicate = false;
    //     foreach ($educationHistory as $education) {
    //         if (
    //             $education['institution_name'] == $validatedData['institution_name'] &&
    //             $education['degree'] == $validatedData['degree'] &&
    //             $education['graduation_year'] == $validatedData['graduation_year'] &&
    //             $education['major'] == $validatedData['major'] &&
    //             $education['gpa'] == $validatedData['gpa'] &&
    //             $education['description'] == $validatedData['description']
    //         ) {
    //             $isDuplicate = true;
    //             break;
    //         }
    //     }

    //     // Jika tidak ada data duplikat, maka data baru akan ditambahkan ke session
    //     if (!$isDuplicate) {
    //         $educationHistory[] = [
    //             'institution_name' => $validatedData['institution_name'],
    //             'degree' => $validatedData['degree'],
    //             'graduation_year' => $validatedData['graduation_year'],
    //             'major' => $validatedData['major'],
    //             'gpa' => $validatedData['gpa'],
    //             'description' => $validatedData['description'],
    //         ];
    //         session(['educationHistory' => $educationHistory]);
    //     }

    //     return response()->json([
    //         'message' => 'Education data saved successfully!',
    //         'data' => $educationHistory
    //     ]);
    // }

    // public function updateTemporary(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'institution_name' => ['required', 'string', 'max:255'],
    //         'degree' => ['required', 'string', 'max:255'],
    //         'graduation_year' => ['required', 'numeric', 'min:1960', 'max:' . date('Y')],
    //         'major' => ['nullable', 'string', 'max:255'],
    //         'gpa' => ['nullable', 'numeric', 'between:0.00,4.00'],
    //         'description' => ['nullable', 'string'],
    //     ]);

    //     $educationHistory = session('educationHistory', []);

    //     $education_id = $request->input('id');

    //     // Cari index riwayat pendidikan yang akan diupdate
    //     $indexToUpdate = -1;
    //     for ($i = 0; $i < count($educationHistory); $i++) {
    //         if ($educationHistory[$i]['id'] == $education_id) {
    //             $indexToUpdate = $i;
    //             break;
    //         }
    //     }

    //     if ($indexToUpdate < 0) {
    //         // Jika tidak ditemukan riwayat pendidikan dengan id yang sesuai, kirim response error
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Data riwayat pendidikan tidak ditemukan'
    //         ], 404);
    //     }

    //     // Update data riwayat pendidikan
    //     $educationHistory[$indexToUpdate]['institution_name'] = $validatedData['institution_name'];
    //     $educationHistory[$indexToUpdate]['degree'] = $validatedData['degree'];
    //     $educationHistory[$indexToUpdate]['graduation_year'] = $validatedData['graduation_year'];
    //     $educationHistory[$indexToUpdate]['major'] = $validatedData['major'];
    //     $educationHistory[$indexToUpdate]['gpa'] = $validatedData['gpa'];
    //     $educationHistory[$indexToUpdate]['description'] = $validatedData['description'];

    //     // Simpan data riwayat pendidikan yang sudah diupdate ke session
    //     session(['educationHistory' => $educationHistory]);

    //     // Kirim response success
    //     return response()->json([
    //         'success' => true,
    //         'data' => $educationHistory
    //     ]);
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:employees',
            'position' => 'required',
            'nip' => 'required',
            'birthdate' => 'nullable|date_format:Y-m-d|before:today',
            'awards' => 'nullable|string',
            'photo' => 'mimes:jpeg,png,jpg|image|max:2048',
        ], [
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name has already been taken.',
            'position.required' => 'Position field is required.',
            'nip.required' => 'NIP field is required.',
            'birthdate.date_format' => 'Birthdate must be in the format YYYY-MM-DD.',
            'birthdate.before' => 'Birthdate must be before today.',
            'awards.string' => 'Awards must be a string.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg.',
            'photo.image' => 'The file must be an image.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.'
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
            'position' => $validated['position'],
            'nip' => $validated['nip'],
            'birthdate' => $validated['birthdate'],
            'awards' => $validated['awards'],
            'photo' => $validated['photo'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);


        // Simpan data education history dari session ke database
        $educationHistory = session('educationHistory', []);
        foreach ($educationHistory as $edu) {
            $education = new EducationHistory();
            $education->employee_id = $employeeCreate->id;
            $education->institution_name = $edu['institution_name'];
            $education->degree = $edu['degree'];
            $education->graduation_year = $edu['graduation_year'];
            $education->major = $edu['major'];
            $education->gpa = $edu['gpa'];
            $education->description = $edu['description'];
            $education->save();
        }

        if ($employeeCreate) {
            //redirect dengan pesan sukses
            return redirect()->route('employees.index')->with('success', __('The employee was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('employees.index')->with('error', __('Failed'));
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
        $employee = Employee::find($id);

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


        return view('profile.employee.edit', compact('employee', 'educationHistory'));
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
                    '<button type="button" class="btn btn-outline-primary btn-sm" data-employee-id="' .
                    $employeeId . '" data-id="' . $educationHistory->id .
                    '" data-bs-toggle="modal" data-bs-target="#exampleModalScrollableEdit' .
                    $educationHistory->id .
                    '" data-bs-backdrop="static"><i class="fa fa-pencil-alt"></i></button>' .
                    '<button type="button" id="delete-education" class="btn btn-outline-danger btn-sm" data-id="' .
                    $educationHistory->id .
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
            'position' => 'required',
            'nip' => 'required',
            'birthdate' => 'nullable|date_format:Y-m-d|before:today',
            'awards' => 'nullable|string',
            'photo' => 'mimes:jpeg,png,jpg|image|max:2048',
        ], [
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name has already been taken.',
            'position.required' => 'Position field is required.',
            'nip.required' => 'NIP field is required.',
            'birthdate.date_format' => 'Birthdate must be in the format YYYY-MM-DD.',
            'birthdate.before' => 'Birthdate must be before today.',
            'awards.string' => 'Awards must be a string.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg.',
            'photo.image' => 'The file must be an image.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.'
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
            'position' => $validated['position'],
            'birthdate' => $validated['birthdate'],
            'nip' => $validated['nip'],
            'awards' => $validated['awards'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($employee) {
            //redirect dengan pesan sukses
            return redirect()->route('employees.index')->with('success', __('The employee was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('employees.index')->with('error', __('Failed'));
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
        $employee = Employee::find($id);
        if ($employee->photo != null && file_exists($oldphoto = public_path($this->imagePath . $employee->photo))) {
            unlink($oldphoto);
        }

        // Delete all data
        $employee->delete();

        if ($employee) {
            //redirect dengan pesan sukses
            return redirect()->route('employees.index')->with('success', __('The employee was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('employees.index')->with('error', __('Failed'));
        }
    }
}
