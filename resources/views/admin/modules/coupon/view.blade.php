@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Coupon</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title mb-3">Coupon Info</h3>
                <ul class="booking-detial_info">
                    <li><label class="booking-info-label">Title</label><p>{{$coupon->title}}</p></li>
                    <li><label class="booking-info-label">Discount</label>{{$coupon->discount}}</li>
                    <li><label class="booking-info-label">Description</label>{!! $coupon->description !!}</li>
                    <li><label class="booking-info-label">Type</label>{{ $coupon->type==0 ? 'Fixed' : 'Percentage' }}</li>
                  
                </ul>
            </div>
          
                    
                    
                    
                    <div class="col-lg-12">
                    <div class="btn-wrap mt-4">
                        <a href="{{route('admin.coupon')}}" class="main-btn">Back</a>
                    </div>
                </div>
        </div> 
        </div>
    </div>  
</div>
@endsection