<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qty' => $this->faker->randomDigit(),
            'remaining' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat(),
            'type_id' => $this->faker->randomDigit(),
            'hotel_id' => $this->faker->randomDigit(),
        ];
    }
}
