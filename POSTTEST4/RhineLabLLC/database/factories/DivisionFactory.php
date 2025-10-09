<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    protected $model = Division::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('DIV-###')),
            'name' => $this->faker->company . ' Division',
            'lead_scientist' => $this->faker->name,
            'mission' => $this->faker->sentence(12),
            'established_at' => $this->faker->dateTimeBetween('-10 years', '-2 years'),
        ];
    }
}
