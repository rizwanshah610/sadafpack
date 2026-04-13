<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageSize extends Model
{
    protected $table = 'package_sizes';

    protected $fillable = [
        'product_id', 'name', 'length', 'width', 'height', 'weight', 'unit', 'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}