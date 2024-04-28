<?php

declare(strict_types=1);

namespace App\Jobs\Publishing;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

final class AddMetaToItem implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Item $item,
    ) {
    }

    public function handle(DatabaseManager $database): void
    {
        // fetch meta information for source feed.
        $response = Http::get(
            url: 'https://api.dub.co/metatags?url=' . $this->item->link,
        );

        $database->transaction(
            callback: fn () => $this->item->update([
                'title' => $response->json('title') ?? $this->item->title,
                'description' => $response->json('description') ?? $this->item->description,
                'image' => $response->json('image') ?? $this->item->image,
            ]),
            attempts: 3,
        );
    }
}
