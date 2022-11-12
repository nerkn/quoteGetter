@extends('index')


@section('content')
@isset($request) 
  <div class=''>
    @each('Parts/requestOffers', $request->Offers, 'offer')
  </div>
@endisset
@endsection