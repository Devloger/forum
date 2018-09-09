<?php

namespace App\Providers;

use App\Models\Pages;
use App\Models\Posts;
use App\Models\Topics;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider {
	
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Schema::defaultStringLength( 191 );
		
		//-------------------------------------------------------------------------------------View composers
		
		View::composer( 'templates.footer', function( $view )
		{
			$counts = DB::select( DB::raw( 'SELECT (SELECT COUNT(*) FROM users) AS users, (SELECT COUNT(*) FROM topics) AS topics, (SELECT COUNT(*) FROM posts) AS posts' ) )[0];
			
			$users = $counts->users;
			$topics = $counts->topics;
			$posts = $counts->posts;
			
			$pages = Pages::all();
			
			$view->with( compact( 'users', 'topics', 'posts', 'pages' ) );
		} );
		
		View::composer( 'templates.main-start', function( $view )
		{
			$breadcrumbs = explode( '/', Request::path() );
			$from = array(
				'temat',
				'uzytkownik',
				'sekcja',
				'strona',
				'edit',
				'create',
			);
			$to = array(
				'Temat',
				'Użytkownik',
				'Sekcja',
				'Strona',
				'Edycja',
				'Tworzenie',
			);
			$breadcrumbs = str_replace( $from, $to, $breadcrumbs );
			if( empty( $breadcrumbs[0] ) )
			{
				$breadcrumbs = array( 'Strona Główna' );
			}
			
			$view->with( compact( 'breadcrumbs' ) );
		} );
		
		//-----------------------------------------------------------------------------------------Blade Ifs
		
		\Blade::if( 'canSendMessage', function( $to )
		{
			return auth()->check() AND $to->id !== auth()->user()->id AND $to->status === 1;
		} );
		
		\Blade::if( 'editPost', function( $post )
		{
			return ( auth()->check() AND $post->author === auth()->user()->id AND $post->topics->status === 1 AND $post->topics->sections->status === 1 ) OR ( auth()->check() AND auth()
						->user()
						->haveSectionRights( $post->topics->sections ) );
		} );
		
		\Blade::if( 'answerTopic', function( $topic )
		{
			return auth()->check() AND $topic->status === 1 OR ( auth()->check() AND auth()
						->user()
						->haveSectionRights( $topic->sections ) );
		} );
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if( $this->app->environment( 'local', 'testing' ) )
		{
			$this->app->register( DuskServiceProvider::class );
		}
	}
}
