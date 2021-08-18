<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->numberBetween(0, 3),
            'avg_price' => $this->faker->randomFloat(),
            'description' => $this->faker->text,
            'province_id' => $this->faker->numberBetween(1, 63),
            'user_id' => $this->faker->randomDigit(),
            'rate' => $this->faker->numberBetween(1, 5),
        ];
    }
}
