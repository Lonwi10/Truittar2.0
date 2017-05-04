@extends('main')
@section('title', '| Edit Tag')

@section('content')

    {{Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT'])}}
        {{Form::label('name', "Update Tag Name:")}}
        {{Form::text('name', null, ['class' => 'form-control'])}}

        {{Form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top: 20px;'])}}

    {{Form::close()}}
@endsection
