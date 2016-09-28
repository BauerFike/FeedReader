<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Feed;
use App\Article;

class GetArticles extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	protected $signature = 'articles:get';

	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Update the list of articles.';

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
		$feeds = Feed::all();
		foreach ($feeds as $key => $feed) {
			$this->info('Retrieving articles from: '.$feed->xmlUrl);
			$this->info($feed->xmlUrl);
			$curl = curl_init();
			curl_setopt_array($curl, Array(
			CURLOPT_URL            => $feed->xmlUrl,
			CURLOPT_USERAGENT      => 'spider',
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_CONNECTTIMEOUT => 30,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_ENCODING       => 'UTF-8',
			CURLOPT_FOLLOWLOCATION => true
		));
		$data = curl_exec($curl);
		if($data===false){
			$this->info('Error: '.$feed->xmlUrl." unreachable.");
			continue;
		}
		$httpCode = curl_getinfo($curl)["http_code"];
		if($httpCode!=200){
			$this->info('Error: '.$feed->xmlUrl." returning ".$httpCode.".");
			continue;
		}

		curl_close($curl);
		$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
		if(!isset($xml->channel->item)){
			$this->info('Error: '.$feed->xmlUrl.". XML unreadable.");
			continue;
		}
		$items = $xml->channel->item;
		foreach($items  as $item){
				$html = $item->children('content', true)->encoded != "" ? (string)$item->children('content', true)->encoded : '';
				$item = (array)$item;
				$post_id = isset($item['guid']) ? explode("p=",$item['guid'])[1] : null;
				if(sizeof(Article::where('post_id',$post_id)->first())>0){
					$this->info('Article already exists: '.$item['title']);
					continue;
				}
				$mysqldate = isset($item['pubDate'])?date( 'Y-m-d H:i', strtotime( $item['pubDate'] ) ):date('Y-m-d H:i');
				$this->info('Adding article: '.$item['title']);
				Article::create(
						['title' => isset($item['title'])? $item['title'] : '' ,
						'link' => isset($item['link'])? $item['link'] : ''  ,
						'pub_date' => $mysqldate ,
						'category' => isset($item['category'][0])? $item['category'][0] : '' ,
						'guid' => isset($item['guid'])? $item['guid'] : '' ,
						'description' => isset($item['description'])? $item['description'] : '',
						'content' => $html,
						'comments' => '',
						'creator' => '',
						'post_id' => $post_id,
						'guid' => isset($item['guid'])? $item['guid'] : '',
						'feed_id' => $feed->id]
				);

		}
	}
	// $feeds = Entry::all();
	// foreach($feeds as $feed){
	// 	$curl = curl_init();
	// 	curl_setopt_array($curl, Array(
	// 			CURLOPT_URL            => $feed->url,
	// 			CURLOPT_USERAGENT      => 'spider',
	// 			CURLOPT_TIMEOUT        => 120,
	// 			CURLOPT_CONNECTTIMEOUT => 30,
	// 			CURLOPT_RETURNTRANSFER => TRUE,
	// 			CURLOPT_ENCODING       => 'UTF-8',
	// 			CURLOPT_FOLLOWLOCATION => true
	// 	));
	// 	$data = curl_exec($curl);
		// if($data===false){
		// 	Db::table('lucacostanzi_rssreader_feeds')->where('id', $feed->id)->update(['status' => "Unreachable"]);
		// 	continue;
		// }
		// $httpCode = curl_getinfo($curl)["http_code"];
		// if($httpCode!=200){
		// 		Db::table('lucacostanzi_rssreader_feeds')->where('id', $feed->id)->update(['status' => "Code: ".$httpCode]);
		// }
		//
		// curl_close($curl);
	// 	$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
	// 	if(!isset($xml->channel->item)){
	// 			Db::table('lucacostanzi_rssreader_feeds')->where('id', $feed->id)->update(['status' => "Unreadable"]);
	// 			continue;
	// 	}else{
	// 			$items = $xml->channel->item;
	// 	}
	// 	foreach($items  as $item){
	// 			$html = $item->children('content', true)->encoded != "" ? (string)$item->children('content', true)->encoded : null;
	// 			$item = (array)$item;
	// 			$entry = Db::table('lucacostanzi_rssreader_entries')->where('title', $item['title'])->first();
	//
	// 			if(!empty($entry)){
	// 					continue;
	// 			}else{
	// 				$mysqldate = isset($item['pubDate'])?date( 'Y-m-d H:i', strtotime( $item['pubDate'] ) ):date('Y-m-d H:i');
	// 				$post_id = isset($item['guid']) ? explode("p=",$item['guid'])[1] : null;
	// 				Db::table('lucacostanzi_rssreader_entries')->insert(
	// 						['title' => isset($item['title'])? $item['title'] : null ,'link' => isset($item['link'])? $item['link'] : null  ,'pub_date' => $mysqldate ,'category' => isset($item['category'][0])? $item['category'][0] : null ,'guid' => isset($item['guid'])? $item['guid'] : null ,'description' => isset($item['description'])? $item['description'] : null, 'content' => $html, 'post_id' => isset($item['post-id'])? $item['post-id'] : $post_id,'guid' => isset($item['guid'])? $item['guid'] : null,'feed_id' => $feed->id]
	// 				);
	// 			}
	//
	// 	}
	// }
}
}
