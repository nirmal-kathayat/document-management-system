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
                   @if(can(url('admin/passports/create/')))
                  <li>
                      <a href="{{route('admin.passport.create')}}" class="{{ request()->is('admin/passports/create') ? 'active' : '' }}"><i class="fa fa-photo"></i>Upload Passport</a>
                  </li>
                  @endif
                  @if(can(url('admin/passports')))
                   <li>
                      <a href="{{route('admin.passport')}}" class="{{ request()->is('admin/passports') ? 'active' : '' }}"><i class="fa fa-photo"></i>Uploaded Passport</a>
                  </li>
                  @endif
                  @if(can(url('admin/applicants/create')))
                  <li>
                       <a href="{{route('admin.applicant.create')}}" class="{{ request()->is('admin/applicants/create') ? 'active' : '' }}"><i class="fa fa-user"></i>Add Applicant</a>
                  </li>
                  @endif
                  @if(can(url('admin/applicants')))
                   <li>
                       <a  href="{{route('admin.applicant')}}" class="{{ request()->is('admin/applicants') ? 'active' : '' }}"><i class="fa fa-user"></i>View Applicants</a>
                  </li>
                  @endif
                  @if(can(url('admin/countries/create')))

                  <li>
                       <a href="{{route('admin.country.create')}}" class="{{ request()->is('admin/countries/create') ? 'active' : '' }}"><i class="fa fa-flag"></i>Add Country</a>
                  </li>
                  @endif
                  @if(can(url('admin/countries')))
                    <li>
                       <a href="{{route('admin.country')}}" class="{{ request()->is('admin/countries') ? 'active' : '' }}"><i class="fa fa-flag"></i>View Country</a>
                    </li>
                  @endif
                  @if(can(url('admin/demands/create')))

                  <li>
                       <a href="{{route('admin.demand.create')}}" class="{{ request()->is('admin/demands/create') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>Add Demand</a>
                  </li>
                  @endif
                  @if(can(url('admin/demands')))
                   <li>
                       <a href="{{route('admin.demand')}}" class="{{ request()->is('admin/demands') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>View Demand</a>
                  </li>
                  @endif
                  @if(can(url('admin/positions/create')))
                   <li>
                       <a href="{{route('admin.position.create')}}" class="{{ request()->is('admin/positions/create') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>Add Position</a>
                  </li>
                  @endif
                  @if(can(url('admin/positions')))

                   <li>
                       <a href="{{route('admin.position')}}" class="{{ request()->is('admin/positions') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>View Position</a>
                  </li>
                  @endif
                 
              </ul>
          </nav>
      </div>
  </div>
</aside>