<?php

namespace App\Http\Controllers;

use App\Policy;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$policies = Policy::orderBy('created_at', 'desc')->get();

		return view('home', compact('policies'));
	}
}
