<?php

declare(strict_types=1);

namespace App\Models\Handlers;

use App\Jobs\Publishing\AddMetaToItem;
use App\Models\Item;

final class ItemCreated
{
    public function __construct(Item $item)
    {
        \dispatch(new AddMetaToItem(
            item: $item,
        ));
    }
}
