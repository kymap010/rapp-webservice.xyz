<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;

class ItemController extends Controller
{


	public function index()
	{
		return view('front.item');
	}


}
