<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
    @include('partials._nav')
    <div class="container">
    	<script src="js/scale.fix.js"></script>
        @include('partials._messages')

        @yield('content')
        @include('partials._footer')
    </div> <!-- end of .container -->
    @include('partials._javascript')
    @yield('scripts')
</body>
</html>
