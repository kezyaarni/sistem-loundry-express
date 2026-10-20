<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['service_name', 'category', 'price_per_unit', 'unit_type', 'description'];

    public function orderDetail()
    {
        return $this->HasMany(OrderDetail::class);
    }
}
