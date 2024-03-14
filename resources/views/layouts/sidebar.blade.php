<aside class="sidebar">
  <div class="sidebar-wrapper">
      <div class="logo">
         <img src="{{ asset('images/logo.png') }}" style="width:100%; height: 120px;" alt="logo">
      </div>
      <div class="sidebar-nav-wrapper">
          <nav>
              <ul>
                  <li>
                      <a href="{{route('admin.dashboard')}}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fa fa-home"></i>Dashboard</a>
                  </li>
                  <li>
                      <a href="{{route('admin.passport.create')}}" class="{{ request()->is('admin/passport/create') ? 'active' : '' }}"><i class="fa fa-photo"></i>Upload Passport</a>
                  </li>

                  <li>
                       <a href="#"><i class="fa fa-user"></i>Add Applicant</a>
                  </li>
                   <li>
                       <a href="#"><i class="fa fa-eye"></i>View Applicants</a>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
</aside>