<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Result extends Model
{
    protected $table = 'results';
    protected $fillable = ['question_id','answer'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function answers()
    {
        return $this->belongsTo('App\Answer');
    }
}