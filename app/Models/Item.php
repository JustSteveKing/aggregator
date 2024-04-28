<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Handlers\ItemCreated;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $link
 * @property null|string $short_link
 * @property null|string $image
 * @property null|string $description
 * @property null|object $dub
 * @property string $source_id
 * @property null|CarbonInterface $published_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Source $source
 */
final class Item extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'title',
        'link',
        'short_link',
        'image',
        'description',
        'dub',
        'source_id',
        'published_at',
    ];

    /** @var array<string,class-string> */
    protected $dispatchesEvents = [
        'created' => ItemCreated::class,
    ];

    /** @return BelongsTo */
    public function source(): BelongsTo
    {
        return $this->belongsTo(
            related: Source::class,
            foreignKey: 'source_id',
        );
    }

    /** @return array<string,string|class-string> */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'dub' => AsArrayObject::class,
        ];
    }
}
