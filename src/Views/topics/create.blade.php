@extends('taggy::Layouts.default')

@section('content')
  <div class="row">
      <div class="col-md-12">
        <h1>Create Topic</h1>
        <form action="{{ route('topic.store') }}" method="post">
          <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control">
            
            @if($errors->has('title'))
            <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('body') ? ' has-error':'' }}">
                      <label for="body">body</label>
                      <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{ old('body') }}</textarea>
                      
                      @if($errors->has('body'))
                      <span class="help-block">{{ $errors->first('body') }}</span>
                      @endif
          </div>
              @method('POST')
              @csrf
          <div class="input-group">
            <button type="submit" class="btn btn-primary">Create Topic</button>
          </div>

        </form>
      </div>
  </div>
@endsection
      

  
