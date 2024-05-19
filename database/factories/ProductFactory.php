<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $store_id = collect(Store::all()->modelKeys());

        return [
            'product_name' => $this->faker->randomElement(['Pen','Cake','Pencil','Ruler','Sweater']),
            'store_id' => $store_id->random(),
            'description' => $this->faker->sentence(7),
            'cost_price' => $this->faker->numberBetween(50,100),
            'selling_price' => $this->faker->numberBetween(100, 150),
            'quantity' => $this->faker->numberBetween(30, 60),
            'manufacturing_date' => $this->faker->dateTimeThisMonth(),
            'expiry_date' => $this->faker->dateTimeThisYear(),
            'status' => $this->faker->randomElement(['In Stock', 'Sold Out']),
        ];
    }
}
