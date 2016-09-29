<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;

use App\Feed;

class ArticleController extends Controller
{
    public function index()
    {
			$articles = Article::with('Feed')->orderBy('pub_date','desc')->limit(10)->get();
    	return view('feeds.articles',['articles'=>$articles]);
    }
}
