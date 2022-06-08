<nav class="sidebar" id="sideNav">
        <header>
            <div class="sidebar-head">
                <div class="dash-logo">               
                    <img src="{{asset('backend/images/logo.png')}}" alt=""> 
                    <img class="mini-logo" src="{{asset('backend/images/mini-logo.png')}}">  
                </div>
            </div>

            <a href="javascript:void(0);" class="toggle"><i class='bx bx-chevron-right'></i></a>
        </header>
        <div class="menu-bar scrollbar scrollbar-black">
            <div class="menu force-overflow">

                <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link <?= ActiveMenu(['admin.dashboard'],'active') ?>">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="bx bxs-dashboard icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.booking','admin.booking.view'],'active') ?>">
                        <a href="{{route('admin.booking')}}">
                            <i class='bx bx-task icon'></i>
                            <span class="text nav-text">Bookings</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.profiles','admin.profile.edit','admin.profile.view'],'active') ?>">
                        <a href="{{route('admin.profiles')}}">
                            <i class='bx bxs-user-pin icon'></i>
                            <span class="text nav-text">Vendors</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.users','admin.user.view'],'active') ?>">
                        <a href="{{route('admin.users')}}">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.services','admin.services.edit','admin.services.view'],'active') ?>">
                        <a href="{{route('admin.services')}}">
                            <i class='bx bxs-car-mechanic icon'></i>
                            <span class="text nav-text">Services</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.profile'],'active') ?>">
                        <a href="{{route('admin.profile')}}">
                            <i class='bx bxs-id-card icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.setting'],'active') ?>">
                        <a href="{{route('admin.setting')}}">
                            <i class='bx bxs-wrench icon'></i>
                            <span class="text nav-text">Setting</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.cms','admin.cms.edit'],'active') ?>">
                        <a href="{{route('admin.cms')}}">
                            <i class='bx bx-laptop icon'></i>
                            <span class="text nav-text">Cms</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.blog'],'active') ?>">
                        <a href="{{route('admin.blog')}}">
                        <i class='bx bx-message-edit icon'></i>
                            <span class="text nav-text">Blog</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.blog.subscribe'],'active') ?>">
                        <a href="{{route('admin.blog.subscribe')}}">
                        <i class='bx bx-message-edit icon'></i>
                            <span class="text nav-text">Blog Subscribe</span>
                        </a>
                    </li>

                     <li class="nav-link <?= ActiveMenu(['admin.coupon'],'active') ?>">
                        <a href="{{route('admin.coupon')}}">
                        <i class='bx bxs-coupon icon' ></i>
                            <span class="text nav-text">Coupon</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['admin.car','admin.car.add','admin.car.edit','admin.car.view'],'active') ?>">
                        <a href="{{route('admin.car')}}">
                        <i class='bx bxs-coupon icon' ></i>
                            <span class="text nav-text">Car</span>
                        </a>
                    </li>

                    
                    
                </ul>
            </div>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <form method="POST" action="{{Route('admin.logout')}}">
                        {{ csrf_field() }}
                    <button type="submit">    
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </button>
                </form>
                </li>
                
            </div>
        </div>

    </nav>