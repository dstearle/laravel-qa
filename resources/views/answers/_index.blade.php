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

                            <a href="" title="This answer is useful" class="vote-up">

                                <i class="btn btn-outline-success">/\</i>

                            </a>

                            <span class="votes-count">1230</span>

                            <a href="" title="This answer is not useful" class="vote-down off">

                                <i class="btn btn-outline-danger">\/</i>

                            </a>

                            <a href="" title="Mark this answer as best answer" class="vote-accepted mt-2">
                                
                                <i class="btn btn-outline-warning">$</i>

                                <span class="favorites-count">123</span>

                            </a>

                        </div>

                        <div class="media-body">

                            {!! $answer->body_html !!}

                            {{-- Shows the name of the author for each answer and date created --}}
                            <div class="float-right">

                                {{-- Date the answer was created--}}
                                <span class="text-muted">Answered {{ $answer->created_date }}</span>

                                {{-- User avatar and name --}}
                                <div class="media mt-2">

                                    <a href="{{ $answer->user->url }}" class="pr-2">

                                        <img src="{{ $answer->user->avatar }}">

                                    </a>

                                    <div class="media-body mt-1">

                                        <a href="{{ $answer->user->url }}">

                                            {{ $answer->user->name }}
                                        
                                        </a>

                                    </div>

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