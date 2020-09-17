<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    public function stickers()
    {
        return $this->hasMany('App\Models\Sticker');
    }
}
