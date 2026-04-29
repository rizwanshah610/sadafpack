<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageSize extends Model
{
    protected $table = 'package_sizes';

    protected $fillable = [
        'product_id', 'name', 'price',
        'length',
        'width',
        'height',
        'sheet_size',
        'color',
        'ply',
        'paper',
        'nali',
        'unit', 'image'
    ];
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


/**
 * Returns size-specific price if set,
 * otherwise falls back to the parent product price.
 */
public function getEffectivePriceAttribute(): float
{
    if (!is_null($this->price)) {
        return (float) $this->price;
    }
    return (float) ($this->product->price ?? 0);
}
}