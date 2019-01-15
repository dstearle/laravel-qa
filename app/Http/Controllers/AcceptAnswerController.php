<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    
    public function __invoke(Answer $answer) {

        $this->authorize('accept', $answer);
        //Accepts the answer as the best answer for a quetion
        $answer->question->acceptBestAnswer($answer);
        //Refreshes the page
        return back();

    }

}
