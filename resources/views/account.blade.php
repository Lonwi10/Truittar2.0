@extends('main')

@section('title')
    account
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Tu cuenta</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email (para cambiar contactar admin)</label>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="email" disabled="">
                </div>
                <div class="form-group">
                    <label for="image">Imagen (solo .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                
                <button type="submit" class="btn btn-primary">Save account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    @if (Storage::disk('local')->has($user->username . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', ['filename' => $user->username . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
@endsection