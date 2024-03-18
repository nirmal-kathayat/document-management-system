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
                      <a href="{{route('admin.passport')}}" class="{{ request()->is('admin/passport') ? 'active' : '' }}"><i class="fa fa-photo"></i>Uploaded Passport</a>
                  </li>

                  <li>
                       <a href="{{route('admin.applicant.create')}}" class="{{ request()->is('admin/applicant/create') ? 'active' : '' }}"><i class="fa fa-user"></i>Add Applicant</a>
                  </li>
                   <li>
                       <a  href="{{route('admin.applicant')}}" class="{{ request()->is('admin/applicant') ? 'active' : '' }}"><i class="fa fa-user"></i>View Applicants</a>
                  </li>
                  <li>
                       <a href="{{route('admin.country.create')}}" class="{{ request()->is('admin/country/create') ? 'active' : '' }}"><i class="fa fa-flag"></i>Add Country</a>
                  </li>
                    <li>
                       <a href="{{route('admin.country')}}" class="{{ request()->is('admin/country') ? 'active' : '' }}"><i class="fa fa-flag"></i>View Country</a>
                  </li>

                  <li>
                       <a href="{{route('admin.demand.create')}}" class="{{ request()->is('admin/demand/create') ? 'active' : '' }}"><i class="fa fa-eye"></i>Add Demand</a>
                  </li>
                   <li>
                       <a href="{{route('admin.demand')}}" class="{{ request()->is('admin/demand') ? 'active' : '' }}"><i class="fa fa-eye"></i>View Demand</a>
                  </li>
                   <li>
                       <a href="{{route('admin.position.create')}}" class="{{ request()->is('admin/position/create') ? 'active' : '' }}"><i class="fa fa-eye"></i>Add Position</a>
                  </li>
                   <li>
                       <a href="{{route('admin.position')}}" class="{{ request()->is('admin/position') ? 'active' : '' }}"><i class="fa fa-eye"></i>View Position</a>
                  </li>
                  <li>
                       <a href="{{route('admin.users.create')}}" class="{{ request()->is('admin/users/create') ? 'active' : '' }}"><i class="fa fa-eye"></i>Add Users</a>
                  </li>
                  <li>
                       <a href="{{route('admin.users')}}" class="{{ request()->is('admin/users') ? 'active' : '' }}"><i class="fa fa-eye"></i>View Users</a>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
</aside>