@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Blog</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="form-title mb-3">Blog Info</h3>
                <ul class="booking-detial_info">
                    <li><label class="booking-info-label">Title</label><p>{{$blog->name}}</p></li>
                    <li><label class="booking-info-label">Image</label><figure class="uploaded_img">
                        @if($blog->image!=null)<img src="{{$blog->image!=null ? url($blog->image) : ''}}"/>
                        @endif
                    </figure></li>
                    <li><label class="booking-info-label">Description</label>{!! $blog->description !!}</li>

                             <li><label class="booking-info-label">Meta Title</label>{{ $blog->meta_title }}</li>
                                      <li><label class="booking-info-label">Meta Keywords</label>{{ $blog->meta_keywords }}</li>
                                               <li><label class="booking-info-label">Meta Description</label>{{ $blog->meta_description }}</li>

                  
                </ul>
            </div>
          
                    
                    
                    
                    <div class="col-lg-12">
                    <div class="btn-wrap mt-4">
                        <a href="{{route('admin.blog')}}" class="main-btn">Back</a>
                    </div>
                </div>
        </div> 
        </div>
    </div>  
</div>
@endsection