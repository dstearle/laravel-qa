<!-- Checks to see if there are any answers to show, hides if there are none available -->
@if ($answersCount > 0)

<div class="row mt-4">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    <div class="card-title">

                        {{-- Shows total number of answers for a particular question --}}
                        <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>

                    </div>

                    <hr>

                    @include ('layouts._messages')

                    {{-- Populates the available answers for a particular question --}}
                    @foreach ($answers as $answer)

                    <div class="media">

                        <div class="d-flex flex-column vote-controls">

                            <a title="This answer is useful" 
                                class="vote-up {{ Auth::guest() ? 'off' : ''}}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                            >

                                <i class="btn btn-outline-success">/\</i>

                            </a>

                            <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display:none;">
                                
                                @csrf

                                    <input type="hidden" name="vote" value="1">

                            </form>

                            <span class="votes-count">{{ $answer->votes_count }}</span>

                            <a title="This answer is not useful"
                             class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                             onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                            >

                                <i class="btn btn-outline-danger">\/</i>

                            </a>

                            <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display:none;">
                                
                                @csrf

                                    <input type="hidden" name="vote" value="-1">

                            </form>

                            <!-- Refactored to _accept.blade.php
                                
                            {{-- Checks if the user has authorization to accept an answer --}}
                            @can ('accept', $answer)

                                <a href="" title="Mark this answer as best answer" class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                    
                                    <i class="btn btn-outline-warning">$</i>

                                    <span class="favorites-count">123</span>

                                </a>

                                <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id ) }}" method="POST" style="display:none;">
                                
                                    @csrf


                                </form>

                            @else

                                @if($answer->is_best)

                                    <a title="The question owner accepted this answer as best answer" 
                                        class="{{ $answer->status }} mt-2"
                                        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                    >                                        
                                        
                                        <i class="btn btn-outline-warning">$</i>

                                        <span class="favorites-count">123</span>

                                    </a>

                                @endif

                            @endcan -->

                        </div>

                        <div class="media-body">

                            {!! $answer->body_html !!}
                            
                            <div class="row">

                                <div class="col-4">

                                    <div class="ml-auto">

                                        {{-- Determines if user can see update button --}}
                                        {{-- @can is alternative way to do same thing as @if like for the delete button below --}}
                                        @can ('update', $answer)

                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>

                                        @endcan

                                        {{-- Determines if user can see delete button --}}
                                        @can ('delete', $answer)

                                            <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">

                                                @method('DELETE')
                                                @csrf

                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">

                                                    Delete

                                                </button>

                                            </form>

                                        @endcan

                                    </div>

                                </div>

                                <div class="col-4"></div>

                                {{-- Shows the name of the author for each answer and date created --}}
                                <div class="col-4">

                                    @include ('shared._author', [

                                        'model' => $answer,
                                        'label' => 'answered'
                                    ])

                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endif