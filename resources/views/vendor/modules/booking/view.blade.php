@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Booking</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="form-title mb-3">Booking Info</h3>
                <ul class="booking-detial_info">
                    <li><label class="booking-info-label">Name</label><p>{{$b->name}}</p></li>
                    <li><label class="booking-info-label">Mobile</label><p>{{$b->mobile}}</p></li>
                    <li><label class="booking-info-label">Email</label><p>{{$b->email}}</p></li>
                    <li><label class="booking-info-label">Date</label><p>{{$b->date}}</p></li>
                    <li><label class="booking-info-label">Time</label><p>{{$b->time_slot}}</p></li>
                    <li><label class="booking-info-label">Year</label><p>{{$b_garage->year}}</p></li>
                    <li><label class="booking-info-label">Make</label><p>{{$b_garage->make}}</p></li>
                    <li><label class="booking-info-label">Model</label><p>{{$b_garage->model}}</p></li>
                    <li><label class="booking-info-label">Trim</label><p>{{$b_garage->trim}}</p></li>
                    <li><label class="booking-info-label">Mileage</label><p>{{$b_garage->mileage}}</p></li>
                    
                    <li><label class="pro-label">Status</label><div class="switch-button switch-button-success switch-button-lg book-checkbox">
                                        <input type="checkbox" class="custom-control-input " name="status" id="status" {{$b->status==1 ? 'checked' : ''}} >
                                       <span><label for="status"></label></span>
                                     </div></li>
                </ul>
            </div>
            <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <h3 class="form-title mb-3">Services</h3>
                           <table class="table dash-table">
                            <tr>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Price</th>
                          </tr>
                          @foreach($b_service as $key=>$service)
                          <tr>
                              <td>{{$service->name}}</td>
                              <td>{{$service->category_name}}</td>
                              <td>{{$service->price}}</td>
                          </tr>
                          @endforeach
                          </table>  
                        </div>
                        <div class="form-group show-form-grp">
                            <h3 class="form-title mb-3">Final Price</h3>
                           <table class="table dash-table">
                            <tr><td><b>Payment Method</b></td><td>{{$b->payment}}</td></tr>
                             @if($b->coupon !='')
                            <tr><td><b>Price</b></td><td>{{$b->price}}</td></tr>
                            <tr><td><b>Coupon</b></td><td>{{$b->coupon}}</td></tr>
                            <tr><td><b>Discount</b></td><td>{{$b->coupon_discount}}</td></tr>
                            <tr><td><b>Grand Price</b></td><td>{{$b->after_coupon}}</td></tr>
                          @else
                          <tr><td><b>Grand Price</b></td><td>{{$b->price}}</td></tr>
                          @endif
                          
                          </table>  
                        </div>
                    </div>


                   
                          
                    
                    <div class="col-lg-12">
                    <div class="btn-wrap mt-4">
                        <a href="{{route('vendor.booking')}}" class="main-btn">Back</a>
                    </div>
                </div>
        </div> 
        </div>
    </div>  
</div>
@endsection

@section('scripts')
<script type="text/javascript">
     $('#status').change(function () {
        val = $(this).is(':checked') ? 1 : 0;
        checkbox_change(val);
  });
function checkbox_change(val){
     $.ajax({
                url : "{{route('vendor.booking.status',$b->id)}}",
                type: 'POST',  
                data:{status : val},     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {                         
                },
                success: function (data) {                                   
                  if(data.success==true){
                    toastr.success(data.message);
                   }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
 }    
</script>
@endsection