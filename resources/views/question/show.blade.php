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
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">View all Questions</a>
                      </div>
                    </div>
                    <hr>
                  </div>

                  <div class="media">
                    <div class="d-flex flex-column vote-controls">
                      <a title="This question is useful." class="vote-up" href="">
                        <i class="fas fa-caret-up fa-3x"></i>
                      </a>
                      <span class="votes-count">12</span>
                      <a title="This question is not useful." class="vote-down off" href="">
                        <i class="fas fa-caret-down fa-3x"></i>
                      </a>
                      <a title="Click to mark as favorite question (Click again to undo)" class="favorite mt-2 favorited" href="">
                        <i class="fas fa-star fa-2x"></i>
                        <span class="d-block favorite-count">123</span>
                      </a>
                    </div>
                    <div class="media-body">
                      {!! $question->content_html !!}
                      <div class="float-right">
                        <span class="text-muted">{{ $question->created_date }}</span>
                        <div class="media mt-2 text-alighn-center">
                          <a href="{{ $question->user->url }}" class="pr-2">
                            <img src="{{ $question->user->avatar }}" alt="">
                            <span class="media-body">
                              <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @include('answer._index', [
      'answers' => $question->answers,
      'answerCount' => $question->answer_count,
    ])
    @include('answer._create')
</div>
@endsection
