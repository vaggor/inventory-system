<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
