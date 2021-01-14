<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'idorders';

    public function order_details()
    {
      return $this->hasMany('App\Models\OrdersDetails', 'idorders');
    }

    public function users()
    {
      return $this->belongsTo('App\Models\User', 'idusers');
    }
}
