<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use App\Answer;
use App\User;
use App\Http\Middleware;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function __construct()
    {        
       $this->middleware('auth');       
    }
   public function questions()
   { 
       //dd(Auth::check() && Auth::user()->hasRole('admin'));      
       $questions = Question::all();
       return view('admin.index',compact('questions'));
   }
    public function create()
    {
        return view('admin.create');
    }
    public function store(Request $request)
    {
        $question = new Question;
        $question->quiz_name = $request->quiz_name;
        $question->question = $request->question;
        $question->save();
        
        $result = $request->all('answer');
        
        if (isset($result['answer'])) {
            $maxkey = max(array_keys($result['answer']));
            for ($x = 0; $x <= $maxkey; $x++) {
                $answers = new Answer;
                $answers->question()->associate($question);
                $answers->answer = $result['answer'][$x];
                $answers->save();
            }
        }

        return redirect ('admin');
    }
    
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();     
        return redirect ('admin');
    }
}