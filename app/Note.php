<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function images()
    {
       return $this->hasMany(Image::class);
    }
}
