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
        <div class="menu-bar">
            <div class="menu">

                <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link <?= ActiveMenu(['user.dashboard'],'active') ?>">
                        <a href="{{route('user.dashboard')}}">
                            <i class="bx bxs-dashboard icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>


                    <li class="nav-link <?= ActiveMenu(['user.garage','user.garage.edit','user.garage.view'],'active') ?>">
                        <a href="{{route('user.garage')}}">
                            <i class='bx bxs-car icon'></i>
                            <span class="text nav-text">Garage</span>
                        </a>
                    </li>
                    <li class="nav-link <?= ActiveMenu(['user.booking','user.booking.view','user.booking.reschedule'],'active') ?>">
                        <a href="{{route('user.booking')}}">
                            <i class='bx bx-task icon'></i>
                            <span class="text nav-text">Bookings</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['user.profile'],'active') ?>">
                        <a href="{{route('user.profile')}}">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-link <?= ActiveMenu(['dashboard'],'active') ?>">
                        <a href="{{route('dashboard')}}">
                            <i class="bx bxs-dashboard icon"></i>
                            <span class="text nav-text">Back Website</span>
                        </a>
                    </li>
                </ul>
            </div>
            </div>
            
            <div class="bottom-content">
                <li class="nav-link">
                    <form method="POST" action="{{Route('logout')}}">
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