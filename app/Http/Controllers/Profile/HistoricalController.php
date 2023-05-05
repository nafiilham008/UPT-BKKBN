<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Historical;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;



class HistoricalController extends Controller
{
    /**
     * Path for historical content file.
     *
     * @var string
     */
    protected $imagePath = 'uploads/images/profile/history/';

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
            return redirect()->route('historicals.index')->with('error', __('History already exists'));
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
            return redirect()->route('historicals.index')->with('error', __('History already exists'));
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

                if (!file_exists($folder = public_path($this->imagePath))) {
                    mkdir($folder, 0777, true);
                }

                Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($this->imagePath . $filename);

                $validated['thumbnail'] = $filename;
            }


            // Dom list for value summernote
            $description = $validated['description'];
            $dom = new \DomDocument();
            $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/uploads/images/profile/image-content-history/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $description = $dom->saveHTML();


            $historyCreate = Historical::create([
                'title' => $validated['title'],
                'thumbnail' => $validated['thumbnail'],
                'description' => $description,
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]);


            if ($historyCreate) {
                //redirect dengan pesan sukses
                return redirect()->route('historicals.index')->with('success', __('The History was posted successfully.'));
            } else {
                //redirect dengan pesan error
                return redirect()->route('historicals.index')->with('error', __('Failed'));
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

        if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {

            $filename = $request->file('thumbnail')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->imagePath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->imagePath) . $filename);

            // delete old avatar from storage
            if ($history->thumbnail != null && file_exists($oldThumbnail = public_path($this->imagePath .
                $history->thumbnail))) {
                unlink($oldThumbnail);
            }

            $validated['thumbnail'] = $filename;
        } else {
            $validated['thumbnail'] = $history->thumbnail;
        }

        // Call func summernoteUpdate with params desc
        $description = $this->summernoteUpdate($validated['description']);

        $history->update([
            'title' => $validated['title'],
            'thumbnail' => $validated['thumbnail'],
            'description' => $description,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);


        if ($history) {
            //redirect dengan pesan sukses
            return redirect()->route('historicals.index')->with('success', __('The history was updated successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('historicals.index')->with('error', __('Failed'));
        }
    }

    public function summernoteUpdate($description)
    {
        $dom = new \DomDocument();

        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            $count = Str::length($data);
            // check image before
            if ($count > 100) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/uploads/images/profile/image-content-history/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $description = $dom->saveHTML();
        return $description;
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
        if ($history->thumbnail != null && file_exists($oldThumbnail = public_path($this->imagePath . $history->thumbnail))) {
            unlink($oldThumbnail);
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
            return redirect()->route('historicals.index')->with('success', __('The History was deleted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('historicals.index')->with('error', __('Failed'));
        }

        // if ($history->thumbnail != null && file_exists($oldThumbnail = public_path($this->imagePath . $history->thumbnail))) {
        //     unlink($oldThumbnail);
        // }

        // // Check Image
        // $description = $history->description;
        // $result = strstr($description, 'src="/uploads/images/image-content/');

        // $result = explode('src="/uploads/images/image-content/', $result);
        // $img_src = array();
        // foreach ($result as $img) {
        //     $img_src[] = explode('"', $img)[0];
        // }
        // $img_src = array_filter($img_src);

        // foreach ($img_src as $key => $value) {
        //     // Delete image from local
        //     $image = public_path('uploads/images/image-content/' . $value);
        //     unlink($image);
        // }

        // // Delete all data
        // $history->delete();

        // if ($history) {
        //     //redirect dengan pesan sukses
        //     return redirect()->route('historicals.index')->with('success', __('The history was deleted successfully.'));
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('historicals.index')->with('error', __('Failed'));
        // }
    }
}
