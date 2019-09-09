<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function menus(){
        return $this->belongsTo(Menu::class);
    }
}
