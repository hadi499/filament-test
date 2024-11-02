<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Result;
use App\Models\Test;

class Tests extends Component
{
    public $title = '';
    public $command = '';
    public $tests = [];  // Inisialisasi sebagai array kosong
    public $test = null;
    public $questions = [];  // Inisialisasi sebagai array kosong
    public $answers = [];
    public $score = 0;
    public $multiplier = 100;
    public $number_of_questions = 0;
    public $incorrectQuestions = [];  // Inisialisasi sebagai array kosong
    public $timeRemaining = 0;

    public function mount()
    {
        // Inisialisasi data saat component pertama kali dimuat
        $this->tests = Test::all();
    }

    public function startTest(Test $test)
    {
        $this->test = $test;
        $this->title = $test->title;
        $this->command = $test->command;
        $this->questions = $test->questions; // Konversi ke array
        $this->score = 0;
        $this->incorrectQuestions = [];
        $this->title = $test->title;
        $this->number_of_questions = $test->number_of_questions;
        $this->timeRemaining = $test->time;
        $this->answers = []; // Reset jawaban
    }

    public function submitTest()
    {
        $this->score = 0;
        $this->multiplier = 100 / ($this->number_of_questions ?: 1); // Hindari pembagian dengan 0
        $this->incorrectQuestions = [];

        if (!empty($this->questions)) {
            foreach ($this->questions as $question) {
                $questionId = is_array($question) ? $question['id'] : $question->id;
                $questionText = is_array($question) ? $question['text'] : $question->text;
                $correctAnswer = is_array($question) ? $question['correct_answer'] : $question->correct_answer;

                if (isset($this->answers[$questionId])) {
                    if ($this->answers[$questionId] == $correctAnswer) {
                        $this->score += 1;
                    } else {
                        $this->incorrectQuestions[] = [
                            'question' => $questionText,
                            'your_answer' => 'Jawaban Anda: ' . $this->answers[$questionId],
                            'correct_answer' => $correctAnswer
                        ];
                    }
                } else {
                    $this->incorrectQuestions[] = [
                        'question' => $questionText,
                        'your_answer' => 'Tidak dijawab',
                        'correct_answer' => $correctAnswer
                    ];
                }
            }
        }

        $this->score = $this->score * $this->multiplier;

        // Simpan hasil kuis jika user terautentikasi
        if (auth()->check() && $this->test) {
            Result::create([
                'test_id' => $this->test->id,
                'user_id' => auth()->id(),
                'score' => $this->score
            ]);
        }
    }

    public function render()
    {
        return view('livewire.tests', [
            'tests' => $this->tests,
            'test' => $this->test,
            'questions' => $this->questions,
            'score' => $this->score,
            'incorrectQuestions' => $this->incorrectQuestions,
            'timeRemaining' => $this->timeRemaining
        ]);
    }
}
