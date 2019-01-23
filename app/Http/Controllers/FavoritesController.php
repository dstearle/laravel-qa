<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class FavoritesController extends Controller
{

    public function __construct() {

        //Checks to see that user has signed in
        $this->middleware('auth');
        
    }

    public function store(Question $question) {


        //Stores a question as a favorite for user
        $question->favorites()->attach(auth()->id());

        //Reloads the page
        return back();

    }

    public function destroy(Question $question) {

        //Unfavors a question for user
        $question->favorites()->detach(auth()->id());

        //Reloads the page
        return back();
        
    }

}
