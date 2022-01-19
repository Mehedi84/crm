<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead_addres;
use App\Models\User;
class ContactController extends Controller
{
   	public function contactShow()
	{
		$lead_address = Lead_addres::all();
		$users = User::all();
		return view('contact', compact('lead_address', 'users'));
	}
}
