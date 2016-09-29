<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;

use App\Feed;


class ArticleController extends Controller
{
    public function index($page=0)
    {
        $npages = floor(Article::count() / 10);
		$articles = Article::with('Feed')->orderBy('pub_date','desc')->offset($page*10)->limit(10)->get();
    	return view('feeds.articles',compact('articles','page','npages'));
    }
}
