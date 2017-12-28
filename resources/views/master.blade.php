<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        <notifications></notifications>
        <nav class="navbar navbar-findcond">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('home',['component' =>'users']) }}">Dialed Admin Pane</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        @foreach($routes as $route => $name)
                            <li class="{{ $route == $component ? 'active' : '' }}"><a href="{{ route('home', ['component' => $route]) }}">{{$name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <{{$component}}></{{$component}}>
                </div>
            </div>
        </div>
        
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>