<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;
use DB;
use App\Question;
use App\Result;
use Response;

class ResultController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');       
    }

    public function data(Request $request)
    { 
        $id = $request->id;
        $question = Question::findOrFail($id);
        $lava = new Lavacharts;
        $votes  = $lava->DataTable();        

        $answers = $question->answers;

        $results = $question->answers;

        $votes->addStringColumn('Answer')
            ->addNumberColumn('Votes');

        foreach ($answers as $key => $value) {           
                $votes->addRow([$answers[$key]['answer'], 
                Result::where('answer_id', '=', $answers[$key]['id'])->count()]); 
        } 

        $lava->BarChart('Votes', $votes);
        
        return view('admin.graphics',compact('lava')); 
    } 
}