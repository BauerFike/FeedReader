<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;

use App\Feed;

use App\Category;

use DB;


class ArticleController extends Controller
{
    public function index(Request $request)
    {
    	return view('articles.list',['articles'=>Article::orderBy('pub_date','desc')->paginate(2)]);
    }

		public function feeds(Feed $feed)
		{
			return view('articles.list',['articles'=>Article::where('feed_id',$feed->id)->orderBy('pub_date','desc')->paginate(2)]);
		}

		public function categories(Category $category)
		{
			DB::enableQueryLog();

			// $articlesList = Article::with("feed");
			// $articles = $articlesList->where('category_id', $category->id)->orderBy('pub_date','desc')->paginate(2);
			$articles = Article::with(['feed' => function ($query) use ($category)  {
				$query->where('category_id', $category->id);
			}])->orderBy('pub_date','desc');
			dd(DB::getQueryLog());
			// $articles = DB::table('articles')
      //       ->leftJoin('feeds', 'articles.feed_id', '=', 'feeds.id')
			// 			->select('articles.*', "feeds.*")
			// 			->where('feeds.category_id',$category->id)
      //       ->paginate(2);
			return view('articles.list', ['articles'=>$articles]);
		}
}
