<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Requests;




class Pages extends Controller
{
  public function indexPage(){ 
    $latestPublicRequests = Cache::remember('latestPublicRequests', 60, function () {
      return Requests::where('visibility','Public')->orderBy('id')->take(10)->get();
    }); 
    return view('Pages/index', ['latestPublicRequests'=>$latestPublicRequests]);
  }
}