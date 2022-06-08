@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Users</h3>
                 
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Users</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table cursor-row" id="dataTable">
                              <thead>
                                <tr>
                                  <th>S No.</th>  
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Mobile</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($user as $key=>$u)
                                <tr>
                                  <td>{{$key+1}}</td>  
                                  <td><a href="{{route('admin.user.view',$u->id)}}" class="target_window">{{$u->name}}</a></td>
                                  <td>{{$u->email}}</td>
                                  <td>{{$u->mobile}}</td> 
                                </tr>                  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>
@stop        



@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
            
                var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],                      
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ])
                , true) !!});
       });


$('#dataTable').on('click', 'tbody td:not(.checkbox_in)', function(){
       window.location = $(this).closest('tr').find('.target_window').attr('href');
    });       
</script>
@stop