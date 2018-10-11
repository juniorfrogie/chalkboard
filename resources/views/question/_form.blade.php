@csrf
<div class="form-group">
  <label for="question-title">Question Title</label>
  <input type="text" name="title" value="{{old('title', $question->title)}}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invinsible' : ''}}">
  @if ($errors->has('title'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('title') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="question-content">Explain your question</label>
  <textarea name="content" id="question-content" rows="10" class="form-control {{ $errors->has('title') ? 'is-invinsible' : ''}}">{{old('content', $question->content)}}</textarea>
  @if ($errors->has('content'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('content') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <button type="submit" class="btn btn-outline-primary btn-lg">{{ $btnText }}</button>
</div>
