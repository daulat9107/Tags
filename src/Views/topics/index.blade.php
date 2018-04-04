@extends('taggy::Layouts.default')

@section('content')
  <div class="row">
      <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ route('topics.create') }}">Create Topic</a>
          <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">id</th>
              <th scope="col">Title</th>
              <th scope="col">Tags</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topics as $index => $topic)
            <tr>
              <th scope="row">{{ $index+1 }}</th>
              <th scope="row">{{ $topic->id }}</th>
              <td>{{ $topic->title }}</td>
              <td>
                @foreach($topic->tags as $tag)
                <a href="/topics/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
                @endforeach
              </td>
              <td>  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="{{ route('topics.add-tags', ['slug' => $topic->slug]) }}"> Add Tags</a></li>
      <li><a href="{{ route('topics.re-tags', ['slug' => $topic->slug]) }}"> Retag</a></li>
      @if($topic->tags()->count()>0)
      <li><a href="{{ route('topics.remove-any-tags', ['slug' => $topic->slug]) }}"> Remove any Tag</a></li>
      <li><a href="{{ route('topics.remove-all-tags', ['slug' => $topic->slug]) }}"> Remove all tags</a></li>
      @endif
    </ul>
  </div></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $topics->links() }}
      </div>
  </div>
@endsection
      

  
