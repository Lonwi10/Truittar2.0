@extends('main')

@section('title', '| Homepage')


@section('content')

      <div class="row">
          @if (Auth::check())
          <div class="col-md-3" style="display: inline-block;" id="profile">
                <div id="photoProfile" class="col-md-5"><!-- photoProfile -->
                  @if (Storage::disk('local')->has(Auth::user()->username . '.jpg'))  
                      <img src="{{ route('account.image', ['filename' => Auth::user()->username . '.jpg'])}}" width="100" height="100" alt="">
                  @else
                      <img src="{{ route('account.image', ['filename' =>'guest' . '.jpg'])}}" width="100" height="100" alt="">
                  @endif
                </div>

                <div id="info" class="col-md-7 pull-right"><!-- perfil-->
                  <h4>{{Auth::user()->name}}</h4>
                  <h5>{{Auth::user()->username}}</h5>
                  
                </div>

                <div class="col-xs-12">

                </div>
          </div>

            <div class="col-md-6" id="posts">
		            {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
						{{Form::label('body', ' ')}}
		                {{Form::textarea('body', null, array('class' => 'form-control', 'placeholder' =>'Escribe aqui tu post...'))}}

		                {{Form::label('featured_image', ' ')}}
		                {{Form::file('featured_image')}}

		                {{Form::label('creator', ' ')}}
		                {{Form::hidden('creator', Auth::user()->username)}}

		                {{Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'))}}
		            {!! Form::close() !!}
                <hr>
                @foreach($posts as $post)
                    <div class="post">
                        <div class="comment">
                            <div class="author-info">
                              @if (file_exists(public_path('images/'.$post->creator .'.jpg')))
                                  <img src="{{asset('images/' . $post->creator.'.jpg')}}" height="50" width="50" class="author-name">
                              @else
                                  <img src="{{asset('images/' . 'guest.jpg')}}" height="50" width="50" class="author-name">
                              @endif
                              <div class="author-name">
                                <h4>{{$post->creator}}<h4>
                                <p class="author-time">{{date('F nS, Y - g:iA', strtotime($post->created_at))}}</p>
                              </div>

                              <div class="comment-content">
                              <hr>
                              <p>{{substr(strip_tags($post->body), 0, 250)}}{{strlen(strip_tags($post->body)) > 250 ? "..." : ""}}</p>
                                @if ($post->image && file_exists(public_path('images/'.$post->image)))
                                    <p><img src="{{asset('images/' . $post->image)}}" height="100" width="100"></p>
                                @endif
                                <div class="readMore">
                                  <a id="btnRM" href="{{url('blog/'.$post->id)}}" >Leer mas!</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                    </div>

                    <h4 class="comments-title"> <span class="glyphicon glyphicon-comment"></span> {{$post->comments()->count()}} Comments</h4>
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


                    @if (Auth::check())
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
                     <hr>
                  @else
                    <div class="row">
                      <div id = "comment-form" class="col-md-8 col-md-offset-2">
                        <div class="row">
                          <div class="col-md-6">
                            <p> Solo usuarios registrados pueden comentar </p>
                          </div>
                        </div>
                      </div>
                    </div>

                  @endif
                @endforeach

            </div>
            <div class="col-md-3" id="barraDerecha">
              @foreach ($followers as $follower)
                        <div class="barraDerecha">
                            <div class="author-info">

                              @if (file_exists(public_path('images/'.$follower->username .'.jpg')))
                                  <img src="{{asset('images/' . $follower->username.'.jpg')}}" height="50" width="50" class="author-name">
                              @else
                                  <img src="{{asset('images/' . 'guest.jpg')}}" height="50" width="50" class="author-name">
                              @endif
                              <div class="author-name">
                                <h4>{{$follower->name}}</h4>
                                <a id="btnFoll" href="{{url('follow/'.$follower->username)}}"><span class="glyphicon glyphicon-plus-sign"></span>Seguir</a>
                              </div>
                            </div>
                        </div>
              
              @endforeach
            </div>


          @else
            <div class="jumbotron">

                <h1>Truittar </h1>
                <p class="lead"></p>

            </div>
          @endif
      </div> <!-- end of header .row -->
@endsection
