<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Validator;

class QuizController extends Controller
{

    public function index($slug)
    {
        $quiz = Quiz::where('slug', $slug)->first();
        dd($quiz);
    }

}