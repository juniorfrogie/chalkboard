<div class="row mt-5">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>{{ $answerCount . " " . str_plural('Answer', $answerCount) }}</h2>
        </div>
        <hr>
        @include('partials._message')
        @foreach ($answers as $answer)
          <div class="media">
            <div class="d-flex flex-column vote-controls">
              <a title="This answer is useful."
                  class="vote-up {{ Auth::guest() ? 'off' : ''}}"
                  onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                <i class="fas fa-caret-up fa-3x"></i>
              </a>
              <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="post" class="d-none">
                @csrf
                <input type="hidden" name="vote" value="1">
              </form>
              <span class="votes-count">{{ $answer->votes_count }}</span>
              <a title="This answer is not useful."
                  class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                  onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                <i class="fas fa-caret-down fa-3x"></i>
              </a>
              <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="post" class="d-none">
                @csrf
                <input type="hidden" name="vote" value="-1">
              </form>
              @can ('acceptAnswer', $answer)
                <a title="Mark this answer as best answer"
                class="{{ $answer->status }} mt-2"
                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                  <i class="fas fa-check fa-2x"></i>
                </a>
                <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="post" class="d-none">
                  @csrf
                </form>
              @else
                @if ($answer->is_best)
                  <a title="This answer has been accepted as best answer."
                  class="{{ $answer->status }} mt-2">
                    <i class="fas fa-check fa-2x"></i>
                  </a>
                @endif
              @endcan
            </div>
            <div class="media-body">
              {!! $answer->content_html !!}
              <div class="row">
                <div class="col-4">
                  <div class="ml-auto">
                    @can('update', $answer)
                      <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-outline-info btn-sm">Edit</a>
                    @endcan
                    @can('delete', $answer)
                      <form class="d-inline" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                      </form>
                    @endcan
                  </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                  <span class="text-muted">{{ $answer->created_date }}</span>
                  <div class="media mt-2 text-alighn-center">
                    <a href="{{ $answer->user->url }}" class="pr-2">
                      <img src="{{ $answer->user->avatar }}" alt="">
                      <span class="media-body">
                        <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                      </span>
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
