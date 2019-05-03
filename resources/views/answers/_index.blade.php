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

                        @include ('answers._answer')

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endif