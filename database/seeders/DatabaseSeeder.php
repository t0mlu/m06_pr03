<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Models\Apartment;
use App\Models\Platform;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        User::factory(10)->create();
        Apartment::factory(20)->create();
        Platform::factory(3)->create();

        for ($i = 0; $i < 50; $i++) {
            \DB::table('apartment_platform')->insert(
                [
                    'register_date' => $faker->date(),
                    'premium' => $faker->boolean(),
                    'apartment_id' => Apartment::all()->random()->id,
                    'platform_id' => Platform::all()->random()->id,
                ]
            );
        }
    }
}
