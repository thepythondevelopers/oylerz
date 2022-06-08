@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">User Profile </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">User Profile</h3>
                        </div>
                    <div class="csm-body">
                         <div class="profile-card">
                            <figure class="profile_bg" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">                    
                            </figure>
                            <span class="profile_img"><img src="{{$user->avatar !=null ? asset($user->avatar) : asset('backend/images/user.png')}}"></span>
                            <div class="profile_information">
                                <h3 class="pro_name">{{$user->name}}</h3>
                                <ul class="profile-info">
                                    <li><label class="pro-label">Mobile</label><p>{{$user->mobile}}</p></li>
                                    <li><label class="pro-label">Email Id</label><p>{{$user->email}}</p></li>
                                    <li><label class="pro-label">Service Address</label><p>{{$user->service_address}}</p></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                           <!--  <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Full Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile<span class="astrick">*</span></label>
                                    <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Email Id<span class="astrick">*</span></label>
                                    <input type="text" name="email" value="{{$user->email}}" class="form-control" autocomplete="off" disabled>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Service Address<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="service_address" autocomplete="off" disabled>{{$user->service_address}}</textarea>
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f mt-2">
                                    <a href="{{route('admin.users')}}" class="main-btn">Back</a>
                                    
                                </div>
                            </div>
                        </div>
                         
                    </div>
                  </div>  
            </div>
        </div>
@stop        

