<?php

declare(strict_types=1);

namespace App\Jobs\Publishing;

use App\Models\Item;
use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

final class AddItemFromFeed implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Source $source,
        public readonly array $item,
    ) {
    }

    public function handle(Dispatcher $bus, DatabaseManager $database): void
    {
        $item = $database->transaction(
            callback: fn () => Item::query()->updateOrCreate(
                attributes: [
                    'link' => $this->item['guid'] ?? $this->item['link'],
                    'source_id' => $this->source->id,
                ],
                values: [
                    'title' => $this->item['title'],
                    'description' => $this->item['description'],
                    'published_at' => Carbon::parse(
                        time: $this->item['pubDate'],
                        timezone: 'UTC',
                    ),
                ],
            ),
            attempts: 3,
        );

        $bus->dispatch(new CreateShortLinkForItem(
            item: $item,
        ));
    }
}
