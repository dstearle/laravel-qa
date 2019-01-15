<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public $fillable = ['body', 'user_id'];
    
    public function question() {

        return $this->belongsTo(Question::class);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute() {

        return \Parsedown::instance()->text($this->body);
    }

    public static function boot() {

        parent::boot();

        static::created(function($answer) {

            //Increases the answers counter when an answer is created
            $answer->question->increment('answers_count');

        });

        static::deleted(function($answer) {

            $question = $answer->question;

            //Decrements the answers counter when an answer is deleted
            $question->decrement('answers_count');

            //If statement to check if an answer is rated as "best answer"
            if($question->best_answer_id == $answer->id) {

                $question->best_answer_id = NULL;

                $question->save();
            }

        });

    }

    public function getCreatedDateAttribute() {

        return $this->created_at->diffForHumans();
        
    }

    public function getStatusAttribute() {

        return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
        
    }

}
