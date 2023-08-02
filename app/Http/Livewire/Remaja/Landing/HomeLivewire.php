<?php

namespace App\Http\Livewire\Remaja\Landing;

use App\Http\Controllers\Front\HomeController;
use App\Models\Remaja\Question;
use App\Models\Remaja\Quiz;
use App\Models\Remaja\ResultAnswer;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class HomeLivewire extends Component
{
    public $step = 0;
    public $slug_url = [];
    public $questions;
    public $currentQuestion;
    public $totalQuestions;
    public $input = [];
    public $url;

    protected $listeners = [
        'loadAnswers' => 'loadData',
    ];

    public function mount($dataQuestion)
    {
        // dd($dataQuestion);
        $this->resetAll();
        $this->getVideo($dataQuestion);
        // dd($this->url);
        $this->questions = $dataQuestion;
        $this->totalQuestions = count($dataQuestion);
        $this->currentQuestion = $this->questions[0];

        // dd($this->currentQuestion);

        // $this->emit('loadAnswers', $this->input);
    }

    public function getVideo($dataQuiz)
    {
        $quizIds = $dataQuiz->pluck('quiz_id')->unique(); 

        $quiz = Quiz::whereIn('id', $quizIds)->get(); 
        // dd($quiz);
        foreach ($dataQuiz as $value) {
            foreach ($quiz as $valueQuiz) {
                if ($value->quiz_id == $valueQuiz->id) {
                    $this->url = $valueQuiz->url;
                    break;
                }
            }
        }

        $linkYoutube = $this->url;
        $pattern = '/(?<=\?v=|\/embed\/|\/\d\/|\.be\/)[^&#?\/]+/';
        preg_match($pattern, $linkYoutube, $matches);
        $videoCode = null;

        if (!empty($matches)) {
            $videoCode = $matches[0];
        }

        $this->url = $videoCode;
        // dd($this->url);
    }

    // Jika ada localStorage 
    public function loadData($userAnswers)
    {
        // Load answers from JavaScript and update the Livewire input property
        $this->input = [];

        foreach ($userAnswers as $entry) {
            $key = $entry[0];
            $value = $entry[1];
            $this->input[$key] = $value;
        }

        // ambil step
        $keys = array_keys($this->input);
        $this->step = count($keys);
        // dd($this->step);

        // ambil question dari step
        $this->currentQuestion = $this->questions[$this->step - 1];

        // dd($this->currentQuestion);
    }



    public function nextQuestion()
    {
        if ($this->step <= $this->totalQuestions) {
            $this->step++;
            $this->currentQuestion = $this->questions[$this->step - 1];
            // dd($this->step);
        }
    }

    public function previousQuestion()
    {
        if ($this->step >= 1) {
            $this->step--;
            $this->currentQuestion = $this->questions[$this->step];
        // $this->getVideo($dataQuestion);

        }
    }

    public function submitAnswers()
    {
        foreach ($this->questions as $question) {
            // COba
            if (!empty($question) && is_object($question)) {
                $userAnswer = $this->input[$question->id];

                // Decode dlu
                $options = json_decode($question->options, true);

                $correctAnswer = null;
                foreach ($options as $option) {
                    if ($option['is_correct']) {
                        $correctAnswer = $option['value'];
                        break;
                    }
                }
                $isCorrect = $userAnswer === $correctAnswer;

                // Simpan 
                ResultAnswer::create([
                    'quiz_id' => $question->quiz_id,
                    'question_id' => $question->id,
                    'user_id' => auth()->user()->id,
                    'answer' => $userAnswer,
                    'is_correct' => $isCorrect,
                ]);
            }
        }


        // Reset stepper
        $this->resetAll();
        return redirect()->route('user.detail.result', $this->questions[0]->quiz->slug_url);
    }

    public function resetAll()
    {
        // Reset stepper
        $this->step = 0;
        $this->url = null;

        $this->slug_url = [];
        $this->totalQuestions = null;
        $this->input = [];

        $this->emit('reset');
    }

    public function updatedInput($answer, $questionId)
    {
        // dd($questionId);
        $this->emit('saveAnswer', $questionId, $answer);
    }


    public function render()
    {
        return view('livewire.remaja.landing.home-livewire')->layout('layouts.remaja.front.app');
    }
}
