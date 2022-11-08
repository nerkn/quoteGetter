@extends('index')

@section('content')
<h3 class=" text-center "> Request Form </h3>
<form method="post" 
      action="{{ route('requests.store') }}" 
      enctype="multipart/form-data"
      >
  @csrf 
  <div    class="request-create-form atlet border-t1">
    <label    for='name'>Name</label>
    <input    name='name'         id='name' />
    <div></div> 

    <label  for ='InternalName'>Internal Name</label>
    <input  name='InternalName'     id='InternalName'/>
    <div> Others cant see! </div> 

    <label  for ='deadLine'>Deadline</label>
    <input  name='deadline'         id='deadLine' type='date' />
    <div> Last date that orders can be submitted </div>
    
    <label  for ='resultExposure'>Result Anouncement</label>
    <input  name='resultExposure'   id='resultExposure' type='date' />
    <div>  </div>
    
    <label  for='visibility'>Visibility</label>
    <input  name='visibility' id='visibility' list='request-visibility' />
    <div>  </div>
    
  </div>
  <div class='request-create-lines'>
    <h3 class=" text-center "> Request Items </h3>
    <div class='request-create-line flex'>
      <input name='requestLine[name][]'     value='' placeholder="Item name" />
      <input name='requestLine[make][]'     value='' placeholder="Item make" />
      <input name='requestLine[model][]'    value='' placeholder="Model" />
      <input name='requestLine[quantity][]' value='' placeholder="Quantity" type='number' />
      <select name='requestLine[unit][]'    placeholder="Unit">
            <datalist id="request-line-units">
              {{$oldType='';}}
              @foreach($units as $unit)
                @if ($oldType !== $unit->type)
                  <optgroup label="{{$unit->type}}">
                @endif
                <option value="{{$unit->id}}">{{$unit->name}}</option>
                @if ($oldType !== $unit->type)
                  {{ $oldType = $unit->type; }} 
                @endif
              @endforeach
              
            </datalist>
      </select>
      <label> Exact item <a title='not a replacement'>*</a><input name='requestLine[exactRequested][]' value='1'  type='checkbox' /></label>
      <label> Required <input name='requestLine[required][]' value='1' checked='checked'  type='checkbox' /></label>
      <div>
        <input type="button" value='+' onclick='this.parentElement.parentElement.insertAdjacentElement("afterend", this.parentElement.parentElement.cloneNode(true))' />
        <input type="button" value='-' onclick='confirm("Delete Line?")?this.parentElement.parentElement.remove():""' />
      </div>
    </div>
  </div>

  <input class="request-create-form-submit-button " name='Save' id='Save' value='Save' type='Submit' />

</form>

<datalist id="request-visibility">
  <option value="Public">
  <option value="Private">
</datalist>




@endsection

