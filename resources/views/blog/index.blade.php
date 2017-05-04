@extends('main')

@section('title', "| Blog")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($posts as $post)
                <div class="post">
                    <h3>{{$post->title}}</h3>
                    <p>{{substr(strip_tags($post->body), 0, 250)}}{{strlen(strip_tags($post->body)) > 250 ? "..." : ""}}</p>
                    <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More</a>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

@endsection
