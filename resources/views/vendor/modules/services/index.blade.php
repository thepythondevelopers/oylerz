@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Services</h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Services</h3>
                            <a class="main-btn" href="{{route('vendor.service.add')}}" ><span>Manage Services</span></a>
                        </div>
                        
                        
                    <div class="csm-body">  
                        <div class="alert alert-info" role="alert">
                          Note: Only Services with price will be shown to user.
                        </div>
                        <div class="table-responsive">
                            <table class="table dash-table cursor-row" id="dataTable">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Main Service</th>
                                  <th>Price</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($user_service as $key=>$service)
                                <tr>
                                  <td><a href="{{route('vendor.service.edit',$service->id)}}">{{isset($service->service) ? $service->service->name : ''}}</a></td>
                                  <td>{{$service->parent_service($service->service_id)->name}}</td> 
                                  <td class="target_price">{{$service->price}}</td>
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
                        "language" => __('voyager::datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});
       });
    $('#dataTable').on('click', 'tbody td', function(){
   window.location = $(this).closest('tr').find('td:eq(0) a').attr('href');
});
</script>
@stop