@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    <div class="card-title">

                        <div class="d-flex align-items-center">

                            <h1>{{ $question->title }}</h1>

                            <div class="ml-auto">

                                <a href=" {{ route('questions.index') }} " class="btn btn-outline-secondary">Back to all Questions</a>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="media">

                        <!-- Refactored to _vote.blade.php -->
                        @include ('shared._vote', [

                            'model' => $question

                        ])

                        <div class="media-body">

                            {!! $question->body_html !!}

                            <div class="row">

                                <div class="col-4"></div>

                                <div class="col-4"></div>

                                <div class="col-4">
                                
                                    @include ('shared._author', [

                                        'model' => $question,
                                        'label' => 'asked'

                                    ])

                                </div>
                            
                            </div>

                        </div>

                    </div>
                
                </div>

            </div>

        </div>
        
    </div>

    {{-- Shows the answers for a question brought from _index file --}}
    @include ('answers._index', [

        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])

    {{-- Shows the option to create a new answer brought from _create file --}}
    @include ('answers._create')

</div>

@endsection