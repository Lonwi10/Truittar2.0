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
      <a class="navbar-brand" href="/">Proyecto Sintesis</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{Request::is('/') ? "active" : ""}}"><a href="/">Inicio</a></li>
        <li class="{{Request::is('blog') ? "active" : ""}}"><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="{{Request::is('about') ? "active" : ""}}"><a href="/about">Informacion</a></li>
        <li class="{{Request::is('contact') ? "active" : ""}}"><a href="/contact">Contactar</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido!: {{Auth::user()->name}} , {{Auth::user()->email}}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('posts.index')}}">Posts</a></li>
                <li><a href="{{route('categories.index')}}">Categorias</a></li>
                <li><a href="{{route('tags.index')}}">Hagstags</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{route('logout')}}">Desconectarte</a></li>
              </ul>
            </li>
        @else
            <ul class="nav navbar-nav">
              <li class="{{Request::is('login') ? "active" : ""}}"><a href="{{route('login')}}">Entrar</a></li>
              <li class="{{Request::is('register') ? "active" : ""}}"><a href="{{route('register')}}">Registrarte</a></li>
            </ul>
        @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
