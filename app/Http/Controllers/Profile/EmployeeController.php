<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:employees',
                'position' => 'required',
                'nip' => 'required',
                'photo' => 'mimes:jpeg,png,jpg|image|max:2048',
            ],
            [
                'photo.mimes' => 'Required image JPEG, PNG, or JPG'
            ]
        );

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
            'photo' => $validated['photo'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

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
        $employee = Employee::find($id);

        return view('profile.employee.edit', compact('employee'));
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
        $employee = Employee::find($id);
        $validated = $request->validate(
            [
                'name' => 'required',
                'position' => 'required',
                'nip' => 'required',
                'photo' => 'mimes:jpeg,png,jpg|image|max:2048',
            ],
            [
                'photo.mimes' => 'Required image JPEG, PNG, or JPG'
            ]
        );

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
            'nip' => $validated['nip'],
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
