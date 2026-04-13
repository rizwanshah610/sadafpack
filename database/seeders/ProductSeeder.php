<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            // PackCo Industries (company_id: 1)
            ['company_id' => 1, 'name' => 'Corrugated Box',   'description' => 'Strong corrugated shipping box',       'sku' => 'CB-001', 'price' => 150.00],
            ['company_id' => 1, 'name' => 'Bubble Wrap Roll', 'description' => 'Protective bubble wrap roll',           'sku' => 'BW-001', 'price' => 200.00],

            // SafePack Ltd (company_id: 2)
            ['company_id' => 2, 'name' => 'Foam Sheet',       'description' => 'Soft foam protective sheet',           'sku' => 'FS-001', 'price' => 80.00],
            ['company_id' => 2, 'name' => 'Stretch Film',     'description' => 'Pallet stretch wrap film',             'sku' => 'SF-001', 'price' => 350.00],

            // BoxMaster (company_id: 3)
            ['company_id' => 3, 'name' => 'Cardboard Tube',   'description' => 'Round cardboard tube for posters',     'sku' => 'CT-001', 'price' => 60.00],
            ['company_id' => 3, 'name' => 'Mailer Box',       'description' => 'Self-locking mailer box',              'sku' => 'MB-001', 'price' => 120.00],

            // FlexiPack Co (company_id: 4)
            ['company_id' => 4, 'name' => 'Poly Bag',         'description' => 'Clear poly packaging bags',            'sku' => 'PB-001', 'price' => 45.00],
            ['company_id' => 4, 'name' => 'Zipper Bag',       'description' => 'Resealable zipper storage bags',       'sku' => 'ZB-001', 'price' => 55.00],

            // GreenWrap (company_id: 5)
            ['company_id' => 5, 'name' => 'Kraft Paper Roll', 'description' => 'Eco-friendly kraft wrapping paper',    'sku' => 'KP-001', 'price' => 250.00],
            ['company_id' => 5, 'name' => 'Tissue Paper',     'description' => 'Soft tissue wrapping paper',           'sku' => 'TP-001', 'price' => 90.00],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
