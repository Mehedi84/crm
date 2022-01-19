            <div class="card">
              <div class="card-header">{{ __('Dashboard') }}<span style="float: right;">All Client</span></div>

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
                      <button type="button" class="btn btn-info btn-sm" style="float: right;" onclick="viewClientButton('{{ $lead_detail->id }}')"><i class="fa fa-eye"></i></button>
                    </td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
          <!-- Modal -->
         
          <script type="text/javascript">
            function viewClientButton(id){
              $.ajax({
                url:"client/view",
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