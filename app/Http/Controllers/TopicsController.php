<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikePost;
use App\Http\Requests\NewPostRequest;
use App\Http\Requests\postEditRequest;
use App\Models\Posts;
use App\Models\Reputations;
use App\Models\Topics;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TopicsController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Topics $temat
	 * @return \Illuminate\Http\Response
	 */
	public function show(Topics $temat)
	{
		Posts::with('reputations')
			->first()->id;
		$posts = Posts::with('users', 'users.groups', 'users.ranks', 'users.reputations', 'users.warns')
			->where('topic', $temat->id)
			->orderBy('first', 'desc')
			->orderBy('date', 'asc')
			->paginate(config('app.pagination_topic'));
		
		$temat->views++;
		$temat->save();
		
		return view('topic', compact('temat', 'posts'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Topics $temat
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Topics $temat)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Topics $temat
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Topics $temat)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Topics $temat
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Topics $temat)
	{
		//
	}
	
	public function post_store(Topics $temat, NewPostRequest $request)
	{
		$this->authorize('create_post', $temat);
		app()->throttle;
		
		Posts::create([
			'author'  => auth()->user()->id,
			'date'    => Carbon::NOW(),
			'content' => $request->post,
			'topic'   => $temat->id,
		]);
		
		event( new \App\Events\newTopicOrPost($temat->sections->url) );
		
		return redirect()
			->back()
			->with('Done', 'Done');
	}
	
	public function post_like(LikePost $request)
	{
		app()->throttle;
		
		Reputations::create([
			'post'  => $request->post,
			'from'  => auth()->user()->id,
			'value' => config('app.reputation_value'),
		]);
		
		event(new \App\Events\PostLiked(Posts::where('id', $request->post)
			->first()));
		
		return redirect()
			->back()
			->with('Done', 'Done');
	}
	
	public function post_edit(postEditRequest $request)
	{
		$this->authorize('update', Posts::where('id', $request->pid)->first());
		
		Posts::where('id', $request->pid)
			->update(['content' => $request->post]);
		
		return response()->json([
			'post' => $request->post
		]);
	}
}
