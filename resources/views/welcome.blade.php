<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Google OAuth2</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="/css/base.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Google OAuth2
                </div>

                <div class="links">
                    <a href="https://github.com/google/google-api-php-client">Google API Client</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>

                <div align="left">
                    <ol>
                        <li><a href="/oauth2init">Init</a></li>
                        <li>Authorize on Google</li>
                        <li>Callback with auth code</li>
                        <li>Get access token using auth code</li>
                        <li>Use API using token</li>
                    </ol>
                </div>
            </div>
        </div>
    </body>
</html>
