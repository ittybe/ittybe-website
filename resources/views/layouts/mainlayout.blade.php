<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="page-wrapper">
        <div class="header section">
            <a href="/">
                ittybe
            </a>
            <div class="menu">
                <a href="/posts">
                    posts
                </a>
            </div>
            
        </div>
        @yield('content')
        <div class="contacts section">
            <div>
                ittybemain@gmail.com
            </div>
            <a>
                github.com/user/ittybe                
            </a>
        </div>
    </div>
</body>
</html>