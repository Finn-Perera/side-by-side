<!DOCTYPE html>
<!-- THIS FILE SHOULD BECOME APP.BLADE.PHP -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        -->
        <title> Side By Side - @yield('title') </title>
    </head>
    <body>
        <h1> Side By Side - @yield('title') </h1>
        <div>
            @yield('content')
        </div>
    </body>
</html>

