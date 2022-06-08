@extends('frontend.layouts.layout')
@section('meta')
<title>{{ $cms->meta_title!=null ? $cms->meta_title : 'Oylerz'}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $cms->meta_title!=null ? $cms->meta_title : 'Oylerz' }}">
    <meta name="keywords" content="{{ $cms->meta_keywords!=null ? $cms->meta_keywords : 'Oylerz' }}">
  <meta name="description" content="{{ $cms->meta_description!=null ? $cms->meta_description : 'Oylerz'}}">
@endsection
@section('content')
<section class="coupon-sec cl">
   <div class="container">
   <div class="sec-heading text-center max-w-heading mb-5">
      <h2>Coupon</h2>
      <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p> -->
   </div>
   <div class="row">
      @foreach($c as $c)
      <div class="col-lg-6">
         <article class="shadow-sm rounded cp js-filter  js-filter-coupon-type-verify js-filter-coupon-type-codes  js-filter-discount-type-percent" data-brand-flag="all" data-filter-flag="0" data-old-position="1" style="">
            <div class="deal">
               <div class="deal-info benefit-code">
                  <div class="discount">
                     {{$c->discount}} {{$c->type==0 ? 'Fixed' : '%'}}
                  </div>
                  <div class="suffix">
                     OFF
                  </div>
               </div>
               <div class="deal-desc">
                  <div class="type-code">
                     <span> Code</span>
                  </div>
                  <h2 class="title">
                     <a href="javascript:void(0);">
                     {{$c->title}}
                     </a>
                  </h2>
                  <a class="js-change-color btn detail-btn-description" style="color: rgb(153, 153, 153);">
                  <span class="mr-3">{!! $c->discription !!}</span>
                  </a>
                  
                  <div class="get-code">
                     <span>{{$c->code}}</span>
                     <a href="javascript:void(0);">
                     Get Code
                     </a>
                  </div>
               </div>
               
            </div>
      
         </article>
      </div>
@endforeach
      
   </div>
</section>
@endsection