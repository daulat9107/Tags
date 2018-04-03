@extends('taggy::Layouts.default')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <h2>{{ $topic->title }}</h2>
        <form action="{{ route('topics.re-tags',['slug'=>$topic->slug]) }}" method="post">
          <div class="form-group{{ $errors->has('tags') ? ' has-error':'' }}">
            <label for="add_tags">New Tags</label>
            <select class="form-control" multiple="multiple" name="tags[]" id="add_tags">
              <option value="">Select</option>
              @foreach($tags as $tag)
              <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
              @endforeach
            </select>
            @if($errors->has('tags'))
            <span class="help-block">{{ $errors->first('tags') }}</span>
            @endif
            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                @method('POST')
                @csrf
          </div>
          <div class="input-group">
            <button type="submit" class="btn btn-primary">Re Tags</button>
          </div>

        </form>
      </div>
  </div>
@endsection
      

  
