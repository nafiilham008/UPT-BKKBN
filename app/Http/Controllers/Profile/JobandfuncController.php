<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Jobandfunc;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class JobandfuncController extends Controller
{
    /**
     * Path for jobandfunc content file.
     *
     * @var string
     */
    protected $imagePath = 'uploads/images/profile/jobandfunction/';

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:jobandfunc view')->only('index', 'show');
        $this->middleware('permission:jobandfunc create')->only('create', 'store');
        $this->middleware('permission:jobandfunc edit')->only('edit', 'update');
        $this->middleware('permission:jobandfunc delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobandfunc = Jobandfunc::all();

        return view('profile.jobandfunc.index', compact('jobandfunc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobandfunc = Jobandfunc::all();

        if ($jobandfunc->count() == 1) {
            return redirect()->route('dashboard.jobandfuncs.index')->with('error', __('Job and function already exists'));
        } else {
            return view('profile.jobandfunc.create', compact('jobandfunc'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobandfunc = Jobandfunc::all();
        if ($jobandfunc->count() == 1) {
            return redirect()->route('dashboard.jobandfuncs.index')->with('error', __('Job and function already exists'));
        } else {
            $validated = $request->validate(
                [
                    'title' => 'required|unique:jobandfuncs',
                    'description' => 'required|min:10',
                ],
                [
                    'description.min' => 'Required min 10 characters',
                ]
            );

            // Dom list for value summernote
            $description = $validated['description'];
            $dom = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<?xml encoding="UTF-8">' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');

                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/uploads/images/profile/image-content-jobandfunc/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.html';
            $dom->saveHTMLFile($tempFilePath);
            $description = file_get_contents($tempFilePath);
            unlink($tempFilePath);


            $jobandfuncCreate = Jobandfunc::create([
                'title' => $validated['title'],
                'description' => $description,
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')

            ]);


            if ($jobandfuncCreate) {
                //redirect dengan pesan sukses
                return redirect()->route('dashboard.jobandfuncs.index')->with('success', __('The Job and function was posted successfully.'));
            } else {
                //redirect dengan pesan error
                return redirect()->route('dashboard.jobandfuncs.index')->with('error', __('Failed'));
            }
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
        $jobandfunc = Jobandfunc::findOrFail($id);

        return view('profile.jobandfunc.show', compact('jobandfunc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobandfunc = Jobandfunc::findOrFail($id);

        return view('profile.jobandfunc.edit', compact('jobandfunc'));
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
        $jobandfunc = Jobandfunc::findOrFail($id);

        $validated = $request->validate(
            [
                'title' => 'required',
                'description' => 'required|min:10',
            ],
            [
                'description.min' => 'Required min 10 characters',
            ]
        );

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        $jobandfunc->update([
            'title' => $validated['title'],
            'description' => $description,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);


        if ($jobandfunc) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.jobandfuncs.index')->with('success', __('The Job and function was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.jobandfuncs.index')->with('error', __('Failed'));
        }
    }

    public function summernoteUpdate($description)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');

            // Check if the image is from a URL or base64 data
            if (Str::startsWith($data, 'data:image')) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/uploads/images/profile/image-content-jobandfunc/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.html';
        $dom->saveHTMLFile($tempFilePath);
        $updatedDescription = file_get_contents($tempFilePath);
        unlink($tempFilePath);

        return $updatedDescription;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobandfunc = Jobandfunc::findOrFail($id);
        
        // Check Image
        $description = $jobandfunc->description;
        $result = strstr($description, 'src="/uploads/images/profile/image-content-jobandfunc/');

        $result = explode('src="/uploads/images/profile/image-content-jobandfunc/', $result);
        $img_src = array();
        foreach ($result as $img) {
            $img_src[] = explode('"', $img)[0];
        }
        $img_src = array_filter($img_src);

        foreach ($img_src as $key => $value) {
            // Delete image from local
            $image = public_path('uploads/images/profile/image-content-jobandfunc/' . $value);
            unlink($image);
        }

        // Delete all data
        $jobandfunc->delete();

        if ($jobandfunc) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.jobandfuncs.index')->with('success', __('The History was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.jobandfuncs.index')->with('error', __('Failed'));
        }
    }
}
