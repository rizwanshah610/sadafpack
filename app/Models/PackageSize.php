<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageSize extends Model
{

    protected $fillable = ['product_id', 'length', 'width', 'height', 'image'];
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
