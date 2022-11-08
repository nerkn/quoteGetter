@extends('index')

@section('content')
  @php
    $now = strtotime('now');
    foreach(explode(',', 'deadLine,resultExposure,created_at,updated_at') as $v){
      $$v = strtotime($request->$v );
      $vdiff = $v.'_diff'; 
      $$vdiff = floor(($$v-$now )/86400); 
    }
  @endphp
  <div class='flex request-show'>
    <div class='request-show-names'> 
        <div>Name</div>      
        <div> {{$request->name}} </div> 
        <div> {{$request->InternalName}}  </div></div>
    <div class="request-show-props"> 
        <div>Props</div>     
        <div title='visibility / status'> {{$request->visibility}}  <br /> {{$request->status}} </div></div>
    <div class="request-show-dates"> 
        <div>Dates</div>     
        <div class='grid-cols-3'>
          <div>Result Announcement </div><div>{{$request->resultExposure}}</div>
                <div>{{floor(($resultExposure - $now )/86400)}} days</div>
          <div>DeadLine       </div><div>{{$request->deadLine}}</div>
                <div>{{floor(($deadLine - $now )/86400)}} days</div>
          <div>Created     </div><div>{{$request->created_at}}</div>
                <div>{{floor(($now - $created_at )/86400)}} days</div>
        </div>
    </div>
  </div>
     <div class="atletOdd">
        <h3>Lines</h3>
        <div class="grid grid-cols-7">                                                     <div>
          Name                            </div><div>
          Make                            </div><div>
          Model                           </div><div>
          Quantity                        </div><div>
          Unit   </div><div>
          Exact                  </div><div>
          Required                        </div>
        </div>
        @each('Requests/showLine', $request->RequestLines()->get(), 'requestLine' )
     </div>




    

@endsection


  
