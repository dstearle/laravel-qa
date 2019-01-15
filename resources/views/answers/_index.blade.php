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

                    </div>

                    <hr>

                    @endforeach

                </div>

            </div>

        </div>

    </div>