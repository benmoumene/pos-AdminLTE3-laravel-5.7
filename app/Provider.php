<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = [];
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}