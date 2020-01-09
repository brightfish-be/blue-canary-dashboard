<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="google" value="notranslate">
        <meta name="robots" value="nofollow, noindex, noimageindex, noarchive, nosnippet, noodp">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>
        <script>window.canaryGlobals = {!! json_encode($jsGlobals) !!}; </script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app" class="p-5">
            <example-component/>
        </div>
    </body>
</html>
