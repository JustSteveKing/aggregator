<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Steve McDougall',
            'email' => 'juststevemcd@gmail.com',
        ]);

        Source::factory()->create([
            'name' => 'Laravel News',
            'logo' => 'https://static.feedpress.com/logo/laravelnews-6027ee343fdff.png',
            'url' => 'https://www.laravel-news.com',
            'feed' => 'https://feed.laravel-news.com',
            'description' => 'Your official Laravel news source.'
        ]);
    }
}
