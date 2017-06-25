<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		return view('pemda.dashboard.index');
	}
}