<?php

declare(strict_types=1);

namespace App\Jobs\Publishing;

use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\XmlReader;

final class SourceRegistered implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Source $source,
    ) {
    }

    public function handle(Dispatcher $bus): void
    {
        $reader = XmlReader::fromPsrResponse(
            response: Http::get($this->source->feed)->toPsrResponse(),
        );

        $bus->dispatch(
            new AddingSourceMeta(
                source: $this->source,
                feed: $reader->element('link')->get(),
            ),
        );

        foreach ($reader->value('item')->get() as $item) {
            $bus->dispatch(new AddItemFromFeed(
                source: $this->source,
                item: $item,
            ));
        }
    }
}
