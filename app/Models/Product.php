<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id', 'name', 'description', 'price', 'image'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function packageSizes()
    {
        return $this->hasMany(PackageSize::class);
    }
}