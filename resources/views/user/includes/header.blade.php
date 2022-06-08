<div class="top-header d-f j-c-f-e a-i-c">
            <ul class="quick-action-list">
                <!-- <li><a href="javascript:void(0);" class="action-btn-icon new"><i class='bx bx-bell' ></i></a></li> -->
                <li>
                    <div class="sidebar-profile p-0">
                            <span class="profile-img"><img src="{{Auth::user()->avatar != null ? asset(Auth::user()->avatar)  : asset('backend/images/user.png')}}"></span>
                            <div class="pro-info">
                                <h4>{{Auth::user()->name}}</h4>
                                <span class="email-add">User account</span>
                            </div>
                        </div>
                    </li>
            </ul>
        </div>