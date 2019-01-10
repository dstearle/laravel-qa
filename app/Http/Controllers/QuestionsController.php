<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Remove comments to use laravel debugbar
        //\DB::enableQueryLog();

        //paginate(5) creates 5 questions where as paginate(8) would make 8
        $questions = Question::with('user')->latest()->paginate(10);

        return view('questions.index', compact('questions'));
        //Use below instead if using laravel debugbar
        //view('questions.index', compact('questions'))->render();

        dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //Adds an increment to the views for a question
        $question->increment('views');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //Checks to see if user has proper authentication to edit a question
        if(\Gate::denies('update-question', $question)) {
            
            //Denies the user access to edit a question
            abort(403, 'Access denied');

        }

        //Allows user access to view the edit page to edit a question
        return view("questions.edit", compact('question'));

        //Alternative way to do same thing above
        //Checks to see if user has proper authentication to edit a question
        //if(\Gate::allows('update-question', $question)) {
        //    
        //    //Allows user access to view the edit page to edit a question
        //    return view("questions.edit", compact('question'));
        //
        //}

        //Tells user to fuck off if they do not have proper authentication
        //abort(403, 'Access denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        //Checks to see if user has proper authentication to update a question
        if(\Gate::denies('update-question', $question)) {
            
            //Denies the user access to update a question
            abort(403, 'Access denied');

        }

        $question->update($request->only('title', 'body'));

        //Allows user access to view the update page to update a question
        return redirect('/questions')->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //Checks to see if user has proper authentication to delete a question
        if(\Gate::denies('update-question', $question)) {
            
            //Denies the user access to delete a question
            abort(403, 'Access denied');

        }

        $question->delete();

        //Allows user access to delete a question
        return redirect('/questions')->with('success', "Your question has been deleted.");
    }
}
