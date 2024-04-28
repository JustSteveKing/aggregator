<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Feed;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use function Laravel\Prompts\{info,note,spin};

#[AsCommand(name: 'test:feed', description: 'Test fetching an RSS Feed.')]
final class TestFeed extends Command
{
    public function handle(): void
    {
        $rss = spin(
            callback: fn () => Feed::loadRss(
                url: 'https://feed.laravel-news.com',
            ),
            message: 'Fetching feed from Laravel News.',
        );

        note('Got Feed from Laravel News.');

        echo 'Title: ', $rss->title;
        echo 'Description: ', $rss->description;
        echo 'Link: ', $rss->url;

//        foreach ($rss->item as $item) {
//            echo 'Title: ', $item->title;
//            echo 'Link: ', $item->url;
//            echo 'Timestamp: ', $item->timestamp;
//            echo 'Description ', $item->description;
//            echo 'HTML encoded content: ', $item->{'content:encoded'};
//        }
    }
}
