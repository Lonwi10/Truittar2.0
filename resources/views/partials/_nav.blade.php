

<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="/">Truittar</a>

    </div>
@if (Auth::check())
    <!-- Collect the nav links, forms, and other content for toggling -->
   
      <ul class="nav navbar-nav">
        <li class="{{Request::is('/') ? "active" : ""}}"><a href="/">Inicio</a></li>
        <li class="{{Request::is('contact') ? "active" : ""}}"><a href="/contact">Contact</a></li>
        <li class="{{Request::is('chat') ? "active" : ""}}"><a href="/chat">Chat</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-center">
        <img src="{{asset('logos/icono.png')}}" height="40" width="100" class="author-name">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if (Storage::disk('local')->has(Auth::user()->username . '.jpg'))  
                  <img src="{{ route('account.image', ['filename' => Auth::user()->username . '.jpg'])}}" width="40" height="40" alt="">
                @else
                  <img src="{{ route('account.image', ['filename' =>'guest' . '.jpg'])}}" width="40" height="40" alt="">
                @endif
               <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('account')}}">Perfil</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{route('posts.index')}}">Post</a></li>

                <li role="separator" class="divider"></li>
                <li><a href="{{route('logout')}}">Desconectarte</a></li>
              </ul>
            </li>
        @else
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="{{Request::is('/') ? "active" : ""}}"><a href="/">Inicio</a></li>
            </ul>
             <ul class="nav navbar-nav navbar-right">
                <li class="{{Request::is('login') ? "active" : ""}}"><a href="{{route('login')}}">Entrar</a></li>
                <li class="{{Request::is('register') ? "active" : ""}}"><a href="{{route('register')}}">Registrarte</a></li>
             </ul>
          </div>
        @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
