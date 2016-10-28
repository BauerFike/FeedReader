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
        $isScrolling = false;
        $isAjax = $request->input('ajax', "");
        if ($isAjax != "") {
            $isScrolling = true;
        }
        return view('articles.list', ['articles' => Article::orderBy('pub_date', 'desc')->paginate(4), 'isScrolling' => $isScrolling]);
    }

    public function feeds(Feed $feed)
    {
        return view('articles.list', ['articles' =>
            Article::where('feed_id', $feed->id)->orderBy('pub_date', 'desc')->paginate(4)]);
    }


    public function categories(Request $request, $categoryName)
    {
        $articles = Article::with('feed.category')->whereHas('feed.category', function ($query) use ($categoryName) {
            $query->whereRaw(' categories.name = ? ', array($categoryName));
        })->orderBy('pub_date', 'desc')->paginate(4);
        $isScrolling = false;
        $isAjax = $request->input('ajax', "");
        if ($isAjax != "") {
            $isScrolling = true;
        }
        return view('articles.list', ['articles' => $articles, 'isScrolling' => $isScrolling]);
    }
}
