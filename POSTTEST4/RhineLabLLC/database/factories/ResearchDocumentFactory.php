<?php

namespace Database\Factories;

use App\Models\ResearchDocument;
use App\Models\ResearchRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResearchDocumentFactory extends Factory
{
    protected $model = ResearchDocument::class;

    public function definition(): array
    {
        return [
            'research_record_id' => ResearchRecord::factory(),
            'label' => $this->faker->words(3, true),
            'document_type' => $this->faker->randomElement(['brief', 'dataset', 'log', 'spec', 'analysis']),
            'access_level' => $this->faker->randomElement(['restricted', 'internal', 'clearance-2']),
            'storage_path' => $this->faker->optional()->lexify('archives/data-?????.bin'),
        ];
    }
}
