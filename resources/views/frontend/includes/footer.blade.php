<footer class="main-footer">
  @php 
                      $footer = \App\Models\CmsPage::where('slug','footer')->first();
                      @endphp
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-xl-3 col-md-6">
              <div class="ftr-info">
                <a href="{{route('dashboard')}}" class="ftr-logo mb-3"><img src="{{asset('frontend/images/logo.png')}}"></a>
                {!! $footer->description!!}
              </div>
            </div>
            <div class="col-xl-7 cstm-order-2">
              <div class="row">
                <div class="col-lg-3 col-md-3">
                  <div class="ftr-link-wrap">
                    <h3 class="ftr-heading">{{$footer->description1}}</h3>
                    <ul class="ftr-link-list">
                      <li><a href="{{route('dashboard')}}">Home</a></li>
                      <li><a href="{{route('about')}}">About Us</a></li>
                      <li><a href="{{route('blog')}}">Blog</a></li>
                      <li><a href="{{route('contact')}}">Contact</a></li>
                      <li><a href="{{route('store')}}">Store near you</a></li>
                      <li><a href="{{route('coupon')}}">Coupon</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5">
                  <div class="ftr-link-wrap">
                    <h3 class="ftr-heading">{{$footer->description2}}</h3>
                    <ul class="ftr-link-list">
                      @php 
                      $blog = \App\Models\Blog::orderBy('created_at','desc')->limit(4)->get();
                      @endphp
                      @foreach($blog as $b)
                      <li><a href="{{route('blog-single',$b->slug)}}">{{$b->title}}</a></li>
                      @endforeach
                    </ul>
                    <div class="btm-img mt-3">
                      <img src="{{asset('frontend/images/ftr-feature-img.png')}}">
                    </div>                     
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="ftr-link-wrap">
                    {!! $footer->description3!!}
                    <!-- <h3 class="ftr-heading">Contact Us</h3>
                    <ul class="ftr-link-list">
                      <li><a href="javascript:void(0);">Phone : 123 456 7890</a></li>
                      <li><a href="javascript:void(0);">Email : .info@oylerzgmail.com</a></li>
                    </ul>
                    <ul class="social-list mt-3">
                      <li><a href="javascript:void(0);"><i class="fab fa-facebook-f">&nbsp;</i></a></li>
                      <li><a href="javascript:void(0);"><i class="fab fa-instagram">&nbsp;</i></a></li>
                      <li><a href="javascript:void(0);"><i class="fab fa-youtube">&nbsp;</i></a></li>
                      <li><a href="javascript:void(0);"><i class="fab fa-google-plus-g">&nbsp;</i></a></li>
                    </ul> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-5 col-md-6">
              <div class="ftr-link-wrap">
                    <h3 class="ftr-heading">{{$footer->description4}}</h3>
                    <form id="blog_subscribe" data-action="{{route('blog.subscribe')}}">
                    <div class="subscribe-fields">
                      <input type="text" name="email" autocomplete="off" placeholder="Enter Email Address" class="subscribe-input">
                      <button type="submit" class="oylerz-btn primary-btn subscribe-btn">Subscribe</button>
                    </div>
                  </form>
                  <span class="blog_subscribe_message"></span>
            </div>
          </div>
        </div>
      </div>
        <div class="ftr-bottom-bar">
          <div class="container">
            <div class="d-f j-c-s-b">
              <p>{{$footer->description5}}</p>
              
            </div>
          </div>
        </div>
      </footer>

