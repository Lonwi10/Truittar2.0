@extends('main')

@section('title', '| ELIMINAR COMENTARIO?')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>ELIMINAR ESTE COMENTARIO?</h1>
            <p>
                <strong>Nombre: </strong> {{$comment->name}} <br>
                <strong>Email: </strong> {{$comment->email}} <br>
                <strong>Comentario: </strong> {{$comment->comment}}
            </p>

            {{Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE'])}}
                {{Form::submit('SI ELIMINAR EL COMENTARIO', ['class' => 'btn btn-lg btn-block btn-danger'])}}
            {{Form::close()}}

        </div>
    </div>
@endsection
