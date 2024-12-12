<!DOCTYPE html>
<!-- THIS FILE SHOULD BECOME APP.BLADE.PHP -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title> Side By Side - @yield('title') </title>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @livewireStyles
    </head>
    <body>
        <h1> Side By Side - @yield('title') </h1>
        <div>
            @if ($errors->any())
                <div>
                    Errors:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <p style="color : red;"><b> {{ session('message') }}</b></p>
            @endif

            <div>
                @yield('content')
            </div>

            <div>
                @yield('comments')
            </div>
        </div>
        @livewireScripts
    </body>
</html>

