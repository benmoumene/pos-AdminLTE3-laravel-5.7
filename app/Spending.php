<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    protected $guarded = [];

    public function CategorySpending()
    {
        return $this->belongsTo(CategorySpending::class);
    }
}