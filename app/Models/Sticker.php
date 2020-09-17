<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    public function letter()
    {
        return $this->belongsTo('App\Models\Letter');
    }
}
