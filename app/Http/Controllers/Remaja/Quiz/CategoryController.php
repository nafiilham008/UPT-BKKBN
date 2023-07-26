<?php

namespace App\Http\Controllers\Remaja\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Remaja\CategoryQuiz;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    // Construct for permission
    public function __construct()
    {
        $this->middleware('permission:quiz-category view')->only('index', 'show');
        $this->middleware('permission:quiz-category create')->only('create', 'store');
        $this->middleware('permission:quiz-category edit')->only('edit', 'update');
        $this->middleware('permission:quiz-category delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryQuiz::all();


        return view('remaja.category.index', compact('category'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:category_quizzes,title',
        ]);

        $category = CategoryQuiz::create([
            'title' => $validated['title'],
            'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        $category->save();

        return response()->json([
            'success' => 'Category data was saved successfully!',
        ]);
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
    public function edit($id)
    {
        $category = CategoryQuiz::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
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
        $category = CategoryQuiz::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|unique:category_quizzes,title,' . $id,
        ]);

        $category->update([
            'title' => $validated['title'],
            'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);

        if ($category) {
            return response()->json([
                'success' => 'Category data saved successfully!',
            ]);
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
        $category = CategoryQuiz::findOrFail($id);
        $category->delete();
        return response()->json(['success' => 'Category data deleted successfully.']);
    }

    public function getCategories()
    {
        $quizCategories = CategoryQuiz::all();

        return DataTables::of($quizCategories)
            ->addColumn('created_at', function ($quizCategories) {
                return \Carbon\Carbon::parse($quizCategories->created_at)->format('j F Y H:i');
            })
            ->addColumn('updated_at', function ($quizCategories) {
                return \Carbon\Carbon::parse($quizCategories->updated_at)->format('j F Y H:i');
            })
            ->addColumn('action', function ($quizCategories) {
                return '<td>' .
                    '<button type="button" class="btn btn-outline-primary btn-sm btn-edit" data-id="' . $quizCategories->id .
                    '" data-bs-toggle="modal" data-bs-target="#exampleModalScrollableEdit' .
                    $quizCategories->id .
                    '" data-bs-backdrop="static"><i class="fa fa-pencil-alt"></i></button>' .
                    '<button type="button" id="delete-category" class="btn btn-outline-danger btn-sm" data-id="' .
                    $quizCategories->id .
                    '"><i class="fa fa-trash-alt"></i></button>' .
                    '</td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function refreshData()
    {
        $category = CategoryQuiz::all();

        return $category;
    }
}
