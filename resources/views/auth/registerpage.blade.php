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
    <form method="POST" action="/admin/register">
        @csrf

        <h1>Register Here</h1>
        <br>

        <div>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" placeholder="your id" value="{{ old('id') }}">
        </div>
        @error('id')
        <div class="alert-danger">{{$message}}</div>
        @enderror

        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" placeholder="your name" value="{{ old('name') }}">
        </div>
        @error('name')
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
            <label for="password_confirmation">Password Again</label>
            <input type="text" name="password_confirmation" id="password_confirmation" placeholder="repeat your password">
        </div>
        @error('password_confirmation')
        <div class="alert-danger">{{$message}}</div>
        @enderror

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="your email" value="{{ old('email') }}">
        </div>
        @error('email')
        <div class="alert-danger">{{$message}}</div>
        @enderror

        <div>
            <button>REGISTER</button>
        </div>
        <!-- Scripts -->
    </form>
    <form action="/admin/login" method="get">
    <br>
    <div><button>BACK</button></div>
    </form>
</body>
</html>
