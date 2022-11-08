

<div class="grid grid-cols-7">                                                     <div>
  {{$requestLine->name}}                            </div><div>
  {{$requestLine->make}}                            </div><div>
  {{$requestLine->model}}                           </div><div class='text-right'>
  {{$requestLine->quantity}}                        </div><div>
  {{$requestLine->unit->name }}      </div><div>
  {{$requestLine->exactRequested}}                  </div><div>
  {{$requestLine->required}}                        </div>
</div>








