<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

    /**
     * 
     * Returns a collection of all order items
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items(){
        return $this->hasMany('App\Models\OrderItems');
    }
}
