<?php

declare(strict_types=1);

namespace App\Models\Handlers;

use App\Jobs\Publishing\SourceRegistered;
use App\Models\Source;

use function dispatch;

final class SourceCreated
{
    public function __construct(Source $source)
    {
        dispatch(new SourceRegistered(
            source: $source,
        ));
    }
}
