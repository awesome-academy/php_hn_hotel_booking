<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => 'App\Notifications\OrderNotification',
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => $this->faker->randomDigit(),
            'data' => json_encode($this->faker->randomElements),
            'order_id' => $this->faker->randomDigit(),
            'read_at' => null,
        ];
    }
}
