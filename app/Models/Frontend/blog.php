<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
