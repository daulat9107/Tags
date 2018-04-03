@extends('taggy::Layouts.default')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Tags</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topics as $topic)
            <tr>
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
      <li><a href="/topics/{{ $topic->id }}/tags/add"> Add Tags</a></li>
      <li><a href="/topics/{{ $topic->id }}/tags/retag"> Retag</a></li>
      <li><a href="/topics/{{ $topic->id }}/tags/removeany"> Remove any Tag</a></li>
      <li><a href="/topics/{{ $topic->id }}/tags/removeall"> Remove all tags</a></li>
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
      

  
