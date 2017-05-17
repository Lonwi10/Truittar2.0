<style>
  .col-md-8{
    margin-left: 10px;
    background-color: lightgrey;
    width: 65%;

  }
</style>
@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "| $titleTag")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title}}</h1>
            @if ($post->image && file_exists(public_path('images/'.$post->image)))
                    <img src="{{asset('images/' . $post->image)}}" height="400" width="600">
            @endif
            <p>{!!$post->body!!}</p>

        </div>
    </div>
   
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <h3 class="comments-title"> <span class="glyphicon glyphicon-comment"></span> {{$post->comments()->count()}} Comments
              </h3>
              @foreach ($post->comments as $comment)
                    <div class="comment">
                        <div class="author-info">
                          @if (Storage::disk('local')->has($comment->name . '.jpg'))
                            <img src="{{ route('account.image', ['filename' => $comment->name . '.jpg']) }}" width="40" height="40" alt="" class="author-name">
                          @else
                            <img src="{{ route('account.image', ['filename' => 'guest' . '.jpg']) }}" width="40" height="40" alt="" class="author-name">
                          @endif
                            <div class="author-name">
                                <h4>{{$comment->name}}</h4>
                                <p class="author-time">{{date('F nS, Y - g:iA', strtotime($comment->created_at))}}</p>
                            </div>
                        </div>
                        <div class="comment-content">
                            {{$comment->comment}}
                        </div>
                    </div>
              @endforeach
              <hr>

              <div class="row">
                        <div id = "comment-form" class="col-md-8">
                            {{Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST'])}}
                                        {{Form::label('name', ' ')}}
                                        {{Form::hidden('name', Auth::user()->username, ['class' => 'form-control', 'readonly'])}}

                                        {{Form::label('email', ' ')}}
                                        {{Form::hidden('email', Auth::user()->email, ['class' => 'form-control', 'readonly'])}}

                                        {{Form::label('comment', ' ')}}
                                        {{Form::textarea('comment', null, ['class' => 'form-control','rows' => '2'])}}

                                        {{Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top: 15px;'])}}
                            {{Form::close()}}
                        </div>
                    </div>
          </div>


      </div>

  

@endsection
