@php
  $myRequests ??= False;
  $colCount = $myRequests?4:3; 
@endphp

<div class='grid grid-cols-{{$colCount}}'>
  <h4>{{$offer->name}}</h4>
  @if ($myRequests)
    <div class='internalName'>{{$offer->InternalName}}</div>
  @endif
  <div class='status'>{{$offer->status}}</div>
  <div class='actions'>
      <a href='/requests/{{$offer->request_id}}/'>Properties</a>
      <a href='/requests/{{$offer->id}}/offer'>   offer</a>
      <a href='/requests/{{$offer->id}}/Invite'> Invite </a>
  </div>
</div>