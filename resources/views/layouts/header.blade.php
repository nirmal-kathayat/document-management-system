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
          <li><a href="{{route('admin.profile')}}">My Profile</a></li>
          @if(can(url('admin/users')))
            <li><a href="{{route('admin.user')}}">All User</a></li>
          @endif
           @if(can(url('admin/users/create')))
          <li><a href="{{route('admin.user.create')}}">Add User</a></li>
          @endif
           @if(can(url('admin/roles')))
           <li><a href="{{route('admin.role')}}">All Role</a></li>
           @endif
           @if(can(url('admin/roles/create')))
          <li><a href="{{route('admin.role.create')}}">Add Role</a></li>
          @endif
           @if(can(url('admin/permissions')))
          <li><a href="{{route('admin.permission')}}">All Permission</a></li>
          @endif
          @if(can(url('admin/permissions/create')))
          <li><a href="{{route('admin.permission.create')}}">Add Permission</a></li>
          @endif
          <li><a href="{{route('admin.changePassword.create')}}">Change Password</a></li>
          <li><a href="{{route('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>