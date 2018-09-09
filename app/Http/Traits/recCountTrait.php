<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017-07-29
 * Time: 11:32
 */

namespace App\Traits;


use App\Models\Posts;
use App\Models\Sections;
use App\Models\Topics;

trait recCountTrait
{
    public function topics_count($id)
    {
        $section = Sections::where('id', $id)->first();
        $count = Topics::where('section', $section->id)->count();
        $check = Sections::where('parent', $id)->get();

        if($check->first() !== null)
        {
            foreach($check as $c)
            {
                $count = $count + $this->topics_count($c->id);
            }
            return $count;
        }
        else
        {
            return $count;
        }
    }

    public function posts_count($id)
    {
        $section = Sections::where('id', $id)->first();
        $topics = Topics::where('section', $section->id)->get();
        $count = Posts::whereIn('topic', $topics->pluck('id'))->count();
        $check = Sections::where('parent', $id)->get();

        if($check->first() !== null)
        {
            foreach($check as $c)
            {
                $count = $count + $this->topics_count($c->id);
            }
            return $count;
        }
        else
        {
            return $count;
        }
    }

    public function posts_count_many($id)
    {
        $a = collect();
        foreach($id as $i)
        {
            $a->push(['id' => $i, 'count' => $this->posts_count($i)]);
        }
        return $a;
    }

    public function topics_count_many($id)
    {
        $collection = collect();
        foreach($id as $i)
        {
            $collection->push(['id' => $i, 'count' => $this->topics_count($i)]);
        }
        return $collection;
    }
    
    public function section_urls($section)
	{
		$url[] = $section;
		$section = Sections::where('url', $section)->first();
		$parent = $section->parent;
		
		if( !is_null($parent) )
		{
			$parent_section = Sections::where('id', $parent)->first();
			$parent_url = $parent_section->url;
			
			$url[] = $this->section_urls($parent_url);
		}
		
		return array_flatten($url);
	}
}