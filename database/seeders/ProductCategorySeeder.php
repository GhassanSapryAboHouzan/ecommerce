<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /////// Cloths
        $clothes = ProductCategory::create([
            'name' => 'Cloths', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => null,
        ]);
        ProductCategory::create([
            'name' => 'Women T-Shirt', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => $clothes->id,
        ]);
        ProductCategory::create([
            'name' => 'Men T-Shirt', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => $clothes->id,
        ]);
        ProductCategory::create([
            'name' => 'Baby T-Shirt', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => $clothes->id,
        ]);
        ProductCategory::create([
            'name' => 'Boy T-Shirt', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => $clothes->id,
        ]);
        ProductCategory::create([
            'name' => 'Girl T-Shirt', 'image' => 'cloths.jpg', 'status' => true, 'parent_id' => $clothes->id,
        ]);


        /////// Shoes
        $shoes = ProductCategory::create([
            'name' => 'Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => null,
        ]);
        ProductCategory::create([
            'name' => 'Men Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id,
        ]);
        ProductCategory::create([
            'name' => 'Women Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id,
        ]);
        ProductCategory::create([
            'name' => 'Baby Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id,
        ]);
        ProductCategory::create([
            'name' => 'Boy Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id,
        ]);
        ProductCategory::create([
            'name' => 'Girl Shoes', 'image' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id,
        ]);


        /////// Watches
        $watches = ProductCategory::create([
            'name' => 'Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => null,
        ]);
        ProductCategory::create([
            'name' => 'Men Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id,
        ]);
        ProductCategory::create([
            'name' => 'Women Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id,
        ]);
        ProductCategory::create([
            'name' => 'Baby Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id,
        ]);
        ProductCategory::create([
            'name' => 'Boy Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id,
        ]);
        ProductCategory::create([
            'name' => 'Girl Watches', 'image' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id,
        ]);


        /////// Electronics
        $electronics = ProductCategory::create([
            'name' => 'Electronics', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => null,
        ]);
        ProductCategory::create([
            'name' => 'USB Flash', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id,
        ]);
        ProductCategory::create([
            'name' => 'Headphone', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id,
        ]);
        ProductCategory::create([
            'name' => 'Mouse', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id,
        ]);
        ProductCategory::create([
            'name' => 'Keyboard', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id,
        ]);
        ProductCategory::create([
            'name' => 'laptop', 'image' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id,
        ]);
    }
}
