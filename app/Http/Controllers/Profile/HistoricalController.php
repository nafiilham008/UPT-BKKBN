<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Historical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;



class HistoricalController extends Controller
{
    /**
     * Path for historical content file.
     *
     * @var string
     */

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:historical view')->only('index', 'show');
        $this->middleware('permission:historical create')->only('create', 'store');
        $this->middleware('permission:historical edit')->only('edit', 'update');
        $this->middleware('permission:historical delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = Historical::all();

        return view('profile.historical.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $history = Historical::all();

        if ($history->count() == 1) {
            return redirect()->route('dashboard.historicals.index')->with('error', __('History already exists'));
        } else {
            return view('profile.historical.create', compact('history'));
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
        $history = Historical::all();
        if ($history->count() == 1) {
            return redirect()->route('dashboard.historicals.index')->with('error', __('History already exists'));
        } else {
            $validated = $request->validate(
                [
                    'title' => 'required|unique:historicals',
                    'thumbnail' => 'required|mimes:jpeg,png,jpg|image|max:2048',
                    'description' => 'required|min:10',
                ],
                [
                    'description.min' => 'Required min 10 characters',
                    'thumbnail.mimes' => 'Required image JPEG, PNG, or JPG'
                ]
            );

            if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {
                $filename = $request->file('thumbnail')->hashName();
                $pathThumbnail = $request->file('thumbnail')->storeAs('images/profile/history', $filename, 'public');
            } else {
                $pathThumbnail = null;
            }


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
                $image_name = "/uploads/images/profile/image-content-history/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.html';
            $dom->saveHTMLFile($tempFilePath);
            $description = file_get_contents($tempFilePath);
            unlink($tempFilePath);


            $historyCreate = Historical::create([
                'title' => $validated['title'],
                'thumbnail' => $pathThumbnail,
                'description' => $description,
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]);


            if ($historyCreate) {
                //redirect dengan pesan sukses
                return redirect()->route('dashboard.historicals.index')->with('success', __('The History was posted successfully.'));
            } else {
                //redirect dengan pesan error
                return redirect()->route('dashboard.historicals.index')->with('error', __('Failed'));
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
        $history = Historical::findOrFail($id);

        return view('profile.historical.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $history = Historical::findOrFail($id);

        return view('profile.historical.edit', compact('history'));
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
        $history = Historical::findOrFail($id);
        $validated = $request->validate(
            [
                'title' => 'required',
                'thumbnail' => 'mimes:jpeg,png,jpg|image|max:2048',
                'description' => 'required|min:10',
            ],
            [
                'description.min' => 'Required min 10 characters',
                'thumbnail.mimes' => 'Required image JPEG, PNG, or JPG'
            ]
        );

        if ($request->hasFile('thumbnail')) {
            // Hapus file gambar lama
            if ($history->thumbnail) {
                Storage::disk('public')->delete($history->thumbnail);
            }

            $filename = $request->file('thumbnail')->hashName();
            $pathThumbnail = $request->file('thumbnail')->storeAs('images/profile/history', $filename, 'public');
        } else {
            $pathThumbnail = $history->thumbnail;
        }

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        $history->update([
            'title' => $validated['title'],
            'thumbnail' => $pathThumbnail,
            'description' => $description,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);


        if ($history) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.historicals.index')->with('success', __('The history was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.historicals.index')->with('error', __('Failed'));
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
                $image_name = "/uploads/images/profile/image-content-history/" . time() . $k . '.png';
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
        $history = Historical::findOrFail($id);
        if ($history->thumbnail) {
            Storage::disk('public')->delete($history->thumbnail);
        }


        // Check Image
        $description = $history->description;
        $result = strstr($description, 'src="/uploads/images/profile/image-content-history/');

        $result = explode('src="/uploads/images/profile/image-content-history/', $result);
        $img_src = array();
        foreach ($result as $img) {
            $img_src[] = explode('"', $img)[0];
        }
        $img_src = array_filter($img_src);

        foreach ($img_src as $key => $value) {
            // Delete image from local
            $image = public_path('uploads/images/profile/image-content-history/' . $value);
            unlink($image);
        }

        // Delete all data
        $history->delete();

        if ($history) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.historicals.index')->with('success', __('The History was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.historicals.index')->with('error', __('Failed'));
        }
    }
}
