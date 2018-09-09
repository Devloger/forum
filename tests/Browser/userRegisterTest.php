<?php

namespace Tests\Browser;

use App\Models\Users;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class userRegisterTest extends DuskTestCase {
	
	/**
	 * A Dusk test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$this->browse( function( Browser $browser )
		{
			$browser->visit( '/' )
				->clickLink( 'Rejestracja' )
				->assertSee( 'Zarejestruj się' )
				->whenAvailable( 'main', function( $main )
				{
					$main->type( 'login', 'testLogintest' )
						->type( 'email', 'test9999@wp.pl' )
						->type( 'password', 'testpasswrd' )
						->type( 'password_confirmation', 'testpasswrd' )
						->check( 'policy' )
						->press( 'Zarejestruj moje konto' );
				} )
				->assertSourceHas( '<strong>Udało się!</strong>' );
			
			Users::where( 'login', 'testLogintest' )
				->delete();
		} );
	}
}
