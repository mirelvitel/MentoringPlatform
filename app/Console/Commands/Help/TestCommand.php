<?php

namespace App\Console\Commands\Help;

use App\Models\Help;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'help:test-command';

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
        $questions_and_answers = [
            'What is the name of the framework?' => 'Laravel',
            'What is the name of the templating engine?' => 'Blade',
            'What is the name of the ORM?' => 'Eloquent',
            'What is the name of the query builder?' => 'QueryBuilder',
        ];

        foreach ($questions_and_answers as $question => $answer) {
            Help::create([
                'question' => $question,
                'answer' => $answer,
            ]);
        }
    }
}
