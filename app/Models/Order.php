<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'company_id',
        'order_date',
        'delivery_date',
        'notes',
        'total_amount',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}