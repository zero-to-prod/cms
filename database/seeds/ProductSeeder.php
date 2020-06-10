<?php

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $part     = factory(ProductType::class)->states('part')->create();
        $assembly = factory(ProductType::class)->states('assembly')->create();

        factory(Product::class,3)->createMany([
            ['product_type_id' => $part],
            ['product_type_id' => $assembly]
        ]);
    }
}
