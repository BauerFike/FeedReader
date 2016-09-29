<?php

namespace App\Console\Commands;

use DOMDocument;
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
		if(count($feeds)==0){
			$this->info('There are no rss feeds to import from.');
			return;
		}
		foreach ($feeds as $key => $feed) {
			$this->info('Retrieving articles from: '.$feed->xmlUrl);
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
			$this->info(' (!)Error: '.$feed->xmlUrl." unreachable.");
			continue;
		}
		$this->info(' Reached: '.$feed->xmlUrl.".");
		$httpCode = curl_getinfo($curl)["http_code"];
		if($httpCode!=200){
			$this->info(' (!)Error: '.$feed->xmlUrl." returning ".$httpCode.".");
			continue;
		}
		$this->info(' Status code: 200');
		curl_close($curl);
		$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
		if(!isset($xml->channel) || !isset($xml->channel->item)){
			$this->info(' (!)Error: '.$feed->xmlUrl.". XML unreadable.");
			continue;
		}
		$this->info(' XML readable.');
		$channel = (array)$xml->channel;
		$items = $xml->channel->item;
		foreach($items  as $item){
				$html = $item->children('content', true)->encoded != "" ? (string)$item->children('content', true)->encoded : '';
				$image = "";
				$doc = new DOMDocument();
			    @$doc->loadHTML($html);
			    $tags = $doc->getElementsByTagName('img');
				$image_list = "";
				if($tags->length!=0){
					$image_list = $tags[0]->getAttribute('src');
				}
				if(isset($item->enclosure[0])&&isset($item->enclosure[0]['type'])){
					if(strpos($item->enclosure[0]['type'],'image')!==false){
						$image = $item->enclosure[0]['url'];
					}
				}
				if($image_list == ""){
					$image_list = $image;
				}
				$item = (array)$item;
				if(sizeof(Article::where('guid',$item['guid'])->first())>0){
					$this->info('  Article already exists: '.$item['title']);
					continue;
				}
				$time = strtotime( $item['pubDate'] );
				if(!$time){
					$mysqldate = date( 'Y-m-d H:i' );
				}else{
					$mysqldate = isset($item['pubDate'])?date( 'Y-m-d H:i', strtotime( $item['pubDate'] ) ):date('Y-m-d H:i');
				}
				$this->info('  Adding article: '.$item['title']);
				$newArticle = Article::create(
						['title' => isset($item['title'])? $item['title'] : '' ,
						'link' => isset($item['link'])? $item['link'] : ''  ,
						'pub_date' => $mysqldate ,
						'category' => isset($item['category'][0])? $item['category'][0] : '' ,
						'guid' => isset($item['guid'])? $item['guid'] : '' ,
						'description' => isset($item['description'])? $item['description'] : '',
						'content' => $html,
						'comments' => '',
						'image' => $image,
						'image_list' => $image_list,
						'creator' => '',
						'post_id' => 0,
						'guid' => isset($item['guid'])? $item['guid'] : '',
						'feed_id' => $feed->id]
				);
				// $image = $item->children('content', true)->encoded != "" ? (string)$item->children('content', true)->encoded : '';
				// if(isset($channel['image']) && $channel['image']->url!=""){
				// 	$image = (array)$channel['image'];
				// 	Image::create([
				// 		'url' => isset($image['url'])? $image['url'] : ''  ,
				// 		'height' => isset($image['height'])? $image['height'] : ''  ,
				// 		'width' => isset($image['width'])? $image['width'] : ''  ,
				// 		'description' => isset($image['description'])? $image['description'] : ''  ,
				// 		'article_id' => isset($newArticle->id)? $newArticle->id : ''  ,
				// 	]);
				// }
			}
		}
	}
}
