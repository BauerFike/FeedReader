<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;

class DropArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to delete all articles? [y|N]')) {
            Article::truncate();
        }
    }
}
