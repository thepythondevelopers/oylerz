@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Blog Subscribe</h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Blog Subscribe</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table cursor-row" id="dataTable">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  
                                  <th>Email</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($data as $key=>$d)
                                <tr>
                                  <td>{{$key+1}}</td>
                                  
                                  <td>{{$d->email}}</td>
                                  
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


        



</script>
@endsection