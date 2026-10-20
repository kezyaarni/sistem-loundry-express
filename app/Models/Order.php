<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'whatsapp_number', 'total_price', 'status'];

    public function orderDetails()
    {
        return $this->HasMany(OrderDetail::class);
    }
}
