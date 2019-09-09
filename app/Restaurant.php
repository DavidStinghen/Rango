<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'description', 'location', 'fone'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

}
