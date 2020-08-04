<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $fillable = ['nama'];

    public function blog()
    {
        return $this->hasMany(blog_kategori::class);
    }
}
