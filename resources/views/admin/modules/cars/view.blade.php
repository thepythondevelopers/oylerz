@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Car</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="form-title mb-3">Car Info</h3>
                <ul class="booking-detial_info">
                    <li><label class="booking-info-label">Year</label><p>{{$car->year}}</p></li>
                    <li><label class="booking-info-label">Make</label><p>{{$car->make}}</p></li>
                    <li><label class="booking-info-label">Model</label><p>{{$car->model}}</p></li>
                </ul>
            </div>
          
                    
                    
                    
                    <div class="col-lg-12">
                    <div class="btn-wrap mt-4">
                        <a href="{{route('admin.car')}}" class="main-btn">Back</a>
                    </div>
                </div>
        </div> 
        </div>
    </div>  
</div>
@endsection