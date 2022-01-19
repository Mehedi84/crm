<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">Summary</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="detailes-tab" data-bs-toggle="tab" data-bs-target="#detailes" type="button" role="tab" aria-controls="detailes" aria-selected="false">Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="false">Email</button>
  </li>  
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="activites-tab" data-bs-toggle="tab" data-bs-target="#activites" type="button" role="tab" aria-controls="activites" aria-selected="false">Activites</button>
  </li>  
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab" aria-controls="document" aria-selected="false">Document</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-4">
        <div class="box" style="border-top: 2px solid; position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body">
            <div class="row">
              <p style="vertical-align: middle; font-size: 18px;margin-left: 15px;">Key Fields</p>
              <table class="no-border" style="width: 100%;table-layout: fixed;">
                <tbody>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">First Name</td>
                    <td>{{ $lead_details->firstname }}</td>
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Last Name</td>
                    <td>{{ $lead_details->lastname }}</td>
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Company</td>
                    <td>{{ $lead_details->company }}</td>
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Lead Source</td>
                    <td>{{ App\Models\Lead_source::find($lead_details->leadsource)->leadsource }}
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Website</td>
                    <td> {{ $lead_details->site }}</td>
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Assigned To</td>
                    <td>{{ App\Models\User::find($lead_details->assign)->name }}
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Lead Status</td>
                    <td>
                      <select class="form-control" onchange="leadStatusChange()" id="status" style="width: 70%;border: navajowhite;">
                        <option value="">Select A Status</option>
                        @foreach($lead_statuss as $lead_status)
                        <option @if($lead_details->leadstatus==$lead_status->id){{ "selected" }}@endif value="{{ $lead_status->id }}">{{ $lead_status->leadstatus }}</option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>    
        </div> 
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body">
            <div class="row">
              <table class="no-border" style="width: 100%;table-layout: fixed;">
                <tbody>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Documents</td>
                    <td style="padding-right: 10px;">
                      <button type="button" class="btn btn-primary btn-sm" style="float: right;" onclick="addLinkModalLead()">Link</button>
                      <button type="button" class="btn btn-secondary btn-sm" style="float: right;" onclick="addFileModalLead()">File</button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 11px;text-align: center;"> 
                      <table class="no-border" style="width: 100%;table-layout: fixed;">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>File Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="file_data_lead">
                          @foreach($leadFiles as $leadFile)
                          <tr>
                            <td>{{ $leadFile->title }}</td>
                            <td>{{ $leadFile->note }}</td>
                            <td>
                              <i href="{{ url('$leadFile->file') }}" target="_blank" class="fa fa-eye" aria-hidden="true" style="cursor: pointer;"></i>
                              <i href="{{ url('$leadFile->file') }}" target="_blank" class="fa fa-download" aria-hidden="true" style="cursor: pointer;"></i>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>    
        </div>     
      </div> 
      <div class="col-lg-8">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body"> 
            <div class="row">
              <div class="col-md-7">
                <h4>Activities</h4>
              </div>
              <div class="col-md-5" style="margin-top: 12px;">
                <button type="button" class="btn btn-primary btn-sm" style="float: right;" onclick="addTaskModalLead()">Task</button>
                <button type="button" class="btn btn-secondary btn-sm" style="float: right;" onclick="addEventModalLead()">Event</button>
              </div>
            </div>
            @foreach($lead_activitys as $lead_activity)
            <div class="row" style="margin-top: 13px;">
              <div class="col-md-1">
                <img src="@if($lead_activity->activitytype =='Task'){{ asset('lead/task.png') }} @else{{ asset('lead/event.png') }}@endif" style="height: 70px; width: 60px;">
              </div>
              <div class="col-md-9" style="margin-left: 0px;">
                <p style="padding: 0px; margin: 0px;">{{ $lead_activity->subject }}</p>
                <p style="padding: 0px; margin: 0px;">{{ $lead_activity->description }}</p>
                <strong>{{ $lead_activity->created_at }} - {{ App\Models\User::find($lead_activity->user)->name }}</strong>
              </div>
              <div class="col-md-2" style="padding-top: 20px;">
                <select class="form-control" onchange="statusChangeTaskEvent()" id="status" style="width: 100%;">
                  <option value="">Status</option>
                  <option value="">Status</option>
                </select>
              </div>
            </div> 
            @endforeach
          </div> 
        </div> 
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body"> 
            <div class="row">
              <h4 style="padding-left: 15px;">Comments</h4>
              <div class="col-md-12" id="requirdalert">
                <textarea id="comment" name="comment" class="form-control" required></textarea>
                <input type="hidden" name="_tokencomment" id="_tokencomment" value="{{ csrf_token() }}">
                <button type="button" class="btn btn-success btn-sm" onclick="commentPostLead('{{ $lead_details->id }}', '{{ Auth::user()->id }}')" style="float: right;">Comment</button>
              </div>
              <h4 style="padding-left: 15px;">Recent Comments</h4>
              <div class="col-md-12" id="comment_showLead">
                @foreach($lead_comments as $lead_comment)
                <div class="row" style="margin-top: 13px;">
                  <div class="col-md-1">
                    <img src="{{ asset('lead/comment.png') }}" style="height: 40px; width: 40px;">
                  </div>
                  <div class="col-md-9" style="margin-left: -22px;">
                    <p style="padding: 0px; margin: 0px;">{{ $lead_comment->content }}</p>
                    <strong>{{ $lead_comment->created_at }}</strong>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div> 
      </div>   
    </div>         
  </div>
  <div class="tab-pane fade" id="detailes" role="tabpanel" aria-labelledby="detailes-tab">
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-12">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body">
            <div class="row">
              <p style="vertical-align: middle; font-size: 18px;margin-left: 15px;">Lead Details</p>
              <div class="col-lg-6">
                <table class="no-border" style="width: 100%;table-layout: fixed;">
                  <tbody>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">First Name</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->firstname }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Last Name</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->lastname }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Company</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->company }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Designation</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->designation }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Lead Source</td>
                      <td style="padding-left: 30px;"> {{ App\Models\Lead_source::find($lead_details->leadsource)->leadsource }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Website</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->site }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Assigned To</td>
                      <td style="padding-left: 30px;">{{ App\Models\User::find($lead_details->assign)->name }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-6">
                <table class="no-border" style="width: 100%;table-layout: fixed;">
                  <tbody>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Email</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->email }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Rating</td>
                      <td style="padding-left: 30px;">{{ App\Models\Lead_rating::find($lead_details->rating)->rating }} </td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Industry</td>
                      <td style="padding-left: 30px;">{{ App\Models\Lead_industry::find($lead_details->industry)->industry }}</td>
                    </tr>
                    <tr style="height: 35px;">
                      <td style="padding-left:18px;">Phone</td>
                      <td style="padding-left: 30px;"> {{ $lead_details->pnumber }} </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>    
        </div>          
      </div>
      <div class="col-lg-12">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body">
            <div class="row">
              <p style="vertical-align: middle; font-size: 18px;margin-left: 15px;"> Address Details</p>
              <table class="no-border" style="width: 100%;table-layout: fixed;">
                <tbody>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Street</td>
                    <td style="padding-left: 30px;">{{ $lead_address->street }}</td>
                  </tr>
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Postal Code</td>
                    <td style="padding-left: 30px;">{{ $lead_address->postal_code }}</td>
                  </tr>                                       
                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Country</td>
                    <td style="padding-left: 30px;">{{ $lead_address->country }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>    
        </div>          
      </div>
      <div class="col-lg-12">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <div class="box-body">
            <div class="row">
              <p style="vertical-align: middle; font-size: 18px;margin-left: 15px;">Description Details</p>
              <table class="no-border" style="width: 100%;table-layout: fixed;">
                <tbody>

                  <tr style="height: 35px;">
                    <td style="padding-left:18px;">Description</td>
                    <td style="padding-left: 30px;">{{ $lead_address->description }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>    
        </div>          
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-12">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
          <button type="button" class="btn btn-primary btn-sm" style="float: right; float: right; margin-top: 5px; margin-bottom: 5px;" onclick="sendEmailModalLead()">Send Email</button>
          <div class="box-body">
            <table id="exampleLead" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>To Email</th>
                  <th>CC</th>
                  <th>Send Date</th>
                </tr>
              </thead>
              <tbody id="mail_view_lead">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
  </div>  
  <div class="tab-pane fade" id="activites" role="tabpanel" aria-labelledby="activites-tab">
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-12">
        <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
         <div class="box-body">
          <table id="exampleLeadActivity" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SL</th>
                <th>Subject</th>
                <th>Activity Type</th>
                <th>Priority</th>
                <th>Assign</th>
                <th>Change Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lead_activitys as $lead_activity)
              <tr>
                <td>{{ $lead_activity->id }}</td>
                <td>{{ $lead_activity->subject }}</td>
                <td>{{ $lead_activity->activitytype }}</td>
                <td>{{ $lead_activity->priority }}</td>
                <td>{{ App\Models\User::find($lead_activity->user)->name }}
                </td>
                <td>View</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 
</div>  
<div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
  <div class="row" style="margin-top: 10px;">
   <div class="col-lg-12">
     <div class="box" style="border-top: 2px solid;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
       <div class="box-body">
        <table id="exampleLeadFile" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>SL</th>
              <th>Title</th>
              <th>Note</th>
              <th>File Type</th>
              <th>User</th>
              <th>Create Date</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            @foreach($leadFiles as $leadFile)
            <tr>
              <td>{{ $leadFile->id }}</td>
              <td>{{ $leadFile->title }}</td>
              <td>{{ $leadFile->note }}</td>
              <td>{{ $leadFile->file_type }}</td>
              <td>{{ App\Models\User::find($leadFile->user_id)->name }}
              </td>
              <td>{{ $leadFile->created_at }}</td>
              <td>View</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>  
</div>


<!-- Modal -->
<div class="modal fade" id="addLinkModalLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="linkinsert">
        <div class="row" id="link_form">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Title<span style="color: red;">*</span></label>
              <input class="form-control" type="text" name="link_title" id="link_title" placeholder="Enter Title" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Note</label>
              <input class="form-control" type="text" name="link_note" id="link_note" placeholder="Enter Note">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Link<span style="color: red;">*</span></label>
              <input class="form-control" type="text" name="link" id="link" placeholder="Enter Link" required>
              <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
          </div>      
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="leadLinkInsert('{{ $lead_details->id }}', '{{ Auth::user()->id }}')" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addFileModalLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="file_form">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Title <span style="color: red;">*</span></label>
              <input class="form-control" type="text" name="file_title" id="file_title" placeholder="Enter Title" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Note</label>
              <input class="form-control" type="text" name="file_note" id="file_note" placeholder="Enter Note">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">File<span style="color: red;">*</span></label>
              <input class="form-control" type="file" name="file" id="file" required>
            </div>
          </div>      
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addTaskModalLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="task_form">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Subject <span style="color: red;">*</span></label>
              <input class="form-control" type="text" name="task_subject" id="task_subject" placeholder="Enter Subject" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Start Time <span style="color: red;">*</span></label>
              <input class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" name="task_start_time" id="task_start_time" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">End Time <span style="color: red;">*</span></label>
              <input class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" name="task_end_time" id="task_end_time" required>
            </div>
          </div>        

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Assign To <span style="color: red;">*</span></label>
              <select class="form-control" name="task_assign" id="task_assign" required>
                <option value="">Select A Assign</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>        

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Status <span style="color: red;">*</span></label>
              <select class="form-control" name="task_status" id="task_status" required>
                <option value="">Select A Status</option>
                @foreach($lead_statuss as $lead_status)
                <option value="{{ $lead_status->id }}">{{ $lead_status->leadstatus }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Priority <span style="color: red;">*</span></label>
              <select class="form-control" name="task_priority" id="task_priority" required>
                <option value="">Select A Priority</option>
                <option value="High">High</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Description </label>
              <textarea class="form-control" name="task_des" id="task_des"></textarea>
              <input type="hidden" name="_tokenTask" id="_tokenTask" value="{{ csrf_token() }}">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="leadTaskCareat('{{ $lead_details->id }}', '{{ Auth::user()->id }}')" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addEventModalLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="event_form">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Subject <span style="color: red;">*</span></label>
              <input class="form-control error" type="text" name="event_subject" id="event_subject" placeholder="Enter Subject" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Start Time</label>
              <input class="form-control error" type="date" name="event_start_time" id="event_start_time" value="<?php echo date("Y-m-d"); ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">End Time</label>
              <input class="form-control error" type="date" name="event_end_time" id="event_end_time" value="<?php echo date("Y-m-d"); ?>">
            </div>
          </div>        

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Assign To <span style="color: red;">*</span></label>
              <select class="form-control" name="event_assign" id="event_assign" required>
                <option value="">Select A Assign</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>        

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Status <span style="color: red;">*</span></label>
              <select class="form-control" name="event_status" id="event_status" required>
                <option value="">Select A Status</option>
                @foreach($lead_statuss as $lead_status)
                <option value="{{ $lead_status->id }}">{{ $lead_status->leadstatus }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Priority <span style="color: red;">*</span></label>
              <select class="form-control" name="event_priority" id="event_priority" required>
                <option value="">Select A Priority</option>
                <option value="High">High</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Description </label>
              <textarea class="form-control" name="event_des" id="event_des"></textarea>
              <input type="hidden" name="_tokenEvent" id="_tokenEvent" value="{{ csrf_token() }}">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="leadEventCareat('{{ $lead_details->id }}', '{{ Auth::user()->id }}')" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="sendEmailModalLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function addLinkModalLead(){
   $('#addLinkModalLead').modal('show');
 }  
 function addFileModalLead(){
   $('#addFileModalLead').modal('show');
 } 
 function addTaskModalLead(){
   $('#addTaskModalLead').modal('show');
 }  
 function addEventModalLead(){
   $('#addEventModalLead').modal('show');
 } 
 function sendEmailModalLead(){
   $('#sendEmailModalLead').modal('show');
 }

 function leadLinkInsert(leadid, user){
  event.preventDefault();
  var fail = false;
  var fail_log = '';
  $('#linkinsert').find( 'select, textarea, input' ).removeClass('error_msg');
  $('#linkinsert').find( 'select, textarea, input' ).each(function(){
    if($( this ).prop( 'required' )){
      if (!$( this ).val()) {
        fail = true;
        name = $(this).attr('id');
        fail_log += name + " is required \n";
        $('#'+name).addClass('error_msg');
        console.log(fail_log);
      }
    }
  });
  if (!fail ) {
    var link_title = $('#link_title').val();
    var link_note = $('#link_note').val();
    var link = $('#link').val();
    var _token =$('#_token').val();
    $.ajax({
      url:"link/insert",
      type:'POST',
      data:{
        leadid:leadid,
        user:user,
        link_title:link_title,
        link_note:link_note,
        link:link,
        _token:_token
      },
      success:function(data){
        viewLeadButton(leadid);
        $('#addLinkModalLead').modal('hide');
      }
    });
  }
}

function commentPostLead(leadid, user){
  event.preventDefault();
  var fail = false;
  var fail_log = '';
  $('#requirdalert').find( 'select, textarea, input' ).removeClass('error_msg');
  $('#requirdalert').find( 'select, textarea, input' ).each(function(){
    if($( this ).prop( 'required' )){
      if (!$( this ).val()) {
        fail = true;
        name = $(this).attr('id');
        fail_log += name + " is required \n";
        $('#'+name).addClass('error_msg');
        console.log(fail_log);
      }
    }
  });
  if (!fail ) {
    var _tokencomment = $('#_tokencomment').val();
    var comment = $('#comment').val();
    $.ajax({
      url:"comment/insert",
      type:'POST',
      data:{
        leadid:leadid,
        user:user,
        comment:comment,
        _token:_tokencomment
      },
      success:function(data){
        viewLeadButton(leadid);
      }
    });
  }
}
function leadEventCareat(leadid, user){
 var event_subject = $('#event_subject').val();
 var event_start_time = $('#event_start_time').val();
 var event_end_time = $('#event_end_time').val();
 var event_assign = $('#event_assign').val();
 var event_status = $('#event_status').val();
 var event_priority = $('#event_priority').val();
 var event_des = $('#event_des').val();
 var _tokenEvent = $('#_tokenEvent').val();
 $.ajax({
  url:"event/insert",
  type:'POST',
  data:{
    leadid:leadid,
    user:user,
    event_subject:event_subject,
    event_start_time:event_start_time,
    event_end_time:event_end_time,
    event_assign:event_assign,
    event_status:event_status,
    event_priority:event_priority,
    event_des:event_des,
    _token:_tokenEvent
  },
  success:function(data){
    viewLeadButton(leadid);
    $('#addEventModalLead').modal('hide');
  }
});
}
function leadTaskCareat(leadid, user){
 var task_subject = $('#task_subject').val();
 var task_start_time = $('#task_start_time').val();
 var task_end_time = $('#task_end_time').val();
 var task_assign = $('#task_assign').val();
 var task_status = $('#task_status').val();
 var task_priority = $('#task_priority').val();
 var task_des = $('#task_des').val();
 var _tokenTask = $('#_tokenTask').val();
 $.ajax({
  url:"task/insert",
  type:'POST',
  data:{
    leadid:leadid,
    user:user,
    task_subject:task_subject,
    task_start_time:task_start_time,
    task_end_time:task_end_time,
    task_assign:task_assign,
    task_status:task_status,
    task_priority:task_priority,
    task_priority:task_priority,
    task_des:task_des,
    _token:_tokenTask
  },
  success:function(data){
    viewLeadButton(leadid);
    $('#addTaskModalLead').modal('hide');
  }
});
}

</script>