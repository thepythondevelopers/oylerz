<header class="site-header">        
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <a class="navbar-brand" href="{{route('dashboard')}}"><img src="{{asset('frontend/images/logo.png')}}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link <?= ActiveMenu(['dashboard'],'active') ?>" href="{{route('dashboard')}}" >Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ActiveMenu(['about'],'active') ?>" href="{{route('about')}}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ActiveMenu(['blog'],'active') ?>" href="{{route('blog')}}">Blog </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ActiveMenu(['contact'],'active') ?>" href="{{route('contact')}}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ActiveMenu(['store'],'active') ?>" href="{{route('store')}}">Store near you</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ActiveMenu(['register'],'active') ?>" href="{{route('register')}}">Join Us</a>
                        </li>
                        
                    </ul>

                    <ul class="log-btn-action d-f a-i-c">
                        
                        @if(Auth::check())
                        @if(Auth::user()->role=='admin')
                            <li><a href="{{route('admin.dashboard')}}" class="login-btn" >Dashboard</a></li>
                        @elseif(Auth::user()->role=='vendor')
                            <li><a href="{{route('vendor.dashboard')}}" class="login-btn" >Dashboard</a></li>
                        @elseif(Auth::user()->role=='user')
                            <li><a href="{{route('user.dashboard')}}" class="login-btn" >Dashboard</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                     {{ csrf_field() }}
                            <button type="submit" class="oylerz-btn primary-btn mini-btn call-btn" >Logout</button>
                        </form>
                        </li>
                        @else
                        <li><a href="javascript:void(0);" class="login-btn" data-toggle="modal" data-target="#loginAccount"><span class="nav-icon mr-2"><i class="fas fa-user"></i></span> Log In</a></li>
                        <li><a href="javascript:void(0);" class="oylerz-btn primary-btn mini-btn call-btn" data-toggle="modal" data-target="#createAccount">Register Now</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>