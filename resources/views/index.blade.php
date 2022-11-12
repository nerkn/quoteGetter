<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
<div class='root flexcolumn'>
  @include('Layout/header')
  @include('Layout/menu')
  <div class='max-w-7xl min-h-screen'>
    @section('content') 
      @isset($requests)
        @foreach ($requests as $r)
            {{$r->name}}
        @endforeach  

        <div class=''>
          @each('Parts/request', $requests, 'request')
        </div>
      @endisset
      <h4>Content is coming </h4>
      ... soon
    @show 
  </div>
  @include('Layout/footer')
</div>


    </body>
  </html>