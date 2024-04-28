<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Handlers\SourceCreated;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property null|string $logo
 * @property null|string $url
 * @property string $feed
 * @property null|string $description
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Collection<Item> $items
 */
final class Source extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'logo',
        'url',
        'feed',
        'description',
    ];

    /** @var array<string,class-string> */
    protected $dispatchesEvents = [
        'created' => SourceCreated::class,
    ];

    /** @return HasMany */
    public function items(): HasMany
    {
        return $this->hasMany(
            related: Item::class,
            foreignKey: 'source_id',
        );
    }
}
