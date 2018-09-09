<?php

namespace App\Http\Controllers;

use App\Http\Requests\messageRequest;
use App\Http\Requests\newMessageRequest;
use App\Models\Messages;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller {
	
	/**
	 * MessagesController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$uzytkownik = auth()->user();
		$messages = DB::select(DB::raw('SELECT m.id, m.from, m.to, m.name, m.line, mm.date, mm.content, mm.from as author, mm.read FROM messages m LEFT JOIN messages mm ON mm.id = (SELECT id FROM messages WHERE messages.line = m.line ORDER BY date DESC LIMIT 1) WHERE m.first = 1 AND (m.to = '.$uzytkownik->id.' OR m.from = '.$uzytkownik->id.') GROUP BY m.line ORDER BY mm.date DESC'));
		
		return view('messages', compact('uzytkownik', 'messages'));
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
	public function store(newMessageRequest $request)
	{
		$this->validate($request, [
			'user' => 'numeric',
		]);
		
		$this->authorize('sendNewMessage', $request->user);
		
		Messages::create([
			'from' => auth()->user()->id,
			'to' => $request->user,
			'name' => $request->topic,
			'content' => $request->msg,
			'date' => Carbon::NOW(),
			'line' => Messages::max('line')+1,
			'first' => 1,
		]);
		
		return redirect()->route('index')->with('Done', 'Done');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Messages $messages
	 * @return \Illuminate\Http\Response
	 */
	public function show(Messages $wiadomosci)
	{
		$this->authorize('ownMessage', $wiadomosci);
		
		$uzytkownik = auth()->user();
		
		event(new \App\Events\msgShownEvent($uzytkownik, $wiadomosci));
		
		return view('message', compact('uzytkownik', 'wiadomosci'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Messages $messages
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Messages $wiadomosci)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Messages $messages
	 * @return \Illuminate\Http\Response
	 */
	public function update(messageRequest $request, Messages $wiadomosci)
	{
		$this->authorize('ownMessage', $wiadomosci);
		
		$to = ($wiadomosci->from === auth()->user()->id ? $wiadomosci->to : $wiadomosci->from );
		
		Messages::create([
			'from' => auth()->user()->id,
			'to' => $to,
			'content' => $request->msg,
			'date' => Carbon::NOW(),
			'line' => $wiadomosci->line,
		]);
		
		return redirect()->back()->with('Done', 'Done');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Messages $messages
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Messages $wiadomosci)
	{
		//
	}
}
