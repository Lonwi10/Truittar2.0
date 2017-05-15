@extends('main')

@section('title', '| Homepage')

<style>
  .perfil{
    float: right;
    margin-right: 20px;
  }

  .photoProfile{
    float: left;
  }
  .post .readMore{
    text-align: right;
    margin-top: -20px;
  }

  .btn-primary{
    background-color: transparent;
    color: lightgrey;
  }

  #btnRM{
    background-color: transparent;
    color: grey;
  }
  .col-md-3{
  	background-color: lightgrey;
  	padding: 15px;


  }
  .col-md-2{
  	background-color: lightgrey;


  }

  .col-md-6{
  	background-color: lightgrey;
  }


</style>

@section('content')
      <div class="row">
          @if (Auth::check())
          <div class="col-md-3" style="display: inline-block;">
              <div class="col-xs-6"><!-- photoProfile -->
                @if (Storage::disk('local')->has(Auth::user()->username . '.jpg'))  
                    <img src="{{ route('account.image', ['filename' => Auth::user()->username . '.jpg'])}}" width="100" height="100" alt="">
                @else
                    <img src="{{ route('account.image', ['filename' =>'guest' . '.jpg'])}}" width="100" height="100" alt="">
                @endif
              </div>
              <div id="info" class="col-xs-6"><!-- perfil-->
                <h4>@ {{Auth::user()->username}}</h4>
                <h5>{{Auth::user()->name}}</h5>
              </div>
          </div>

            <div class="col-md-6">
            	<hr>
		            {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
						{{Form::label('body', 'Post Body:')}}
		                {{Form::text('body', null, array('class' => 'form-control'))}}

		                {{Form::label('featured_image', 'Upload Featured Image:')}}
		                {{Form::file('featured_image')}}

		                {{Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'))}}
		            {!! Form::close() !!}
                @foreach($posts as $post)
                    <div class="post">
                        <h3>{{$post->title}}</h3>
                        @if ($post->image && file_exists(public_path('images/'.$post->image)))
                            <p><img src="{{asset('images/' . $post->image)}}" height="100" width="100"></p>
                        @endif
                        <p>{{substr(strip_tags($post->body), 0, 250)}}{{strlen(strip_tags($post->body)) > 250 ? "..." : ""}}</p>
                         
                        <div class="readMore">
                          <a id="btnRM" href="{{url('blog/'.$post->slug)}}" >Leer mas!</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>

            <div class="col-md-3">

            </div>


          @else
            <div class="jumbotron">

                <h1>Truittar </h1>
                <p class="lead"></p>

            </div>
          @endif
      </div> <!-- end of header .row -->
@endsection
