<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    protected $fillable = ['name', 'description', 'location', 'fone', 'user_id'];

    public function userAssociation() {
        return $this->belongsTo('User');
    }
}
