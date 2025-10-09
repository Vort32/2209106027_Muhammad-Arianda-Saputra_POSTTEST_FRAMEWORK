<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\ResearchProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResearchProjectFactory extends Factory
{
    protected $model = ResearchProject::class;

    public function definition(): array
    {
        return [
            'division_id' => Division::factory(),
            'title' => $this->faker->unique()->sentence(3),
            'reference_code' => strtoupper($this->faker->unique()->bothify('PRJ-###-##')),
            'status' => $this->faker->randomElement(['ongoing', 'planning', 'archived', 'completed']),
            'initiated_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'objective' => $this->faker->paragraph(3),
        ];
    }
}
