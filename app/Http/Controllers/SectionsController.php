<?php

namespace App\Http\Controllers;

use App\Acme\CacheHelper;
use App\Http\Requests\NewTopicRequest;
use App\Models\Posts;
use App\Models\Sections;
use App\Models\Topics;
use App\Traits\recCountTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class SectionsController extends Controller {
	
	use recCountTrait;
	
	public function index()
	{
		//
	}
	
	public function create()
	{
		//
	}
	
	public function store( Request $request )
	{
		//
	}
	
	public function show( Sections $sekcja )
	{
		$sections = $this->sections( $sekcja );
		$topics = Topics::where( 'section', $sekcja->id )
			->orderBy( 'pin', 'DESC' )
			->orderby( 'date', 'DESC' )
			->orderby( 'name' )
			->paginate( config( 'app.pagination_section' ) );
		list( $topics_count, $posts_count ) = CacheHelper::TopicsAndPostsCount( "$sekcja->url.topics_posts_count",
			$sections );
		
		return view( 'section', compact( 'sekcja', 'sections', 'topics', 'topics_count', 'posts_count' ) );
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////// Other SectionsController Methods
	
	private function sections( Sections $section ): array
	{
		$sections = DB::select( DB::raw( 'SELECT s.id, s.name AS name, s.url AS section_url, s.avatar AS section_avatar, t.name AS topic_name, t.url AS topic_url, p.date, u.login, u.avatar AS user_avatar FROM sections s LEFT JOIN topics t ON t.id = (SELECT topics.id FROM posts, topics, sections WHERE posts.topic = topics.id AND topics.section = s.id ORDER BY posts.date DESC LIMIT 1) LEFT JOIN posts p ON p.topic = t.id LEFT JOIN users u ON u.id = p.author WHERE s.parent = ' . $section->id . ' GROUP BY s.id ORDER BY s.name' ) );
		
		return $sections;
	}
	
	public function edit( Sections $sekcja )
	{
		//
	}
	
	public function update( Request $request, Sections $sekcja )
	{
		//
	}
	
	public function destroy( Sections $sekcja )
	{
		//
	}
	
	public function topic_create( Sections $sekcja )
	{
		$this->authorize( 'create_topic', $sekcja );
		
		return view( 'new-topic', compact( 'sekcja' ) );
	}
	
	public function topic_store( Sections $sekcja, NewTopicRequest $request )
	{
		$this->authorize( 'create_topic', $sekcja );
		
		app()->throttle;
		$name = str_slug( $request->name, '-' );
		while( Topics::where( 'url', $name )->first() !== null )
		{
			$name .= rand( 0, 10 );
		}
		Topics::create( [
			'name'    => $request->name,
			'section' => $sekcja->id,
			'url'     => $name,
			'date'    => Carbon::now(),
		] );
		Posts::create( [
			'author'  => auth()->user()->id,
			'date'    => Carbon::now(),
			'content' => $request->content,
			'topic'   => Topics::where( 'url', $name )->first()->id,
			'first'   => 1,
		] );
		
		event( new \App\Events\newTopicOrPost($sekcja->url) );
		
		return redirect()->intended( route( 'sekcja.show', $sekcja->url ) )->with( 'Done', 'Done' );
	}
}
