<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'comments', 'user_id',
    ];

    protected $dates = ['date'];


    /**
     * returns the App\Models\User that created the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The orders related items
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items(){
        return $this->hasMany('App\Models\OrderItem');
    }
}
