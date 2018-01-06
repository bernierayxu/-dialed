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
                    <a href="#" class="btn btn-link btn-sm navbar-brand" @click="tests()">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </a>
                    <a class="navbar-brand" href="{{ route('home',['component' =>'users']) }}">Dialed Admin Pane</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="sidebar" v-bind:class="sidebarClass">
                    <ul class="nav nav-sidebar">
                        @foreach($routes as $route => $name)
                            <li class="{{ $route == $component ? 'active' : '' }}">s<a href="{{ route('home', ['component' => $route]) }}">{{$name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="main" v-bind:class="contentClass">
                    <{{$component}}></{{$component}}>
                </div>
            </div>
        </div>
        
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>