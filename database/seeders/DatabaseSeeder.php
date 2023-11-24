<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Containers\Agent\Models\Agent;
use App\Containers\Delivery\Models\Order;
use App\Containers\Driver\Models\Driver;
use App\Containers\User\Models\User;
use App\Containers\Vendor\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::query()->count() == 0) {
            User::query()->create([
                'name' => fake()->name,
                'phone_number' => '09123456789',
                'phone_number_verified_at' => now()->subDays(5),
                'password' => Hash::make('123123123'),
            ]);

            User::query()->create([
                'name' => fake()->name,
                'phone_number' => '09112345678',
                'phone_number_verified_at' => now()->subDays(10),
                'password' => Hash::make('password'),
            ]);
        }

        if (Vendor::query()->count() == 0) {
            for ($i = 0; $i < 20; $i++) {
                Vendor::query()->insertOrIgnore([
                    'name' => fake()->lastName,
                    'phone_number' => fake()->phoneNumber,
                    'address' => fake()->address,
                ]);
            }
        }

        if (Driver::query()->count() == 0) {
            for ($i = 0; $i < 5; $i++) {
                Driver::query()->insertOrIgnore([
                    'name' => fake()->name,
                    'phone_number' => fake()->phoneNumber,
                ]);
            }
        }

        if (Agent::query()->count() == 0) {
            for ($i = 0; $i < 5; $i++) {
                Agent::query()->insertOrIgnore([
                    'name' => fake()->name,
                    'phone_number' => fake()->phoneNumber,
                ]);
            }
        }

        if (Order::query()->count() == 0) {
            $firstUser = User::query()->first();

            Order::query()->create([
                'user_id' => $firstUser->id,
                'vendor_id' => Vendor::query()->find(1)->id,
                'ordered_at' => now()->subDays(10),
                'delivery_time' => rand(10, 50),
                'status' => Order::STATUS_DELIVERED,
            ]);

            Order::query()->create([
                'user_id' => $firstUser->id,
                'vendor_id' => Vendor::query()->find(2)->id,
                'ordered_at' => now()->subMinutes(41),
                'delivery_time' => 40,
                'status' => Order::STATUS_PENDING,
            ]);
        }
    }
}
