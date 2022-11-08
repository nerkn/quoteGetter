<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $units = [
      ['name'=>'millimeter', 'type'=>'length'],
      ['name'=>'centimeter', 'type'=>'length'],
      ['name'=>'meter',      'type'=>'length'],
      ['name'=>'kilometer',  'type'=>'length'],

      ['name'=>'inch',        'type'=>'length'],
      ['name'=>'foot',        'type'=>'length'],
      ['name'=>'mile',        'type'=>'length'],
      
      ['name'=>'gram',        'type'=>'weight'],
      ['name'=>'kilogram',    'type'=>'weight'],
      ['name'=>'tonne',       'type'=>'weight'],

      ['name'=>'item',       'type'=>'countable'],
      ['name'=>'pack',       'type'=>'countable'],
      ['name'=>'parcel',     'type'=>'countable'],
      ['name'=>'package',    'type'=>'countable'],
      ];
        
      foreach($units as $unit){
    DB::table('units')->insert([
          'name' => $unit['name'],
          'type' => $unit['type']
        ]);
      }  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
