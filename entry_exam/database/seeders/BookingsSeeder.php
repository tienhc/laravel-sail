<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotelIds = DB::table('hotels')->pluck('hotel_id')->toArray();

        if (empty($hotelIds)) {
            $this->command->info('No hotels found, please add hotels first.');
            return;
        }

        $bookings = [];

        for ($i = 0; $i < 50; $i++) { // Tạo 50 dữ liệu ngẫu nhiên
            $checkin = Carbon::now()->addDays(rand(0, 10))->setHour(rand(12, 14))->setMinute(0);
            $checkout = (clone $checkin)->addDays(rand(1, 3));

            $bookings[] = [
                'hotel_id' => $hotelIds[array_rand($hotelIds)],
                'customer_name' => 'Customer ' . $i,
                'customer_contact' => 'customer' . $i . '@example.com',
                'checkin_time' => $checkin,
                'checkout_time' => $checkout,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('bookings')->insert($bookings);
        $this->command->info('Booking data has been seeded.');
    }
}
