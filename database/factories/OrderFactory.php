<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'store_id' => $store_id->random(),
            'customer_name' => $this->faker->name(),
            'attendee' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'total_amount' => $this->faker->numberBetween(100, 200),
            'status' => $this->faker->randomElement(['Paid']),
            'method' => $this->faker->randomElement(['Cash', 'M-Pesa']),
        ];
    }
}
