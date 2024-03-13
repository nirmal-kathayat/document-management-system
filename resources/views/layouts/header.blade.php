<div class="header-wrapper">
    <div class="container">
        <div class="flex-row justify-space-between align-center">
            <div class="header-section-title">
                <h1>@yield('title')</h1>
                
            </div>
            <div class="header-profile-wrapper">
                <h2><span>Hi, </span><span>{{auth()->guard('admin')->user()->name}}</span></h2>
                <div class="profile-wrapper">
                    <img src="{{asset('images/defaultuser.png')}}">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-dropdown">
        <ul>
          <li><a href="#">My Profile</a></li>
          <li><a href="#">All User</a></li>
          <li><a href="#">Add User</a></li>
          <li><a href="{{route('logout')}}">Logout</a></li>

        </ul>
    </div>
</div>