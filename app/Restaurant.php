<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    protected $fillable = ['name', 'description', 'location', 'fone'];

    public function userAssociation() {
        return $this->belongsTo(User::class);
    }
}
