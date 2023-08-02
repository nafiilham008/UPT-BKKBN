<?php

namespace App\Http\Livewire\Remaja\Landing;

use App\Http\Controllers\Front\HomeController;
use App\Models\Remaja\Question;
use App\Models\Remaja\ResultAnswer;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class HomeLivewire extends Component
{
    public $step = 1;
    public $slug_url = [];
    public $questions;
    public $currentQuestion;
    public $totalQuestions;
    public $input = [];

    protected $listeners = [
        'loadAnswers' => 'loadData',
    ];

    public function mount($dataQuestion)
    {
        // dd($dataQuestion);
        $this->questions = $dataQuestion;
        $this->totalQuestions = count($dataQuestion);
        $this->currentQuestion = $this->questions[0];


        // $this->emit('loadAnswers', $this->input);
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
        $this->step = end($keys);

        // ambil question dari step
        $this->currentQuestion = $this->questions[$this->step - 1];

        // dd($this->currentQuestion);
    }



    public function nextQuestion()
    {
        if ($this->step < $this->totalQuestions) {
            $this->step++;
            $this->currentQuestion = $this->questions[$this->step - 1];
        }
    }

    public function previousQuestion()
    {
        if ($this->step > 1) {
            $this->step--;
            $this->currentQuestion = $this->questions[$this->step - 1];
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
        $this->step = 1;

        $this->slug_url = [];
        $this->totalQuestions = null;
        $this->input = [];

        $this->emit('reset');

        
    }

    public function updatedInput($questionId, $answer)
    {
        $this->emit('saveAnswer', $answer, $questionId);
    }


    public function render()
    {
        return view('livewire.remaja.landing.home-livewire')->layout('layouts.remaja.front.app');
    }
}
