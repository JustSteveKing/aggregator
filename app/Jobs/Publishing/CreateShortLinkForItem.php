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
use Illuminate\Support\Str;

final class CreateShortLinkForItem implements ShouldQueue
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
        $response = Http::withToken(
            token: \config('services.dub.token'),
        )->withQueryParameters(
            parameters: [
                'workspaceId' => config('services.dub.workspace'),
            ],
        )->post(
            url: 'https://api.dub.co/links',
            data: [
                'url' => $this->item->link,
                'tags' => [
                    Str::lower($this->item->source->name),
                    Str::lower(config('app.name')),
                ],
            ]
        );

        $database->transaction(
            callback: fn () => $this->item->update([
                'short_link' => $response->json('shortLink'),
                'dub' => $response->json(),
            ]),
            attempts: 3,
        );
    }
}
