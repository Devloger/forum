<?php

namespace App\Providers;

use App\Models\Users;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
	
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model'           => 'App\Policies\ModelPolicy',
		'App\Models\Users'    => 'App\Policies\UsersPolicy',
		'App\Models\Sections' => 'App\Policies\SectionsPolicy',
		'App\Models\Topics'   => 'App\Policies\TopicsPolicy',
		'App\Models\Posts'    => 'App\Policies\PostsPolicy',
	];
	
	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();
		
		Gate::define( 'ownMessage',
			function( $user, $message )
			{
				return ( $user->id === $message->to OR $user->id === $message->from ) AND $message->parent === null;
			} );
		
		Gate::define( 'sendNewMessage',
			function( $user, $to )
			{
				return $user->id !== (int)$to;
			} );
	}
}
