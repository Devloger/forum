<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Messages;
use App\Models\Posts;
use App\Models\Sections;
use App\Models\Topics;
use App\Models\Users;

class UsersController extends Controller {
	
	public function __construct()
	{
		$this->middleware( 'UserAuth', [
			'only' => [
				'edit',
				'update',
			],
		] );
	}
	
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
		if( Auth()->check() )
		{
			return redirect( '/' );
		}
		
		return view( 'register' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( RegisterRequest $request )
	{
		Users::create( [
			'login'    => $request->login,
			'password' => bcrypt( $request->login ),
			'email'    => $request->email,
			'group'    => 1,
			'rank'     => 1,
		] );
		
		return redirect()
			->back()
			->with( 'done', 'Done!' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Users $users
	 * @return \Illuminate\Http\Response
	 */
	public function show( Users $uzytkownik )
	{
		return view( 'profile', compact( 'uzytkownik' ) );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Users $uzytkownik
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Users $uzytkownik )
	{
		$this->authorize( 'update', $uzytkownik );
		
		return view( 'edit-profile', compact( 'uzytkownik' ) );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Users $users
	 * @return \Illuminate\Http\Response
	 */
	public function update( UserUpdateRequest $request, Users $uzytkownik )
	{
		$this->authorize( 'update', $uzytkownik );
		
		$avatar = $uzytkownik->avatar;
		
		if( ! empty( $request->avatar ) )
		{
			$avatar = uniqid( true ) . '.jpg';
			$request->file( 'avatar' )
				->storeAs( config( 'app.avatars' ), $avatar );
		}
		
		$uzytkownik->update( [
			'birth'  => $request->birth,
			'sex'    => $request->sex,
			'about'  => $request->about,
			'avatar' => $avatar,
		] );
		
		return redirect()
			->back()
			->with( 'Done', 'Done' );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Users $users
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Users $uzytkownik )
	{
		//
	}
	
	public function message_create( Users $user )
	{
		$this->authorize( 'createNewMessage', $user );
		
		return view( 'send-message', compact( 'user' ) );
	}
}
