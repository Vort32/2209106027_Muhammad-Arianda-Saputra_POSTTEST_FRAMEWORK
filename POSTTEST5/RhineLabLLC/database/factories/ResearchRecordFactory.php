<?php

namespace Database\Factories;

use App\Models\ResearchProject;
use App\Models\ResearchRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResearchRecordFactory extends Factory
{
    protected $model = ResearchRecord::class;

    public function definition(): array
    {
        return [
            'research_project_id' => ResearchProject::factory(),
            'user_id' => User::factory(),
            'record_code' => strtoupper($this->faker->unique()->bothify('REC-####')),
            'classification' => $this->faker->randomElement(['internal', 'restricted', 'rahasia']),
            'status' => $this->faker->randomElement(['draft', 'review', 'final']),
            'approval_status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
            'recorded_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'summary' => $this->faker->paragraph(4),
        ];
    }
}
