<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Item;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ItemFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Item::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'link' => $this->faker->unique()->url(),
            'short_link' => $this->faker->unique()->url(),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->realText(),
            'dub' => null,
            'source_id' => Source::factory(),
            'published_at' => $this->faker->date(),
        ];
    }
}
