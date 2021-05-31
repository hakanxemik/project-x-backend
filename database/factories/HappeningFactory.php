<?php

namespace Database\Factories;

use App\Models\Happening;
use Illuminate\Database\Eloquent\Factories\Factory;

class HappeningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Happening::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'date' => $this->faker->date(),
            'location' => json_encode(["location" => ["address" => $this->faker->address, "house_number" => $this->faker->randomNumber()]] ),
            'category' => json_encode(["category" => ["type" => $this->faker->name, "categories" => [$this->faker->catchPhrase]]]),
            'offerings'=> json_encode(["offerings" => [$this->faker->title, $this->faker->catchPhrase]]),
            'max_guests' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber()
        ];
    }
}
