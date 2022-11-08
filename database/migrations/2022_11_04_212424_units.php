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
      Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('name'); //millimeter
        $table->string('type'); //length
        $table->timestamps();
      });
      
      Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name'); //millimeter
        $table->string('email'); //millimeter
        $table->string('type'); //length
        $table->timestamps();
      });      
      Schema::create('company_user', function (Blueprint $table) {
        $table->foreignId('companies_id')->constrained();
        $table->foreignId('users_id')->constrained();
        $table->enum('Position', ['Owner', 'Manager','Staff']);
        $table->timestamps();
      });    
      Schema::create('requests', function (Blueprint $table) {
        $table->id();
        $table->string('name');         
        $table->string('InternalName'); 
        $table->string('type'); 
        $table->dateTime('deadLine');
        $table->dateTime('resultExposure');
        $table->enum('visibility', ['Public', 'Private', 'Deleted','Offer Waiting','Closed','Archived']);
        $table->enum('status', ['Active', 'Deleted','Offer Waiting','Closed','Archived']);
        $table->timestamps();
        $table->foreignId('companies_id')->constrained();
      });      
      Schema::create('requestLine', function (Blueprint $table) {
        $table->id();                 
        $table->string('name');       
        $table->string('make');       
        $table->string('model');       
        $table->text('description');  
        $table->float('quantity');    
        $table->foreignId('units_id')->constrained();
        $table->integer('sortBy');    
        $table->boolean('exactRequested');  //  not replacement  
        $table->boolean('required');        //  item should be provided
        $table->timestamps();
        $table->foreignId('requests_id')->constrained();
      });
      Schema::create('requestCompanies', function (Blueprint $table) { // companies that should respond to this request
        $table->id();
        $table->foreignId('requests_id')->constrained();
        $table->foreignId('respondent')->constrained('companies');
        $table->enum('status', ['Invitation Send', 'Opened','Processing','Ready','Deleted','Archived']);
        $table->timestamps();
      });     

      Schema::create('offers', function (Blueprint $table) {
        $table->id();
        $table->string('name'); 
        $table->string('internalName'); 
        $table->text('specialNotes'); 
        $table->text('internalNotes');
        $table->dateTime('deadLine');
        $table->dateTime('resultExposure');
        $table->float('price');                 //offer total price
        $table->timestamps();
        $table->foreignId('companies_id')->constrained();
      });   
      Schema::create('offerLine', function (Blueprint $table) {
        $table->id();
        $table->integer('relatedOrderContent');
        $table->string('type');            
        $table->string('name');         
        $table->string('make');       
        $table->string('model');    
        $table->text('description');  
        $table->float('quantity');    
        $table->float('price');                 //line total price
        $table->integer('sortBy');    
        $table->boolean('required');  
        $table->timestamps();
        $table->foreignId('offers_id')->constrained();
      });
    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

      Schema::dropIfExists('offerLine');
      Schema::dropIfExists('offers');
      Schema::dropIfExists('requestCompanies');
      Schema::dropIfExists('requestLine');
      Schema::dropIfExists('requests');
      Schema::dropIfExists('companies');
      Schema::dropIfExists('units');
      Schema::dropIfExists('company_user');
 
        //
    }
};
