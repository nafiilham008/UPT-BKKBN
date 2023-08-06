<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    protected $avatarPath = '/uploads/images/avatars/';

    public function __construct()
    {
        $this->middleware('permission:user view')->only('index', 'show');
        $this->middleware('permission:user create')->only('create', 'store');
        $this->middleware('permission:user edit')->only('edit', 'update');
        $this->middleware('permission:user delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles:id,name');

            return Datatables::of($users)
                ->editColumn('created_at', function($user){
                    return $user->created_at;
                })
                ->editColumn('updated_at', function($user){
                    return $user->updated_at;
                })
                ->addColumn('action', 'users.include.action')
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->toArray() !== [] ? $row->getRoleNames()[0] : '-';
                })
                ->addColumn('avatar', function ($row) {
                    if ($row->avatar == null) {
                        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($row->email))) . '&s=500';
                    }
                    return asset('storage/' . $row->avatar);
                })
                ->toJson();
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $attr = $request->validated();

        if ($request->file('avatar') && $request->file('avatar')->isValid()) {

            $filename = $request->file('avatar')->hashName();
            $path = $request->file('avatar')->storeAs('images/profile/user', $filename, 'public');
        }  else {
            $path = null;
        }

        $attr['password'] = bcrypt($request->password);
        $attr['avatar'] = $path;
        $attr['email_verified_at'] = now();

        $user = User::create($attr);

        $user->assignRole($request->role);

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', __('The user was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles:id,name');

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles:id,name');

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $attr = $request->validated();
    
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // Hapus file gambar lama
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $filename = $request->file('avatar')->hashName();
            $path = $request->file('avatar')->storeAs('images/profile/user', $filename, 'public');
        } else {
            $path = $user->avatar;
        }


        // switch (is_null($request->password)) {
        //     case true:
        //         unset($attr['password']);
        //         break;
        //     default:
        //         $attr['password'] = bcrypt($request->password);
        //         break;
        // }

        $attr['avatar'] = $path;

        $user->update($attr);

        $user->syncRoles($request->role);

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', __('The user was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath . $user->avatar))) {
            unlink($oldAvatar);
        }

        $user->delete();

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', __('The user was deleted successfully.'));
    }
}
