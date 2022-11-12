@php
  $myRequests ??= False;
  $colCount = $myRequests?4:3; 
@endphp

<div class='grid grid-cols-{{$colCount}}'>
  <h4>{{$request->name}}</h4>
  @if ($myRequests)
    <div class='internalName'>{{$request->InternalName}}</div>
  @endif
  <div class='status'>{{$request->status}}</div>
  <div class='actions'>
      <a href='/requests/{{$request->id}}'>Properties</a>
      <a href='/requests/{{$request->id}}/Offers'> {{$request->Offers()->count()}} Offers</a>
      <a href='/requests/{{$request->id}}/Invite'> Invite </a>
  </div>
</div>


{{--
$table->id();
        $table->string('name');         
        $table->string('InternalName'); 
        $table->string('type'); 
        $table->dateTime('deadLine');
        $table->dateTime('resultExposure');
        $table->enum('visibility', ['Public', 'Deleted','Offer Waiting','Closed','Archived']);
        $table->enum('status', ['Active', 'Deleted','Offer Waiting','Closed','Archived']);
        $table->timestamps();
        $table->foreignId('company_id')->constrained();
--}}