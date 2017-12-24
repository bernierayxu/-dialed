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
                    <a class="navbar-brand" href="{{ route('home') }}">Dialed Admin Pane</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">User</a></li>
                        <li><a href="#">User Type</a></li>
                        <li><a href="#">Unit Of Measure</a></li>
                        <li><a href="#">Style Type</a></li>
                        <li><a href="#">Style Location</a></li>
                        <li><a href="#">Size</a></li>
                        <li><a href="#">Sale Person Type</a></li>
                        <li><a href="#">Sale Person</a></li>
                        <li><a href="#">Price</a></li>
                        <li><a href="#">Price Type</a></li>
                        <li><a href="#">Price Step</a></li>
                        <li><a href="#">Price Option</a></li>
                        <li><a href="#">Organization</a></li>
                        <li><a href="#">Organization Type</a></li>
                        <li><a href="#">Length</a></li>
                        <li><a href="#">Currency</a></li>
                        <li><a href="#">Contact Type</a></li>
                        <li><a href="#">Component Type</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>
        
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>