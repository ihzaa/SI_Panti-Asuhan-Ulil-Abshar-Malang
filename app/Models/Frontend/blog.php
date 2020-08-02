<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
