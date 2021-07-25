<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <form method="POST" action="/admin/login">
        @csrf
        <h1>Login Here</h1>
        <br>

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="your email" value="{{ old('email') }}">
        </div>
        @error('email')
        <div class="alert-danger">{{$message}}</div>
        @enderror

        <div>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" placeholder="your password">
        </div>
        @error('password')
        <div class="alert-danger">{{$message}}</div>
        @enderror

        <div>
        <button>LOGIN</button>
        </div>
        <!-- Scripts -->
    </form>

   @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <form action="/" method="get">
    <br>
    <div><button>BACK</button></div>
    </form>
    <div><a href="/admin/register">REGISTER</a></div>
    <div><a href="/">Exit</a></div>
</body>
</html>
