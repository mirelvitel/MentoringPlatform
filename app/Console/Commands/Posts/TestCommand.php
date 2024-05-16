<?php

namespace App\Console\Commands\Posts;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $news = [
            [
                'title' => 'Hello everyone!',
                'content' => '<p>Hello everyone!</p>
                        <p>I am looking for a new mentor to help me with ...</p>
                        <p>Thank you!</p>',
                'date' => Carbon::parse('2024-01-06 13:50'),
                'user_id' => 1,
            ],
            [
                'title' => 'Welcome to our new platform!',
                'content' => '<p>Welcome to our new platform!</p>
                        <p>We are excited to announce that we have launched a new platform ...</p>
                        <p>Thank you!</p>',
                'date' => Carbon::parse('2024-01-05 10:30'),
                'user_id' => 1,
            ],
            [
                'title' => 'New feature: Calendar',
                'content' => '<p>New feature: Calendar</p>
                        <p>We have added a new feature to our platform ...</p>
                        <p>Thank you!</p>',
                'date' =>  Carbon::parse('2024-01-04 15:20'),
                'user_id' => 1,
            ]
        ];

        foreach ($news as $item) {
            Post::create($item);
        }
    }
}
