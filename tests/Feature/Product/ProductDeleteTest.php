<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function test_it_can_delete_a_record()
     {
        $product = factory(Product::class)->create();

        $this->assertDatabaseHas('products', [
           'id' => $product->id
        ]);

         $this->json("DELETE", "api/products/{$product->slug}")
            ->assertStatus(200);

        $this->assertDeleted('products', [
           'id' => $product->id
        ]);
     }

}
