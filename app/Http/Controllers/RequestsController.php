<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestsRequest;
use App\Http\Requests\UpdateRequestsRequest;
use App\Models\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\Companies;
use App\Models\Unit;
use App\Models\User;
use App\Models\RequestLine;


class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      file_put_contents('/var/www/html/storage/logs/laravel.log', 'RequestsController/index', FILE_APPEND);
        $paginationItemCount = 5;
        $requests = Requests::latest()->paginate($paginationItemCount);

        return view('Requests/index', ['requests'=>$requests])
                    ->with('i', (request()->input('page', 1)-1)*$paginationItemCount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $units = Unit::orderBy('type', 'desc')->orderBy('id', 'asc')->get();
      
      return view('Requests/create', ['units'=>$units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestsRequest $request)
    { 
        $dateFormat = 'yy-m-d h:s';
        $requestObj = new Requests;
        $requestObj->name           = trim($request->name)?trim($request->name):date($dateFormat);
        $requestObj->InternalName   = $request->InternalName??'';
        $requestObj->type           = $request->type??'';
        $requestObj->deadLine       = $request->deadLine??date($dateFormat, strtotime(' +1 month'));
        $requestObj->resultExposure = $request->resultExposure??date($dateFormat, strtotime('+2 month'));
        $requestObj->visibility     = $request->visibility=='Public'?'Public': 'Private';
        $requestObj->status         = 'Active';
        $requestObj->companies_id     = 1;
        $requestObj->save();
        $requestLines = [];
        foreach ($request->requestLine['name'] as $lineNo => $name){
            $quantity = floatval($request->requestLine['quantity'][$lineNo]);
            if(!$quantity)
              continue;
            $requestLines[$lineNo] = new RequestLine([
              'name'        =>$name,
              'make'        =>$request->requestLine['make'][$lineNo]??'',
              'model'       =>$request->requestLine['model'][$lineNo]??'',
              'units_id'     =>$request->requestLine['unit'][$lineNo],
              'description' =>$request->requestLine['description'][$lineNo]??'',
              'quantity'    =>$quantity,
              'sortBy'      =>$lineNo,
              'exactRequested'    =>$request->requestLine['exactRequested'][$lineNo]??FALSE,
            ]);
            $requestObj->RequestLines()->saveMany($requestLines);
        }
        return $this->show($requestObj->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
      $userId = 1;//Auth::user()->id;
      $user = new User(['id'=>$userId]);
      $userCompanies   = $user->companies()->where('id', $userId);
      
      $request = Requests::find($id);

      return view('Requests/show', ['request'=>$request]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestsRequest  $request
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestsRequest $request, Requests $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
}
