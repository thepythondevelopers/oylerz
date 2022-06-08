@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Bookings</h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Booking</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table cursor-row" id="dataTable">
                              <thead>
                                <tr>
                                  <th>Bookings#</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Number</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Total ($)</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($booking as $key=>$book)
                                <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$book->name}}</td>
                                  <td>{{$book->email}}</td>
                                  <td>{{$book->mobile}}</td>
                                  <td><a href="{{route('admin.booking.view',$book->id)}}" class="target_window">{{$book->date}}</a></td>
                                  <td>{{$book->time_slot}}</td>
                                  <td>{{$book->coupon!='' ? $book->after_coupon : $book->price}}</td>
                                  <td><span class="badge {{$book->status==1 ? 'badge-success' : 'badge-danger'}}">{{$book->status==1 ? 'Completed' : 'Booked'}}</span></td>
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
@endsection