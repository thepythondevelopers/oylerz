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
                    <li class="nav-link <?= ActiveMenu(['vendor.dashboard'],'active') ?>">
                        <a href="{{route('vendor.dashboard')}}">
                            <i class="bx bxs-dashboard icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['vendor.booking','vendor.booking.view'],'active') ?>">
                        <a href="{{route('vendor.booking')}}">
                            <i class='bx bx-task icon'></i>
                            <span class="text nav-text">Bookings</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['vendor.profile'],'active') ?>">
                        <a href="{{route('vendor.profile')}}">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['vendor.location','vendor.location.edit','vendor.location.view'],'active') ?>">
                        <a href="{{route('vendor.location')}}">
                            <i class='bx bxs-map-pin icon' ></i>
                            <span class="text nav-text">Location</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['vendor.timeslot'],'active') ?>">
                        <a href="{{route('vendor.timeslot')}}">
                            <i class='bx bxs-time-five icon' ></i>
                            <span class="text nav-text">Time Slot</span>
                        </a>
                    </li>

                    <li class="nav-link <?= ActiveMenu(['vendor.service','vendor.service.add','vendor.service.edit'],'active') ?>">
                        <a href="{{route('vendor.service')}}">
                            <i class='bx bxs-car-mechanic icon'></i>
                            <span class="text nav-text">Services</span>
                        </a>
                    </li>
                </ul>
            </div>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <form method="POST" action="{{route('logout')}}">
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