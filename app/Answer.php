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

        static::created(function ($answer) {

            //Increases the answers counter when an answer is created
            $answer->question->increment('answers_count');

        });

        static::deleted(function ($answer) {

            //Decrements the answers counter when an answer is deleted
            $answer->question->decrement('answers_count');

        });

    }

    public function getCreatedDateAttribute() {

        return $this->created_at->diffForHumans();
        
    }

    public function getStatusAttribute() {

        return $this->isBest() ? 'vote-accepted' : '';
        
    }

    public function getIsBestAttribute() {

        return $this->isBest();
        
    }

    public function isBest() {

        return $this->id == $this->question->best_answer_id;
        
    }

    public function votes() {

        return $this->morphedToMany(User::class, 'votable');
        
    }

}
