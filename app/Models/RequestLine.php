<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLine extends Model
{
    protected $table = 'requestLine';
    protected $guarded = [];
    use HasFactory;
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'units_id');
    }
}
