<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead_addres;
use App\Models\User;
class InvoiceController extends Controller
{
   	public function invoiceShow()
	{
		$lead_address = Lead_addres::all();
		$users = User::all();
		return view('invoice/invoice', compact('lead_address', 'users'));
	}
}
