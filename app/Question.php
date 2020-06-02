<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected  $fillable = ['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    //this is eloquent mutator
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::of($value)->slug('-');
    }


    //this is eloquent accessor
    public function getUrlAttribute(){
        return route('questions.show',$this->id);
    }

    public function getCreatedDateAttribute(){
        //diffForHumans is a carbon date method
        return $this->created_at->diffForHumans();
       // return $this->created_at->formate('d/m/Y');
    }

    public function getStatusAttribute(){
            if($this->answers > 0){
                if($this->best_answer_id){
                    return 'answered-accepted';
                }
                return 'answered';
            }
            return 'unanswered';
    }
}
