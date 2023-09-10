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
    public $step;
    public $slug_url = [];
    public $questions;
    public $currentQuestion;
    public $totalQuestions;
    public $input = [];
    public $url;

    protected $listeners = [
        'loadAnswers' => 'loadData',
    ];

    // public function updated($field, $value)
    // {
    //     logger("Updated field: $field");
    //     logger($value);
    // }


    public function mount($dataQuestion)
    {
        // dd($dataQuestion);
        $this->step = 0;
        $this->resetAll();
        $this->getVideo($dataQuestion);
        $this->questions = $dataQuestion;
        $this->totalQuestions = count($dataQuestion);
        $this->currentQuestion = $this->questions[0];
        // dd($this->currentQuestion);
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
    }

    // Jika ada localStorage
    public function loadData($userAnswers)
    {
        // Reset the input array
        $this->input = [];

        foreach ($userAnswers as $entry) {
            $key = $entry[0];
            $value = $entry[1];

            if (is_array($value)) {
                foreach ($value as $choice) {
                    $this->input[$key][$choice] = $choice;
                }
            } else {
                $this->input[$key] = $value;
            }
        }

        // Update the step
        $keys = array_keys($this->input);
        $this->step = count($keys);
        $this->currentQuestion = $this->questions[$this->step - 1];
    }





    public function nextQuestion()
    {
        if ($this->step <= $this->totalQuestions) {
            $this->step++;
            $this->currentQuestion = $this->questions[$this->step - 1];
            // dd($this->input);
        }
    }

    public function previousQuestion()
    {
        if ($this->step > 1) {
            $this->step--;
            $this->currentQuestion = $this->questions[$this->step - 1];
            // } else {
        } elseif ($this->step == 1) {
            $this->step--;
            $this->getVideo($this->questions);
        }
    }

    public function submitAnswers()
    {
        foreach ($this->questions as $question) {
            if (!empty($question) && is_object($question)) {

                if (isset($this->input[$question->id])) {
                    $userAnswers = (array) $this->input[$question->id];
                } else {
                    $userAnswersKeys = preg_grep("/^{$question->id}\./", array_keys($this->input));
                    $userAnswers = [];
                    foreach ($userAnswersKeys as $key) {
                        $userAnswers[] = $this->input[$key];
                    }
                }

                $options = json_decode($question->options, true);

                $correctAnswers = array_filter($options, function ($option) {
                    return $option['is_correct'];
                });

                $correctValues = array_column($correctAnswers, 'value');

                if (count($correctValues) > 1) {
                    $allCorrect = !array_diff($userAnswers, $correctValues) && !array_diff($correctValues, $userAnswers);

                    foreach ($userAnswers as $userAnswer) {
                        ResultAnswer::create([
                            'quiz_id' => $question->quiz_id,
                            'question_id' => $question->id,
                            'user_id' => auth()->user()->id,
                            'answer' => $userAnswer,
                            'is_correct' => in_array($userAnswer, $correctValues),
                        ]);
                    }

                    if (!$allCorrect) {
                        $missingAnswers = array_diff($correctValues, $userAnswers);
                        foreach ($missingAnswers as $missingAnswer) {
                            ResultAnswer::create([
                                'quiz_id' => $question->quiz_id,
                                'question_id' => $question->id,
                                'user_id' => auth()->user()->id,
                                'answer' => $missingAnswer,
                                'is_correct' => false,
                            ]);
                        }
                    }
                } else {
                    $isCorrect = $userAnswers[0] == $correctValues[0];
                    ResultAnswer::create([
                        'quiz_id' => $question->quiz_id,
                        'question_id' => $question->id,
                        'user_id' => auth()->user()->id,
                        'answer' => $userAnswers[0],
                        'is_correct' => $isCorrect,
                    ]);
                }
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
