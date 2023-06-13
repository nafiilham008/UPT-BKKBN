<?php

namespace App\Http\Controllers;

use App\Models\Kediklatan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class KediklatanController extends Controller
{

    protected $imagePath = 'uploads/images/kediklatan/';

    public function __construct()
    {
        $this->middleware('permission:kediklatan view')->only('index', 'show');
        $this->middleware('permission:kediklatan create')->only('create', 'store');
        $this->middleware('permission:kediklatan edit')->only('edit', 'update');
        $this->middleware('permission:kediklatan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kediklatan = Kediklatan::all();

        return view('kediklatan.index', compact('kediklatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kediklatan = Kediklatan::all();

        $cekPhoto = false;

        if ($kediklatan->isEmpty()) {
            $cekPhoto = true;
        } else {
            foreach ($kediklatan as $item) {
                if ($item->photo) {
                    $cekPhoto = false;
                    break; // Hentikan perulangan jika ditemukan foto yang tidak kosong
                } else {
                    $cekPhoto = true;
                }
            }
        }

        // dd($cekPhoto);



        return view('kediklatan.create', compact('kediklatan', 'cekPhoto'));
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
            'description' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
            'description.required' => 'Link field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
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

        $kediklatan = Kediklatan::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'photo' => $validated['photo'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        if ($kediklatan) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.kediklatans.index')->with('success', __('The training was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.kediklatans.index')->with('error', __('Failed'));
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
        $kediklatan = Kediklatan::findOrFail($id);

        return view('kediklatan.show', compact('kediklatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kediklatan = Kediklatan::findOrFail($id);

        $cek = Kediklatan::all();
        $cekPhoto = false;

        if ($cek->isEmpty()) {
            $cekPhoto = true;
        } else {
            foreach ($cek as $item) {
                if ($item->photo) {
                    $cekPhoto = false;
                    break; // Hentikan perulangan jika ditemukan foto yang tidak kosong
                } else {
                    $cekPhoto = true;
                }
            }
        }


        return view('kediklatan.edit', compact('kediklatan', 'cekPhoto'));
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
        $kediklatan = Kediklatan::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Title field is required.',
            'link.required' => 'Link field is required.',
            'description.required' => 'Link field is required.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
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
            if ($kediklatan->photo != null && file_exists($oldphoto = public_path($this->imagePath .
                $kediklatan->photo))) {
                unlink($oldphoto);
            }

            $validated['photo'] = $filename;
        } else {
            $validated['photo'] = $kediklatan->photo;
        }

        $kediklatan->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'photo' => $validated['photo'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($kediklatan) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.kediklatans.index')->with('success', __('The training was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.kediklatans.index')->with('error', __('Failed'));
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
        $kediklatan = Kediklatan::findOrFail($id);


        // Delete all data
        $kediklatan->delete();

        if ($kediklatan) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.kediklatans.index')->with('success', __('The training was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.kediklatans.index')->with('error', __('Failed'));
        }
    }
}
