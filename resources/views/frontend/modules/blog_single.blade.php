@extends('frontend.layouts.layout')
@section('meta')
<title>{{ $blog->meta_title!=null ? $blog->meta_title : 'Oylerz'}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $blog->meta_title!=null ? $blog->meta_title : 'Oylerz' }}">
    <meta name="keywords" content="{{ $blog->meta_keywords!=null ? $blog->meta_keywords : 'Oylerz' }}">
  <meta name="description" content="{{ $blog->meta_description!=null ? $blog->meta_description : 'Oylerz'}}">
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
            
         </div>
			<!-- <div class="row">
					
				
					<div class="hx-blog-item">
						<div class="hx-blog-img">
							@if($blog->image!=null)
							<img src="{{url($blog->image)}}" alt="">
							@endif
						</div>
						<div class="hx-blog-content">
							<h3>{{$blog->title}}</h3>
							<div class="hx-blog-description">{!! $blog->description !!}</div>
							<ul class="post-meta">
								<li> {{ $blog->created_at->format('d/m/Y')}}</li>
							</ul>
						</div>
					</div>

			        
				</div> -->
				<div class="row">
					
				<div class="col-lg-12">
					<div class="blog-single-block">	
					   <div class="blog-single-card">					
						<figure class="blog-dsingle-img"><img src="{{$blog->image!=null ? url($blog->image) : url('frontend/images/blog-img1.png')}}" alt=""></figure>
						<figcaption class="blog-single-detail">
							<div class="sgl-head d-f j-c-s-b a-i-c">
							<h3 class="blg-title">{{$blog->title}}</h3>
							<ul class="blog-sgl-info">
								<li><a href="javascript:void(0);" class="sgl-info"><span class="icon"><i class="fas fa-user"></i></span> {{admin()->name}}</a></li>
	                         <li><a href="javascript:void(0);" class="sgl-info"><span class="icon"><i class="fas fa-calendar-alt"></i></span> {{ $blog->created_at->format('d/m/Y')}}</a></li>
							</ul>
					   </div>
						<div class="blg-des">
							<p>{!! $blog->description !!}</p>
						</div>
						</figcaption>
					  </div>
					</div>
					
					<section class="comment-list mt-5">
			          <!-- First Comment -->
			          @foreach($blog_comment as $b_comment)
			          <article class="row">
			            <div class="col-md-2 col-sm-2 hidden-xs">
			              <figure class="thumbnail">
			                <img class="img-responsive" src="{{url('frontend/images/account.png')}}" />
			                <figcaption class="text-center">{{$b_comment->fname}}</figcaption>
			              </figure>
			            </div>
			            <div class="col-md-10 col-sm-10">
			              <div class="panel panel-default arrow left">
			                <div class="panel-body">
			                  <header class="text-left">
			                    <div class="comment-user">{{$b_comment->fname}}</div>
			                    <time class="comment-date" datetime="{{ $b_comment->created_at->format('d/m/Y')}}"><i class="fa fa-clock-o"></i> {{ $b_comment->created_at->format('d/m/Y')}}</time>
			                  </header>
			                  <div class="comment-post">
			                    <p>
			                     {{$b_comment->comment}}
			                    </p>
			                  </div>
			                </div>
			              </div>
			            </div>
			          </article>
			          @endforeach
			          <!-- Second Comment Reply -->
			          <!-- <article class="row">
			            <div class="col-md-10 col-sm-10">
			              <div class="panel panel-default arrow right">
			                <div class="panel-body">
			                  <header class="text-right">
			                    <div class="comment-user">Sherleen</div>
			                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
			                  </header>
			                  <div class="comment-post">
			                    <p>
			                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
			                    </p>
			                  </div>
			                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
			                </div>
			              </div>
			            </div>
			            <div class="col-md-2 col-sm-2 hidden-xs">
			              <figure class="thumbnail">
			                <img class="img-responsive" src="{{url('frontend/images/profile_img.jpg')}}" />
			                <figcaption class="text-center">Sherleen</figcaption>
			              </figure>
			            </div>
			          </article> -->
			          
			         
			        </section>
			        <div class="blg-cards oylerz-card">
			        	<h3 class="card-title">Leave a comment</h3>
			        	<form id="blog-comment" method="POST" action="{{route('blog-comment',$blog->id)}}">
			        		@csrf
			        	<div class="row">
			        		<div class="col-lg-6">
			        			<div class="form-group">
			        				<label class="form-label">Full Name </label>
			        				<input type="text" name="fname" class="form-control">
			        			</div>
			        		</div>
			        		<div class="col-lg-6">
			        			<div class="form-group">
			        				<label class="form-label">Email</label>
			        				<input type="text" name="email" class="form-control">
			        			</div>
			        		</div>			        		
			        		<div class="col-lg-12">
			        			<div class="form-group">
			        				<label class="form-label">Comment</label>
			        				<textarea class="form-control" name="comment"></textarea>
			        			</div>
			        		</div>
			        		<div class="col-lg-12">
			        			<div class="btn-wrap text-center">
			        				<button type="submit" class="oylerz-btn primary-btn" id="schedule_modal">Submit <span class="btn-icon"><i class="fas fa-arrow-right"></i></span></button>
			        			</div>
			        		</div>
			        	</div>
			        </form>
			        </div>
				</div>
				
				
			</div>
				
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
	   jQuery("form[id='blog-comment']").validate({
    rules: {
      
      'fname':{
        required: true, 
         nowhitespace: true,
         maxlength:50 
      },
      'email':{
         required: true, 
         nowhitespace: true,
         maxlength:50,
         customemail:true
      },
      'comment':{
         required: true, 
         nowhitespace: true,
      }
    }
   });
</script>

@endsection