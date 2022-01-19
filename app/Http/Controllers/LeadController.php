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

class LeadController extends Controller
{
	public function createlead()
	{
		$lead_details = Lead_details::orderBy('id', 'desc')->get();
		$lead_sources = Lead_source::all();
		$lead_industryes = Lead_industry::all();
		$lead_ratings = Lead_rating::all();
		$lead_statuss = Lead_status::all();
		$users = User::all();
		return view('lead/index', compact('lead_details', 'lead_sources', 'lead_industryes', 'lead_ratings', 'lead_statuss', 'users'));
	}	
	public function viewlead(Request $request)
	{
		$id=$request->id;
		$lead_details = Lead_details::find($id);
		$lead_address = Lead_addres::find($id);
		$leadFiles = Lead_file::where('lead_id','=', $id)->get();
		$lead_comments = Lead_comment::where('lead_id','=', $id)->get();
		$lead_activitys = Lead_activity::where('lead_id','=', $id)->get();
		$lead_statuss = Lead_status::all();
		$users = User::all();
		return view('lead/view', compact('lead_details', 'leadFiles', 'lead_comments', 'lead_statuss', 'users', 'lead_activitys', 'lead_address'));
	}
		public function taskInsert(Request $request){
		$request->validate([
			'task_subject'=>'required',
			'task_start_time'=>'required',
			'task_end_time'=>'required',
			'task_status'=>'required',
			'task_priority'=>'required',
			'task_assign'=>'required',
		]); 
		Lead_activity::insert([
			'lead_id' => $request->leadid,
			'user' => $request->user,
			'subject' => $request->task_subject,
			'activitytype' => 'Task',
			'modul_type' => 'Lead',
			'date_start' => $request->task_start_time,
			'date_end' => $request->task_end_time,
			'status' => $request->task_status,
			'priority' => $request->task_priority,
			'assign' => $request->task_assign,
			'description' => $request->task_des,
			'created_at' => Carbon::now(),
		]);
	}
	public function eventInsert(Request $request){
		$request->validate([
			'event_subject'=>'required',
			'event_start_time'=>'required',
			'event_end_time'=>'required',
			'event_status'=>'required',
			'event_priority'=>'required',
			'event_assign'=>'required',
		]); 
		Lead_activity::insert([
			'lead_id' => $request->leadid,
			'user' => $request->user,
			'subject' => $request->event_subject,
			'activitytype' => 'Event',
			'modul_type' => 'Lead',
			'date_start' => $request->event_start_time,
			'date_end' => $request->event_end_time,
			'status' => $request->event_status,
			'priority' => $request->event_priority,
			'assign' => $request->event_assign,
			'description' => $request->event_des,
			'created_at' => Carbon::now(),
		]);
	}
	public function commentInsert(Request $request){
		$request->validate([
			'comment'=>'required',
		]); 
		Lead_comment::insert([
			'module_type' => 'Lead',
			'lead_id' => $request->leadid,
			'user' => $request->user,
			'content' => $request->comment,
			'created_at' => Carbon::now(),
		]);
	}
	public function leadInsert(Request $request)
	{
		$request->validate([
			'last_name'=>'required',
			'pri_email'=>'required',
			'assign'=>'required',
		]); 
		Lead_details::insert([
			'email' => $request->pri_email,
			'firstname' => $request->first_name,
			'lastname' => $request->last_name,
			'company' => $request->company,
			'industry' => $request->industry,
			'rating' => $request->rating,
			'pnumber' => $request->number,
			'site' => $request->site,
			'leadstatus' => $request->lead_status,
			'leadsource' => $request->lead_source,
			'designation' => $request->designation,
			'assign' => $request->assign,
			'created_at' => Carbon::now(),
		]);
		Lead_addres::insert([
			'city' => $request->city,
			'state' => $request->state,
			'pobox' => $request->pio_box,
			'country' => $request->country,
			'street' => $request->street,
			'description' => $request->description,
			'postal_code' => $request->postal_code,
			'created_at' => Carbon::now(),
		]);
		// $lead_details = Lead_details::orderBy('id', 'desc')->get();
		// return view('lead/index', compact('lead_details');
	}
	function linkInsert(Request $request){
		$request->validate([
			'link_title'=>'required',
			'link'=>'required',
		]); 
		Lead_file::insert([
			'lead_id' => $request->leadid,
			'user_id' => $request->user,
			'title' => $request->link_title,
			'note' => $request->link_note,
			'file' => $request->link,
			'file_type' => 'LINK',
			'module_type' => 'Lead',
			'created_at' => Carbon::now(),
		]);
	}
	function leadupdatefrom(Request $request){
		$lead_details = Lead_details::find($request->id);
		$lead_addres = Lead_addres::find($request->id);
		$lead_sources = Lead_source::all();
		$lead_industryes = Lead_industry::all();
		$lead_ratings = Lead_rating::all();
		$lead_statuss = Lead_status::all();
		$users = User::all();
		$html='<div class="row" id="dataupdate">
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">First Name </label>
		<input class="form-control error" type="text" name="first_namei" id="first_namei" value="'.$lead_details->firstname.'" placeholder="Enter First Name">
		<input class="form-control error" type="hidden" name="lead_id" id="lead_id" value="'.$request->id.'">
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Last Name <span style="color:red;">*</span></label>
		<input class="form-control error" type="text" name="last_namei" placeholder="Enter Last Name" value="'.$lead_details->lastname.'" id="last_namei" required >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Company </label>
		<input class="form-control error" value="'.$lead_details->company.'" type="text" placeholder="Enter Company" name="companyi" id="companyi"  >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Mobile Number </label>
		<input class="form-control error" value="'.$lead_details->pnumber.'" type="text" placeholder="Enter Mobile Number" name="numberi" id="numberi"  >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Designation </label>
		<input class="form-control error" value="'.$lead_details->designation.'" type="text" placeholder="Enter Designation" name="designationi" id="designationi" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label>Lead Source</label>
		<select class="form-control" id="lead_sourcei" name="lead_sourcei">
		<option value="">Select A Source</option>';
		foreach($lead_sources as $sources){
			$html.='<option value="'.$sources->id.'">'.$sources->leadsource.'</option>';
		}
		$html.='</select>
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Primary Email <span style="color:red;">*</span></label>
		<input class="form-control error" value="'.$lead_details->email.'" type="email" placeholder="Enter Primary Email" name="pri_emaili" id="pri_emaili" required >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Industry </label>
		<select class="form-control error" id="industryi" name="industryi">
		<option value="">Select A Industry</option>';
		foreach($lead_industryes as $lead_industrye){
			$html.='<option value="'.$lead_industrye->id.'">'.$lead_industrye->industry.'</option>';
		}
		$html.='</select>
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Web Site </label>
		<input class="form-control error" value="'.$lead_details->site.'" type="text" placeholder="Enter Web Site" name="sitei" id="sitei" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label>Lead Status</label>
		<select class="form-control" id="lead_statusi" name="lead_statusi">
		<option value="">Select A Status</option>';
		foreach($lead_statuss as $lead_status){
			$html.='<option value="'.$lead_status->id.'">'.$lead_status->leadstatus.'</option>';
		}
		$html.='</select>
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label>Rating</label>
		<select class="form-control" id="ratingi" name="ratingi">
		<option value="">Select A Rating</option>';
		foreach($lead_ratings as $lead_rating){
			$html.='<option value="'.$lead_rating->id.'">'.$lead_rating->rating.'</option>';
		}
		$html.='</select>
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Assign To <span style="color:red;">*</span></label>
		<select class="form-control error" id="assigni" name="assigni" required>
		<option value="">Select Assign</option>';
		foreach($users as $user){
			$html.='<option value="'.$user->id.'">'.$user->name.'</option>';
		}
		$html.='</select>
		</div>
		</div>
		<p style="padding-top: 10px;font-size: 18px;">Address</p>
		<hr>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Street </label>
		<input class="form-control error" type="text" value="'.$lead_addres->street.'" placeholder="Enter Street" name="streeti" id="streeti" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">PO Box </label>
		<input class="form-control error" type="text" value="'.$lead_addres->pobox.'" placeholder="Enter PO Box" name="pio_boxi" id="pio_boxi" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Postal Code </label>
		<input class="form-control error" type="text" value="'.$lead_addres->postal_code.'" placeholder="Enter Postal Code" name="postal_codei" id="postal_codei" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">City </label>
		<input class="form-control error" type="text" value="'.$lead_addres->city.'" placeholder="Enter City" name="cityi" id="cityi" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Country </label>
		<input class="form-control error" type="text" value="'.$lead_addres->country.'" placeholder="Enter Country" name="countryi" id="countryi" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">State </label>
		<input class="form-control error" type="text" value="'.$lead_addres->state.'" placeholder="Enter State" name="statei" id="statei" >
		</div>
		</div>
		<div class="col-lg-4">
		<div class="form-group">
		<label class="control-label">Description </label>
		<textarea class="form-control error" name="descriptioni" id="descriptioni" >'.$lead_addres->description.'</textarea>
		<input type="hidden" name="_tokeni" id="_tokeni" value="'.csrf_token().'">
		</div>
		</div>
		</div>';
		$arr = array("html"=>$html);
		echo json_encode($arr);
	}
	public function leadUpdate(Request $request)
	{

		$request->validate([
			'last_name'=>'required',
			'pri_email'=>'required',
			'assign'=>'required',
		]); 
		Lead_details::where('id', $request->lead_id)->update([
			'email' => $request->pri_email,
			'firstname' => $request->first_name,
			'lastname' => $request->last_name,
			'company' => $request->company,
			'industry' => $request->industry,
			'rating' => $request->rating,
			'pnumber' => $request->number,
			'site' => $request->site,
			'leadstatus' => $request->lead_status,
			'leadsource' => $request->lead_source,
			'designation' => $request->designation,
			'assign' => $request->assign,
		]);
		Lead_addres::where('id', $request->lead_id)->update([
			'city' => $request->city,
			'state' => $request->state,
			'pobox' => $request->pio_box,
			'country' => $request->country,
			'street' => $request->street,
			'description' => $request->description,
			'postal_code' => $request->postal_code,
			'created_at' => Carbon::now(),
		]);
	}
}