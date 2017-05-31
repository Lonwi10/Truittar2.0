@extends('main')

@section('title', '| Contact')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h1>Contactar con administrador</h1>
                <hr>
                <form action="{{url('contact')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="email">Email:</label>
                        <input id ="email" name="email" value="{{Auth::user()->email}}" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label name="subject">Asunto:</label>
                        <input id ="subject" name="subject" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="message">Mensaje:</label>
                        <textarea id ="message" name="message" placeholder="Escribe tu mensaje" class="form-control"></textarea>
                    </div>

                    <input type="submit" value="Send Message" class="btn btn-success">

                </form>
            </div>
        </div>
@endsection
