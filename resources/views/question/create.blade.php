@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h2>Ask Question</h2>
                    <div class="ml-auto">
                      <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">View all Questions</a>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <form action="{{ route('questions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="question-title">Question Title</label>
                      <input type="text" name="title" value="{{old('title')}}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invinsible' : ''}}">
                      @if ($errors->has('title'))
                        <div class="invalib-feedback">
                          <strong>{{ $errors->first('title') }}</strong>
                        </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="question-content">Explain your question</label>
                      <textarea name="content" id="question-content" rows="10" class="form-control {{ $errors->has('title') ? 'is-invinsible' : ''}}">{{old('content')}}</textarea>
                      @if ($errors->has('content'))
                        <div class="invalib-feedback">
                          <strong>{{ $errors->first('content') }}</strong>
                        </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-outline-primary btn-lg">Ask this question</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
