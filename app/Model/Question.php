<?php


namespace App\Model;



use Illuminate\Support\Facades\Validator;

class Question
{
    public $name;
    public $tittle;
    public $type;
    public $validate;
    public function __construct($question)
    {
        $this->name=$question->name;
        $this->tittle=$question->tittle;
        $this->type=$question->type;
        $this->validate=$question->validate;
    }
    public function toHtml(){
        return view('model.question')->with('question',$this)->toHtml();
    }
    public function validate($data){
        Validator::make($data, [
            'question_'.$this->name => $this->validate,
        ])->validate();;
    }
}
