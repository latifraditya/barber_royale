<?php

namespace Database\Seeders;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Booking::truncate();
      $barbers = Barber::all();
      $services = Services::all();
      $users = User::all();

      
      $startDate = Carbon::create(2025, 3, 20);
      $endDate = Carbon::create(2025, 4, 30);

      $faker = \Faker\Factory::create();
      Booking::factory()->count(12)->make()->each(function ($booking, $index) use ($barbers, $services, $users, $startDate, $endDate, $faker) {
            $booking->barber_id = $barbers->random()->id;
            $booking->services_id = $services->random()->id;
            $booking->user_id = $users->random()->id;

            // Generate a random date between March 20, 2025 and December 31, 2025
            $booking->booking_date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');

            // Generate a random time between 8 AM and 8 PM
            $booking->booking_time = Carbon::createFromTime(rand(8, 20), rand(0, 59), 0)->format('H:i');

            // Save the booking
            $booking->save();
        });
    }
}
