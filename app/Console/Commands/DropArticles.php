<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;
use App\Feed;

class DropArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:drop {feed?}';

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
				$feedId = $this->argument('feed');
				if($feedId == null){
					if ($this->confirm('Do you wish to delete all articles? [y|N]')) {
						Article::truncate();
						$this->info('Articles deleted.');
					}
				}else{
					$feed = Feed::find($feedId);
					if ($this->confirm('Do you wish to delete all articles for feed "'.$feed->name.'"? [y|N]')) {
						Article::where('feed_id',$feedId)->delete();
						$this->info('Articles deleted.');
					}
				}
    }
}
