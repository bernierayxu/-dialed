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
        <div class="container">

          <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Welcome</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" v-model="params.email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" v-model="params.password" id="inputPassword" class="form-control" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" @click="signin()">Sign in</button>
          </div>

        </div> <!-- /container -->
        
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>