<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'description'];

    public function restaurants(){
        return $this->belongsTo(Restaurant::class);
    }

    public function registrations(){
        return $this->hasMany(Registration::class);
    }

}
