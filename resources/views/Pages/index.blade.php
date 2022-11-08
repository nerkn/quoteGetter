@extends('index')




{{ count($latestPublicRequests) }}
@section('content')
  @each('Parts/request', $latestPublicRequests ,'request' )
@endsection