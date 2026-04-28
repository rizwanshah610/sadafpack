<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemPackageSize extends Model
{
    protected $fillable = [
        'order_item_id',
        'package_size_id',
        'quantity',
        'unit_price',

    ];

    public function packageSize()
    {
        return $this->belongsTo(PackageSize::class);
    }
}