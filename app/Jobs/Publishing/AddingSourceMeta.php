<?php

declare(strict_types=1);

namespace App\Jobs\Publishing;

use App\Models\Source;
use Feed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\Data\Element;

final class AddingSourceMeta implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param Source $source
     * @param array<int,Element> $feed
     */
    public function __construct(
        public readonly Source $source,
        public readonly array $feed,
    ) {
    }

    public function handle(DatabaseManager $database): void
    {
        // fetch meta information for source feed.
        $response = Http::get(
            url: 'https://api.dub.co/metatags?url=' . $this->feed[0]->getContent() ?? $this->source->url ?? $this->source->feed
        );

        $database->transaction(
            callback: fn () => $this->source->update([
                'description' => $response->json('description') ?? $this->source->description,
                'logo' => $response->json('image') ?? $this->source->logo,
            ]),
            attempts: 3,
        );
    }
}
