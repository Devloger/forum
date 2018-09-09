<?php

namespace App\Acme;

use App\Traits\recCountTrait;
use Illuminate\Support\Facades\Cache;

class CacheHelper {
	
	use recCountTrait;
	
	public static function TopicsAndPostsCount($keyName, $sections)
	{
		return Cache::remember($keyName, config('app.cache'), function() use ($sections)
		{
			$instance = new static;
			return array(
				$instance->topics_count_many(array_pluck($sections, 'id')),
				$instance->topics_count_many(array_pluck($sections, 'id'))
			);
		});
	}
	
	public static function flush()
	{
		Cache::flush();
	}
	
	public static function flushIndex()
	{
		Cache::forget('index.topics_posts_count');
	}
	
	public static function flushSection($section)
	{
		$instance = new static;
		
		$section_and_parents = $instance->section_urls($section);
		
		foreach( $section_and_parents as $section )
		{
			Cache::forget($section.'.topics_posts_count');
			echo $section;
		}
	}
	
}