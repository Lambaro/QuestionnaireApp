<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class QuestionnaireController extends Controller
{
    // prevents not logged users to use the app
    public function __construct(){
        $this->middleware('auth');
    }
    //Create
    public function create(){

        return view('questionnaire.create');
    }
    // database connection and return
    public function store(){
        $data = request()->validate([
            'title'=> 'required',
            'purpose'=> 'required',
        ]);

        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect('/questionnaires/' .$questionnaire->id);
    }

    // show
    public function show(\App\Models\Questionnaire $questionnaire){

        $questionnaire->load('questions.answers.responses');

        return view('questionnaire.show', compact('questionnaire'));
    }
}
