            <div class="card">
              <div class="card-header">{{ __('Dashboard') }}<button type="button" class="btn btn-primary btn-sm" id="exampleModalLongShow" style="float: right;padding-top: 0px;padding-bottom: 0px;">Lead Create</button></div>
              <div class="card-body">
               <table class="table table-hover" id="leadAllData">
                <thead>
                  <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Email</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Assign</th>
                    <th scope="col">Lead Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach($lead_details as $lead_detail)
                <tbody>
                  <tr>
                    <th>{{ $lead_detail->id }}</th>
                    <td>{{ $lead_detail->email }}</td>
                    <td>{{ $lead_detail->company }}</td>
                     <td>{{ $lead_detail->assign }}</td>
                    <td>{{ $lead_detail->leadstatus }}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-sm" style="float: right;" onclick="viewLeadButton('{{ $lead_detail->id }}')"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-primary btn-sm" style="float: right;" onclick="editLeadData('{{ $lead_detail->id }}');"><i class="fa fa-edit"></i></button>
                    </td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Create Lead</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datainsert">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">First Name </label>
                        <input class="form-control error" type="text" name="first_name" id="first_name" placeholder="Enter First Name">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Last Name <span style="color:red;">*</span></label>
                        <input class="form-control error" type="text" name="last_name" placeholder="Enter Last Name" id="last_name" required >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Company </label>
                        <input class="form-control error" type="text" placeholder="Enter Company" name="company" id="company"  >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Mobile Number </label>
                        <input class="form-control error" type="text" placeholder="Enter Mobile Number" name="number" id="number"  >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Designation </label>
                        <input class="form-control error" type="text" placeholder="Enter Designation" name="designation" id="designation" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Lead Source</label>
                        <select class="form-control" id="lead_source" name="lead_source">
                          <option value="">Select A Source</option>
                          @foreach($lead_sources as $lead_source)
                          <option value="{{ $lead_source->id }}">{{ $lead_source->leadsource }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Primary Email <span style="color:red;">*</span></label>
                        <input class="form-control error" type="email" placeholder="Enter Primary Email" name="pri_email" id="pri_email" required >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Industry </label>
                        <select class="form-control error" id="industry" name="industry">
                          <option value="">Select A Industry</option>
                          @foreach($lead_industryes as $lead_industry)
                          <option value="{{ $lead_industry->id }}">{{ $lead_industry->industry }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Web Site </label>
                        <input class="form-control error" type="text" placeholder="Enter Web Site" name="site" id="site" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Lead Status</label>
                        <select class="form-control" id="lead_status" name="lead_status">
                          <option value="">Select A Status</option>
                          @foreach($lead_statuss as $lead_status)
                          <option value="{{ $lead_status->id }}">{{ $lead_status->leadstatus }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Rating</label>
                        <select class="form-control" id="rating" name="rating">
                          <option value="">Select A Rating</option>
                          @foreach($lead_ratings as $lead_rating)
                          <option value="{{ $lead_rating->id }}">{{ $lead_rating->rating }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Assign To <span style="color:red;">*</span></label>
                        <select class="form-control error" id="assign" name="assign" required>
                          <option value="">Select Assign</option>
                          @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <p style="padding-top: 10px;font-size: 18px;">Address</p>
                    <hr>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Street </label>
                        <input class="form-control error" type="text" placeholder="Enter Street" name="street" id="street" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">PO Box </label>
                        <input class="form-control error" type="text" placeholder="Enter PO Box" name="pio_box" id="pio_box" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Postal Code </label>
                        <input class="form-control error" type="text" placeholder="Enter Postal Code" name="postal_code" id="postal_code" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">City </label>
                        <input class="form-control error" type="text" placeholder="Enter City" name="city" id="city" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Country </label>
                        <input class="form-control error" type="text" placeholder="Enter Country" name="country" id="country" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">State </label>
                        <input class="form-control error" type="text" placeholder="Enter State" name="state" id="state" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Description </label>
                        <textarea class="form-control error" name="description" id="description" ></textarea>
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="modalClosed" data-dismiss="modal">Close</button>
                  <button type="button" onclick="insertLead()" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade bd-example-modal-lg" id="LeadUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Lead Update</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="inputFild">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" onclick="leadUpdateDataTo()" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $('#exampleModalLongShow').on('click' , function(e){
             e.preventDefault();
             $('#exampleModalLong').modal('show');
           });
            $('#modalClosed').on('click', function () {
              $('#exampleModalLong').modal('hide');
            });
            function editLeadData(id){
              $.ajax({
                url:"lead/update/from",
                type:'get',
                data:{
                 id:id,
               },
               dataType: "json",
               success:function(data){
                $('#inputFild').html(data.html)
                $('#LeadUpdateModal').modal('show');
              }
            });

            }
            function leadUpdateDataTo(){
              event.preventDefault();
              var fail = false;
              var fail_log = '';
              $('#dataupdate').find( 'select, textarea, input' ).removeClass('error_msg');
              $('#dataupdate').find( 'select, textarea, input' ).each(function(){
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
                var _token =$('#_tokeni').val();
                var first_name = $('#first_namei').val();
                var last_name = $('#last_namei').val();
                var company = $('#companyi').val();
                var number = $('#numberi').val();
                var designation = $('#designationi').val();
                var lead_source = $('#lead_sourcei').val();
                var pri_email = $('#pri_emaili').val();
                var industry = $('#industryi').val();
                var site = $('#sitei').val();
                var lead_status = $('#lead_statusi').val();
                var rating = $('#ratingi').val();
                var assign = $('#assigni').val();
                var street = $('#streeti').val();
                var pio_box = $('#pio_boxi').val();
                var postal_code = $('#postal_codei').val();
                var city = $('#cityi').val();
                var country = $('#countryi').val();
                var state = $('#statei').val();
                var description = $('#descriptioni').val();
                var lead_id = $('#lead_id').val();
                $.ajax({
                  url:"lead/update",
                  type:'POST',
                  data:{
                    _token:_token,
                    first_name:first_name,
                    last_name:last_name,
                    company:company,
                    number:number,
                    designation:designation,
                    lead_source:lead_source,
                    pri_email:pri_email,
                    industry:industry,
                    site:site,
                    lead_status:lead_status,
                    rating:rating,
                    assign:assign,
                    street:street,
                    pio_box:pio_box,
                    postal_code:postal_code,
                    city:city,
                    country:country,
                    state:state,
                    lead_id:lead_id,
                    description:description
                  },
                  success:function(data){
                    $('#LeadUpdateModal').modal('hide');
                    leadShowAll();
                    $("#leadAllData").load(" #leadAllData > *");
                  }
              });
              }

            }
            function insertLead(){
              event.preventDefault();
              var fail = false;
              var fail_log = '';
              $('#datainsert').find( 'select, textarea, input' ).removeClass('error_msg');
              $('#datainsert').find( 'select, textarea, input' ).each(function(){
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
                var _token =$('#_token').val();
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var company = $('#company').val();
                var number = $('#number').val();
                var designation = $('#designation').val();
                var lead_source = $('#lead_source').val();
                var pri_email = $('#pri_email').val();
                var industry = $('#industry').val();
                var site = $('#site').val();
                var lead_status = $('#lead_status').val();
                var rating = $('#rating').val();
                var assign = $('#assign').val();
                var street = $('#street').val();
                var pio_box = $('#pio_box').val();
                var postal_code = $('#postal_code').val();
                var city = $('#city').val();
                var country = $('#country').val();
                var state = $('#state').val();
                var description = $('#description').val();
                $.ajax({
                  url:"lead/insert",
                  type:'POST',
                  data:{
                    _token:_token,
                    first_name:first_name,
                    last_name:last_name,
                    company:company,
                    number:number,
                    designation:designation,
                    lead_source:lead_source,
                    pri_email:pri_email,
                    industry:industry,
                    site:site,
                    lead_status:lead_status,
                    rating:rating,
                    assign:assign,
                    street:street,
                    pio_box:pio_box,
                    postal_code:postal_code,
                    city:city,
                    country:country,
                    state:state,
                    description:description
                  },
                  success:function(data){
                    $('#exampleModalLong').modal('hide');
                    leadShowAll();
                    // $("#leadAllData").load(" #leadAllData > *");
                  }
                });
              }

            }
            function viewLeadButton(id){
              $.ajax({
                url:"view/lead",
                type:'GET',
                data:{id:id},
                success:function(data){
                  console.log(data);
                  $('#allDataShow').html(data);
                }
              });
            }
            $(document).ready(function(){
              $('#allDataShow').dataTable( {
                "pageLength": 50
              } );
            });
          </script>