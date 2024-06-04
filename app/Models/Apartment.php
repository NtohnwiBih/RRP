<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function house(){

        return $this->belongsTo(House::class);

    }

    public function property(){

        return $this->belongsTo(Property::class);
    }
}
