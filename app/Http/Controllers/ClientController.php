<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead_details;
use App\Models\Lead_source;
use App\Models\Lead_industry;
use App\Models\Lead_rating;
use App\Models\Lead_status;
use App\Models\Lead_addres;
use App\Models\Lead_file;
use App\Models\Lead_comment;
use App\Models\Lead_activity;
use App\Models\User;
use Carbon\Carbon;
class ClientController extends Controller
{
	public function clientShow()
	{
		$lead_details = Lead_details::orderBy('id', 'desc')->get();
		$lead_sources = Lead_source::all();
		$lead_industryes = Lead_industry::all();
		$lead_ratings = Lead_rating::all();
		$lead_statuss = Lead_status::all();
		$users = User::all();
		return view('client/index', compact('lead_details', 'lead_sources', 'lead_industryes', 'lead_ratings', 'lead_statuss', 'users'));
	}
		public function viewClient(Request $request)
	{
		$id=$request->id;
		$lead_details = Lead_details::find($id);
		$lead_address = Lead_addres::find($id);
		$leadFiles = Lead_file::where('lead_id','=', $id)->get();
		$lead_comments = Lead_comment::where('lead_id','=', $id)->get();
		$lead_activitys = Lead_activity::where('lead_id','=', $id)->get();
		$lead_statuss = Lead_status::all();
		$users = User::all();
		return view('client/view', compact('lead_details', 'leadFiles', 'lead_comments', 'lead_statuss', 'users', 'lead_activitys', 'lead_address'));
	}
}
