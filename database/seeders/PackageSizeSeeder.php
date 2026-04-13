<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            // Corrugated Box
            ['product_id' => 1, 'name' => 'Small',  'length' => 20, 'width' => 15, 'height' => 10, 'weight' => 0.5, 'unit' => 'cm'],
            ['product_id' => 1, 'name' => 'Medium', 'length' => 30, 'width' => 25, 'height' => 20, 'weight' => 1.0, 'unit' => 'cm'],
            ['product_id' => 1, 'name' => 'Large',  'length' => 50, 'width' => 40, 'height' => 30, 'weight' => 2.0, 'unit' => 'cm'],
    
            // Bubble Wrap
            ['product_id' => 2, 'name' => '5m Roll',  'length' => 500, 'width' => 100, 'height' => null, 'weight' => 0.8, 'unit' => 'cm'],
            ['product_id' => 2, 'name' => '10m Roll', 'length' => 1000,'width' => 100, 'height' => null, 'weight' => 1.5, 'unit' => 'cm'],
    
            // Foam Sheet
            ['product_id' => 3, 'name' => 'A4', 'length' => 30, 'width' => 21, 'height' => 0.5, 'weight' => 0.1, 'unit' => 'cm'],
            ['product_id' => 3, 'name' => 'A3', 'length' => 42, 'width' => 30, 'height' => 0.5, 'weight' => 0.2, 'unit' => 'cm'],
    
            // Poly Bag
            ['product_id' => 7, 'name' => 'Small',  'length' => 10, 'width' => 15, 'height' => null, 'weight' => 0.05, 'unit' => 'cm'],
            ['product_id' => 7, 'name' => 'Medium', 'length' => 20, 'width' => 30, 'height' => null, 'weight' => 0.10, 'unit' => 'cm'],
            ['product_id' => 7, 'name' => 'Large',  'length' => 30, 'width' => 45, 'height' => null, 'weight' => 0.15, 'unit' => 'cm'],
        ];
    
        foreach ($sizes as $size) {
            \App\Models\PackageSize::create($size);
        }
    }
}
