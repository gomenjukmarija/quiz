<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Answer;
use App\Result;
use Response;
use Session;

class QuestionController extends Controller
{
    public function __construct()
    {        
       $this->middleware('auth');       
    }

    public function index()
    { 
      $questions = Question::with('answers')->get(); 
      return view('question',compact('questions'));        
    }

    public function data(Request $request)
    { 
      $id = $request->id;            
      $question = Question::findOrFail($id);
      return Response::json($question->answers);
    }

    public function store(Request $request)
    { 
       $answer = $request->input('answer');
       $question = $request->input('question');      
       $result = new Result; 
       $result->answer_id = $answer;
       $result->question_id = $question;      
       $result->user_id = Auth::user()->id;

       if (Result::where('question_id', '=', $question)
            ->where('user_id', '=', $result->user_id)
            ->exists()) {
        Session::flash('flash_message','Вы уже голосовали!'); 
       }
       else {
           $result->save();
           Session::flash('flash_message','Спасибо за ваш голос!');           
       } 
       return redirect ('home/question');      
    }
}