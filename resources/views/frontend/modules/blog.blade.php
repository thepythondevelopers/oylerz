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
<!-- Banner starts here -->
    <section class="main-banner-sec inner-hero-banner" style="background-image: url('{{url('frontend/images/banner-img.png')}}');">
      <span class="banner-bottom-shape"><img src="{{url('frontend/images/banner-shape.png')}}"></span>
      <div class="container">
         <div class="banner-content">
            <h1>Blog</h1>
         </div>
      </div>
    </section>
    <!-- Banner ends here -->
<section class="blog-sec">
	<div class="container">
		<div class="blog-block">
			<div class="sec-heading text-center max-w-heading mb-5">
            <h2>Blog</h2>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p> -->
         </div>
			<div class="row">
					@foreach($blog as $b)
				<div class="col-lg-4 col-md-6 col-12">
					<div class="hx-blog-item">
						<div class="hx-blog-img">
							
							<img src="{{$b->image!=null ? url($b->image) : url('frontend/images/blog-img1.png')}}" alt="">
							
						</div>
						<div class="hx-blog-content">
							<h3><a href="{{route('blog-single',$b->slug)}}">{{$b->title}}</a></h3>
							<div class="hx-blog-description">{!! $b->description !!}</div>
							<ul class="post-meta d-f j-c-s-b">
								<li><strong>Posted By:</strong> {{admin()->name}}</li><li> {{ $b->created_at->format('d/m/Y')}}</li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection