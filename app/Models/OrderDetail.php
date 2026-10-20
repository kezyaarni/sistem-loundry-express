<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'service_id', 'qty_or_weight', 'subtotal'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
