<?php

namespace App\Http\Controllers;

use App\Acme\CacheHelper;
use App\Models\Categories;
use App\Models\Sections;
use App\Traits\recCountTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

	use recCountTrait;

	public function index()
	{
		list($categories, $sections) = $this->categories();
		list($topics_count, $posts_count) = CacheHelper::TopicsAndPostsCount('index.topics_posts_count', $sections);
		$top_reputations = $this->top_reputations();
		$last_posts = $this->last_posts();

		return view('index', compact('categories', 'sections', 'last_posts', 'top_authors', 'top_reputations', 'topics_count', 'posts_count'));
	}
	
	private function top_reputations(): array
	{
		$top_reputations = DB::select(DB::raw('SELECT u.login AS author, u.avatar AS avatar, IFNULL(SUM(r.value), 0) AS reputation FROM users u LEFT JOIN posts p ON p.author = u.id LEFT JOIN reputations r ON r.post = p.id GROUP BY u.login ORDER BY reputation DESC LIMIT ' . config('app.top_users_count')));

		return $top_reputations;
	}

	private function last_posts(): array
	{
		return $last_posts = DB::select(DB::raw('SELECT p.id AS id, u.login AS author, p.content AS content, p.date AS date, u.avatar AS avatar, t.url AS url FROM posts p LEFT JOIN Users AS u ON u.id = p.author LEFT JOIN topics t ON t.id = p.topic GROUP BY p.id ORDER BY p.date DESC LIMIT ' . config('app.last_posts_count')));
	}

	function categories(): array
	{
		$categories = Categories::all();
		$sections = DB::select(DB::raw('SELECT s.id, s.name AS name, s.url AS section_url, s.avatar AS section_avatar, t.name AS topic_name, t.url AS topic_url, p.date, u.login, u.avatar AS user_avatar, s.category, s.parent, s.description FROM sections s LEFT JOIN topics t ON t.id = (SELECT topics.id FROM posts, topics, sections WHERE posts.topic = topics.id AND topics.section = s.id ORDER BY posts.date DESC LIMIT 1) LEFT JOIN posts p ON p.topic = t.id LEFT JOIN users u ON u.id = p.author WHERE s.parent IS NULL GROUP BY s.id ORDER BY s.name'));
		Carbon::setLocale('pl');

		foreach( $sections as $section )
		{
			$section->date = Carbon::parse($section->date)->diffForHumans();
		}

		return array(
			$categories,
			$sections,
		);
	}
}