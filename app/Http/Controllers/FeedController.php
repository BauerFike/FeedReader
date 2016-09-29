<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App;

use Validator;

use App\Feed;

class FeedController extends Controller
{
    public function index()
    {
        return view('feeds.feeds',['feeds'=>App\Feed::all()]);
    }

	public function insert(Request $request,Feed $feed)
	{
		$this->validate($request,[
				'name'=>'required|unique:feeds',
				'xmlUrl'=>'required|unique:feeds|url',
				'htmlUrl'=>'url',
		]);
		Feed::create($request->all());
		return back();
	}

    public function delete(Feed $feed)
    {
        $feed->delete();
        return back();
    }
}
