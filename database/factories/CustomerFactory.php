<?php

namespace Database\Factories;

use App\Models\Customer; 

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"           => $this->faker->name(),
            "email"          => $this->faker->email(),
            "contact_number" => $this->faker->bothify('###########'),
            "contact_person" => $this->faker->name(),
            "address"        => $this->faker->address(),
            "tin_number"     => $this->faker->bothify('############'),
            "type"           => $this->faker->randomElement(['none', 'walk-in']),
        ];
    }
}
