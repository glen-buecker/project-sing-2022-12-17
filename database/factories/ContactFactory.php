<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first' => $this->faker->regexify('[A-Za-z0-9]{25}'),
            'last' => $this->faker->regexify('[A-Za-z0-9]{25}'),
            'preferred' => $this->faker->regexify('[A-Za-z0-9]{25}'),
            'address1' => $this->faker->streetAddress,
            'address2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
            'notes' => $this->faker->text,
        ];
    }
}
