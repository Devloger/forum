<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Posts;
use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller {

	public function index()
	{
		//
	}

	public function create()
	{
		//
	}

	public function store(ReportRequest $request)
	{
		app()->throttle;
		Reports::create([
			'from' => auth()->user()->id,
			'to' => Posts::where('id', $request->post)->first()->author,
			'post' => $request->post,
			'content' => $request->report_content,
		]);

		return 1;
	}

	public function show(Reports $report)
	{
		//
	}

	public function edit(Reports $report)
	{
		//
	}

	public function update(Request $request, Reports $report)
	{
		//
	}
}
