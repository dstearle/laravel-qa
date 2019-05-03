<div class="media post">

    @include ('shared._vote' , [

        'model' => $answer
        
    ])

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