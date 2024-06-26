<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    public function vehicle(){

        return $this->belongsTo(Vehicle::class);

    }

    public function property(){

        return $this->belongsTo(Property::class);
    }
}
