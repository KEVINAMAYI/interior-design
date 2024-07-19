<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationImage;
use App\Models\Variation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertArtificialGrassCarpetProducts();
        $this->insertWalltoWallGrassCarpetProducts();
        $this->insertCurtainRodsAndRailsProducts();
        $this->insertWallDecorProducts();
        $this->insertArtificialFlowerProducts();
        $this->insertOfficeBlindProducts();
        $this->insertAntiSlipsMatProducts();
    }


    /**
     *  CREATE ARTIFICIAL GRASS CARPET PRODUCTS
     */
    private function insertArtificialGrassCarpetProducts()
    {

        //create a product for artificial Grass Carpet
        $artificial_grass_carpet_product = Product::create([
            'name' => 'Artificial Grass Carpet',
            'description' => 'artificial grass carpet',
            'category_id' => $this->getCategoryId('grass_carpet')
        ]);

        //get variations for the artificial grass carpet
        $artificial_grass_carpet_variations = Variation::where('name', 'height')->get();

        //insert the variation prices and images
        foreach ($artificial_grass_carpet_variations as $variation) {
            $this->createProductVariation($artificial_grass_carpet_product->id, ['test.jpg'], $variation->id);
        }
    }


    /**
     *  CREATE WALL TO WALL GRASS CARPET PRODUCTS
     */
    private function insertWalltoWallGrassCarpetProducts()
    {

        $wall_carpet_category_id = $this->getCategoryId('wall_carpet');

        //define different products for the wall to wall carpets
        $wall_to_wall_carpets_products = [
            [
                'name' => 'Delta Carpets',
                'description' => 'delta carpets',
                'category_id' => $wall_carpet_category_id
            ],
            [
                'name' => 'Maasai Mara Carpets',
                'description' => 'maasai mara carpets',
                'category_id' => $wall_carpet_category_id
            ],
            [
                'name' => 'USA Carpets',
                'description' => 'USA carpets',
                'category_id' => $wall_carpet_category_id
            ],
            [
                'name' => 'VIP Carpets',
                'description' => 'VIP carpets',
                'category_id' => $wall_carpet_category_id
            ],
            [
                'name' => 'Madagascar Carpets',
                'description' => 'madagascar carpets',
                'category_id' => $wall_carpet_category_id
            ],
            [
                'name' => 'Executive Carpets',
                'description' => 'executive carpets',
                'category_id' => $wall_carpet_category_id
            ],
        ];

        //get variations for the wall to wall grass carpet
        $wall_to_wall_carpets_variations = Variation::where('name', 'color_shade')->get();

        foreach ($wall_to_wall_carpets_products as $wall_to_wall_carpets_product) {
            $product = Product::create($wall_to_wall_carpets_product);

            foreach ($wall_to_wall_carpets_variations as $variation) {
                $this->createProductVariation($product->id, ['test.jpg'], $variation->id);
            }
        }
    }


    /**
     *  CREATE CURTAIN RODS AND RAILS PRODUCTS
     */
    private function insertCurtainRodsAndRailsProducts()
    {
        $curtain_rod_category_id = $this->getCategoryId('curtain_rods');

        //create a product for curtain rods and rails
        $curtain_rod_product = Product::create([
            'name' => 'Curtain Rod',
            'description' => 'curtain rod',
            'category_id' => $curtain_rod_category_id
        ]);

        $curtain_rail_product = Product::create([
            'name' => 'Curtain Rail',
            'description' => 'curtain rail',
            'category_id' => $curtain_rod_category_id
        ]);

        //get variations for the curtain rods and rails
        $curtain_rod_variations = Variation::where('name', 'origin')->get();

        $curtain_rails_variations = Variation::where('name', 'durability')->get();

        foreach ($curtain_rod_variations as $variation) {
            $this->createProductVariation($curtain_rod_product->id, ['test.jpg'], $variation->id);
        }

        foreach ($curtain_rails_variations as $variation) {
            $this->createProductVariation($curtain_rail_product->id, ['test.jpg'], $variation->id);
        }

    }


    /**
     *  CREATE WALL TO WALL DECOR PRODUCTS
     */
    private function insertWallDecorProducts()
    {

        //get category id for wall decor
        $wall_decor_category_id = $this->getCategoryId('wall_decor');

        //define different products for the wall decor
        $wall_decor_products = [
            [
                'name' => 'Wall Papers',
                'description' => 'wall papers',
                'category_id' => $wall_decor_category_id
            ],
            [
                'name' => 'Fluted Panels',
                'description' => 'fluted panels',
                'category_id' => $wall_decor_category_id
            ],
            [
                'name' => '3D Foam Panels',
                'description' => '3d foam panels',
                'category_id' => $wall_decor_category_id
            ],
            [
                'name' => '3D Wall Panels',
                'description' => '3d wall panels',
                'category_id' => $wall_decor_category_id
            ]
        ];

        foreach ($wall_decor_products as $wall_decor_product) {
            $product = Product::create($wall_decor_product);
            $this->createProductVariation($product->id, ['test.jpg']);
        }
    }

    /**
     *  CREATE ARTIFICIAL FLOWERS PRODUCTS
     */
    private function insertArtificialFlowerProducts()
    {
        //get category id for artificial flowers
        $artificial_flowers_category_id = $this->getCategoryId('artificial_flowers');

        $product = Product::create([
            'name' => 'Artificial Flowers',
            'description' => 'artificial flowers',
            'category_id' => $artificial_flowers_category_id
        ]);

        $this->createProductVariation($product->id, ['test.jpg']);
    }

    /**
     *  CREATE OFFICE BLINDS PRODUCTS
     */
    private function insertOfficeBlindProducts()
    {

        //get category id for office blinds
        $office_blinds_category_id = $this->getCategoryId('office_blinds');

        //define different products for the office blinds
        $office_blinds_products = [
            [
                'name' => 'Vertical Blinds',
                'description' => 'vertical blinds',
                'category_id' => $office_blinds_category_id
            ],
            [
                'name' => 'Roller Blinds',
                'description' => 'roller blinds',
                'category_id' => $office_blinds_category_id
            ],
            [
                'name' => 'Sheer Blinds',
                'description' => 'sheer blinds',
                'category_id' => $office_blinds_category_id
            ],
        ];

        foreach ($office_blinds_products as $office_blinds_product) {
            $product = Product::create($office_blinds_product);
            $this->createProductVariation($product->id, ['test.jpg']);
        }
    }

    /**
     *  CREATE ANTI SLIP MATS PRODUCTS
     */
    private function insertAntiSlipsMatProducts()
    {

        //get category id for anti slips mats
        $anti_slips_mats_category_id = $this->getCategoryId('anti_slip_mats');

        //define different products for the anti slip mats
        $anti_slips_mats_products = [
            [
                'name' => 'Sphagheti Mats',
                'description' => 'sphageti mats',
                'category_id' => $anti_slips_mats_category_id
            ],
            [
                'name' => 'Perforated Mats',
                'description' => 'perforated mats',
                'category_id' => $anti_slips_mats_category_id
            ],
            [
                'name' => 'Coin Mats',
                'description' => 'coin mats',
                'category_id' => $anti_slips_mats_category_id
            ],
        ];

        foreach ($anti_slips_mats_products as $anti_slips_mats_product) {
            $product = Product::create($anti_slips_mats_product);
            $this->createProductVariation($product->id, ['test.jpg']);

        }
    }

    private function createProductVariation($product_id, $images, $variation_id = null)
    {
        $product_variation = ProductVariation::create([
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'price' => 300,
        ]);

        foreach ($images as $image) {
            ProductVariationImage::create([
                'product_variation_id' => $product_variation->id,
                'image_url' => $image
            ]);
        }

    }

    private function getCategoryId($slug)
    {
        return Category::where('slug', $slug)->first()->id;
    }
}
