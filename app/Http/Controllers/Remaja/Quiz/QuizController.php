<?php

namespace App\Http\Controllers\Remaja\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Remaja\CategoryQuiz;
use App\Models\Remaja\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuizController extends Controller
{

    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:quiz view')->only('index', 'show');
        $this->middleware('permission:quiz create')->only('create', 'store');
        $this->middleware('permission:quiz edit')->only('edit', 'update');
        $this->middleware('permission:quiz delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with('category_quiz', 'users')
            ->get();

        return view('remaja.quiz.index', compact('quizzes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryQuiz::all();


        return view('remaja.quiz.create', compact('category'));
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
            'title' => 'required|unique:quizzes,title',
            'url' => 'required|unique:quizzes,url',
            'image' => 'nullable|mimes:jpeg,png,jpg|image|max:5120',
            'description' => 'nullable|string',
            'category_quiz_id' => 'required'
        ]);

        $slug_url = Str::slug($validated['title'], '-');
        $slug_url = Str::lower($slug_url);

        if ($request->hasFile('image')) {
            // $path = $request->file('image')->store('images/quiz');
            $filename = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs('images/quiz', $filename, 'public');
        } else {
            $path = null;
        }

        $quizCreate = Quiz::create([
            'title' => $validated['title'],
            'url' => $validated['url'], 
            'slug_url' => $slug_url, 
            'image' => $path,
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
            'category_quiz_id' => $validated['category_quiz_id'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($quizCreate) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.quizzes.index')->with('success', __('The quiz was posted successfully.'));
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.quizzes.index')->with('error', __('Failed'));
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
        $quiz = Quiz::with('users', 'category_quiz')->findOrFail($id);

        $linkYoutube = $quiz->url;
        $pattern = '/(?<=\?v=|\/embed\/|\/\d\/|\.be\/)[^&#?\/]+/';
        preg_match($pattern, $linkYoutube, $matches);
        $videoCode = null;

        if (!empty($matches)) {
            $videoCode = $matches[0];
        }

        return view('remaja.quiz.show', compact('quiz', 'videoCode'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::with('users', 'category_quiz')->findOrFail($id);

        $category = CategoryQuiz::all();

        return view('remaja.quiz.edit', compact('quiz', 'category'));
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
        $validated = $request->validate([
            'title' => 'required|unique:quizzes,title,' . $id,
            'url' => 'required|unique:quizzes,url,' . $id,
            'image' => 'nullable|mimes:jpeg,png,jpg|image|max:5120',
            'description' => 'nullable|string',
            'category_quiz_id' => 'required'
        ]);

        $quiz = Quiz::findOrFail($id);

        $slug_url = Str::slug($validated['title'], '-');
        $slug_url = Str::lower($slug_url);

        if ($request->hasFile('image')) {
            // Hapus file gambar lama
            if ($quiz->image) {
                Storage::disk('public')->delete($quiz->image);
            }

            $filename = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs('images/quiz', $filename, 'public');
        } else {
            $path = $quiz->image;
        }

        $quiz->title = $validated['title'];
        $quiz->url = $validated['url'];
        $quiz->slug_url = $slug_url;
        $quiz->image = $path;
        $quiz->description = $validated['description'];
        $quiz->category_quiz_id = $validated['category_quiz_id'];
        $quiz->updated_at = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        $quiz->save();

        if ($quiz) {
            return redirect()->route('dashboard.quizzes.index')->with('success', __('The quiz was updated successfully.'));
        } else {
            return redirect()->route('dashboard.quizzes.index')->with('error', __('Failed to update the quiz.'));
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
        $quiz = Quiz::findOrFail($id);

        // Hapus file gambar terkait
        if ($quiz->image) {
            Storage::disk('public')->delete($quiz->image);
        }

        // Hapus data Quiz
        $quiz->delete();

        if ($quiz) {
            return redirect()->route('dashboard.quizzes.index')->with('success', __('The Training quiz was deleted successfully.'));
        } else {
            return redirect()->route('dashboard.quizzes.index')->with('error', __('Failed'));
        }
    }
}
