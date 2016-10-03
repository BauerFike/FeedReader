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
        return view('feeds.list',['feeds'=>App\Feed::with('category')->get()]);
    }

	public function insert(Request $request,Feed $feed)
	{
		$this->validate($request,[
				'name'=>'required|unique:feeds',
				'xmlUrl'=>'required|unique:feeds|url',
				'htmlUrl'=>'url',
		]);
		Feed::create($request->all());
		return redirect('/feeds');
	}

	public function edit(Feed $feed)
	{
		return view("feeds.edit",['feed'=>$feed]);
	}

	public function update(Request $request,Feed $feed)
	{
		$this->validate($request,[
				'name'=>'required|unique:feeds,name,'.$feed->id,
				'xmlUrl'=>'required|unique:feeds,xmlUrl,'.$feed->id.'|url',
				'htmlUrl'=>'url',
		]);
		$feed->update($request->all());
		return redirect('/feeds');
	}

    public function delete(Feed $feed)
    {
        $feed->delete();
        return back();
    }
}
