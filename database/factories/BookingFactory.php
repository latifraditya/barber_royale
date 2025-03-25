<?php

namespace Database\Factories;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'booking_date' => $this->faker->date(),
            'booking_time' => $this->faker->time(),
        ];
    }
}
