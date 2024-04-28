<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class SourceFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Source::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'logo' => $this->faker->imageUrl(),
            'url' => $this->faker->url(),
            'feed' => $this->faker->url(),
            'description' => $this->faker->realText(),
        ];
    }
}
