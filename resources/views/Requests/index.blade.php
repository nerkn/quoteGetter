@extends('index')

    @section('content') 
      @isset($requests) 
        <div class=''>
          @each('Parts/request', $requests, 'request')
        </div>
      @endisset
    @endsection