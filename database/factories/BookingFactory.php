<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate' => $this->faker->numberBetween(1, 5),
            'hotel_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'total' => $this->faker->randomFloat(),
            'status' => $this->faker->numberBetween(0, 3),
        ];
    }
}
