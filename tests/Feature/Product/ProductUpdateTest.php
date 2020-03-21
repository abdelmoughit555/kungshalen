<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductUpdateTest extends TestCase
{
    public function test_it_can_update_an_existant_record()
    {
        $product = factory(Product::class)->create();

        $this->json("PATCH", "api/products/{$product->slug}", [
            "description" => $value = "lorem"
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'description' => $value
        ]);
    }

    public function test_it_can_not_update_a_non_existant_record()
    {
        $this->json("PATCH", "api/products/nope", [
            "description" => "lorem"
        ])->assertStatus(404);
    }
}
