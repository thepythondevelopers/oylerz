@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
    <div class="content-head mb-4 d-f j-c-s-b a-i-c">
        <h3 class="page-title">Services</h3>
    </div>
    <div class="content-body">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Services</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Name<span class="astrick">*</span></label>
                            <!-- <input type="text" name="name" class="form-control"  value="{{$service->name}}" disabled> -->
                            <span class="input-text">{{$service->name}}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Description<span class="astrick">*</span></label>
                            <!-- <textarea class="form-control" disabled>{{$service->description}}</textarea> -->
                            <span class="input-text">{{$service->description}}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="sub-ser-wrap">
                        <h3 class="csm-title mb-3">Sub Services</h3>
                        <ul class="sub-ser-list">
                            @if($sub_service->count() > 0)
                            @foreach($sub_service->get() as $sub_ser)
                            <li><div class="sub-ser-card"><div class="sub-ser-head d-f j-c-s-b a-i-c"><h3>{{$sub_ser->name}}</h3></div> 
                             <div class="sub-ser-description mt-3"><p>{{$sub_ser->description}}</p></div>
                            </div>
                         </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap">
                        <a href="{{route('admin.services')}}" class="main-btn">Back</a>
                    </div>
                </div>

            </div>  
        </div>
    </div>  
</div>
</div>
@stop        





