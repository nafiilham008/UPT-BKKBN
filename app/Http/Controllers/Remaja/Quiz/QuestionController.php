<?php

namespace App\Http\Controllers\Remaja\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Remaja\Question;
use App\Models\Remaja\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    // Permission
    public function __construct()
    {
        $this->middleware('permission:question view')->only('index', 'show');
        $this->middleware('permission:question create')->only('create', 'store');
        $this->middleware('permission:question edit')->only('edit', 'update');
        $this->middleware('permission:question delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $question = Quiz::with('users', 'category_quiz')->findOrFail($id);

        $questions = Question::with('quiz', 'users')
            ->where('quiz_id', $id)
            ->get();


        return view('remaja.question.index', compact('question', 'questions'));
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
    public function store($id, Request $request)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'options' => 'required|array|min:1',
                'options.*' => 'required|string',
                'correct_answers' => 'nullable|array',
                'correct_answers.*' => 'nullable|boolean',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                'description' => 'nullable|string',
            ]);

            if (count($request->options) !== count($request->correct_answers)) {
                $correctAnswers = array_pad($request->correct_answers, count($request->options), 0);
            } else {
                $correctAnswers = $request->correct_answers;
            }

            $trueCount = 0;
            $falseCount = 0;
            if (is_array($correctAnswers)) {
                foreach ($correctAnswers as $answer) {
                    if ($answer) {
                        $trueCount++;
                    } else {
                        $falseCount++;
                    }
                }
            }

            if ($trueCount < 1 || $falseCount < 1) {
                return response()->json([
                    'error' => 'There must be at least one true and one false answer.',
                ], 500);
            }

            $optionsData = [];
            foreach ($request->options as $index => $option) {
                $isCorrect = isset($correctAnswers[$index]) ? $correctAnswers[$index] : false;
                $optionsData[] = [
                    'value' => $option,
                    'is_correct' => $isCorrect,
                ];
            }

            // if ($trueCount < 1 || $falseCount < 1) {
            //     return response()->json([
            //         'error' => 'There must be at least one true and one false answer.',
            //     ], 500);
            // }

            if ($request->hasFile('image')) {
                // $path = $request->file('image')->store('images/quiz');
                $filename = $request->file('image')->hashName();
                $path = $request->file('image')->storeAs('images/question', $filename, 'public');
            } else {
                $path = null;
            }

            $question = Question::create([
                'quiz_id' => $id,
                'user_id' => auth()->user()->id,
                'question' => $request->question,
                'options' => json_encode($optionsData),
                'image' => $path,
                'description' => $request->description,
                'created_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ]);
            $question->save();


            if ($question) {
                return response()->json([
                    'success' => 'Question data saved successfully!',
                ]);
            } else {
                return response()->json([
                    'error' => 'Failed to save question data.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $question_id)
    {
        $question = Question::where('id', $question_id)
            ->where('quiz_id', $id)
            ->first();

        return view('remaja.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, $question_id)
    {

        // dd($request->all());
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string',
            'correct_answers' => 'nullable|array',
            'correct_answers.*' => 'nullable|boolean',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
        ]);

        $question = Question::where('id', $question_id)
            ->where('quiz_id', $id)
            ->first();

        if (!$question) {
            return redirect()->route('dashboard.questions', $id)->with('error', __('Question not found.'));
        }

        if (count($request->options) !== count($request->correct_answers)) {
            // Isi array correct_answers dengan 0 (false) untuk setiap elemen yang tidak ada
            $correctAnswers = array_pad($request->correct_answers, count($request->options), 0);
        } else {
            $correctAnswers = $request->correct_answers;
        }

        $trueCount = 0;
        $falseCount = 0;
        if (is_array($correctAnswers)) {
            foreach ($correctAnswers as $answer) {
                if ($answer) {
                    $trueCount++;
                } else {
                    $falseCount++;
                }
            }
        }

        if ($trueCount < 1 || $falseCount < 1) {
            return redirect()->route('dashboard.questions', $question->quiz_id)->with('error', __('There must be at least one true and one false answer.'));
        }

        $optionsData = [];
        foreach ($request->options as $index => $option) {
            $isCorrect = isset($correctAnswers[$index]) ? $correctAnswers[$index] : false;
            $optionsData[] = [
                'value' => $option,
                'is_correct' => $isCorrect,
            ];
        }

        if ($request->hasFile('image')) {
            // Hapus file gambar lama
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }

            $filename = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs('images/question', $filename, 'public');
            $question->image = $path;
        }

        $question->question = $request->question;
        $question->description = $request->description;
        $question->options = json_encode($optionsData);
        $question->updated_at = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        if ($question->save()) {
            return redirect()->route('dashboard.questions', $question->quiz_id)->with('success', __('The question was updated successfully.'));
        } else {
            return redirect()->route('dashboard.questions', $question->quiz_id)->with('error', __('Failed to update the question.'));
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $question_id)
    {
        $question = Question::where('id', $question_id)
            ->where('quiz_id', $id)
            ->first();

        if (!$question) {
            return redirect()->route('dashboard.questions', $id)->with('error', __('Question not found.'));
        }

        if ($question->image) {
            Storage::disk('public')->delete($question->image);
        }

        $question->delete();

        return redirect()->route('dashboard.questions', $id)->with('success', __('The question was deleted successfully.'));
    }

    public function getQuestion($id)
    {
        $questions = Question::with('quiz', 'users')
            ->where('quiz_id', $id)
            ->get();

        return DataTables::of($questions)
            ->addColumn('image', function ($row) {
                if ($row->image == null) {
                    return '-';
                }
                return asset('storage/' . $row->image);
            })
            ->addColumn('created_at', function ($question) {
                return \Carbon\Carbon::parse($question->created_at)->format('j F Y H:i');
            })
            ->addColumn('updated_at', function ($question) {
                return \Carbon\Carbon::parse($question->updated_at)->format('j F Y H:i');
            })
            ->addColumn('action', function ($question) {
                $editRoute = route('dashboard.questions.edit', ['id' => $question->quiz_id, 'question_id' => $question->id]);
                $deleteRoute = route('dashboard.questions.destroy', ['id' => $question->quiz_id, 'question_id' => $question->id]);

                // Use Blade syntax to generate the delete button
                return '<a href="' . $editRoute . '" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>' .
                    '<form action="' . $deleteRoute . '" method="post" class="d-inline" onsubmit="return confirm(\'Are you sure to delete this record?\')">' .
                    csrf_field() . // Equivalent to @csrf
                    method_field('delete') . // Equivalent to @method('delete')
                    '<button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-alt"></i></button>' .
                    '</form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
