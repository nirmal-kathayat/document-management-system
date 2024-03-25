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
        @if(can(url('admin/passports')) || can(url('admin/passports/create/')))
        <li class="{{request()->is('admin/passports/create') ||  request()->is('admin/passports') ? 'open' : '' }}">
          <p><i class="fa fa-photo"></i>Passport <i class="fa fa-chevron-right"></i></p>
          <ul class="side-dropdown">
            @if(can(url('admin/passports/create/')))
            <li><a href="{{route('admin.passport.create')}}" class="{{ request()->is('admin/passports/create') ? 'active' : '' }}">Upload</a></li>
            @endif
            @if(can(url('admin/passports')))
            <li>
              <a href="{{route('admin.passport')}}" class="{{ request()->is('admin/passports') ? 'active' : '' }}">View</a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if(can(url('admin/applicants')) || can(url('admin/applicants/create/')))
        <li class="{{request()->is('admin/applicants/create') ||  request()->is('admin/applicants') ? 'open' : '' }}">
          <p><i class="fa fa-user"></i>Applicant <i class="fa fa-chevron-right"></i></p>
          <ul class="side-dropdown">
            @if(can(url('admin/applicants/create')))
            <li>
              <a href="{{route('admin.applicant.create')}}" class="{{ request()->is('admin/applicants/create') ? 'active' : '' }}">Add</a>
            </li>
            @endif
            @if(can(url('admin/applicants')))
            <li>
              <a  href="{{route('admin.applicant')}}" class="{{ request()->is('admin/applicants') ? 'active' : '' }}">View</a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if(can(url('admin/countries')) || can(url('admin/countries/create/')))

        <li class="{{request()->is('admin/countries/create') ||  request()->is('admin/countries') ? 'open' : '' }}">
          <p><i class="fa fa-flag"></i>Country <i class="fa fa-chevron-right"></i></p>
          <ul class="side-dropdown">
           @if(can(url('admin/countries/create')))

           <li>
             <a href="{{route('admin.country.create')}}" class="{{ request()->is('admin/countries/create') ? 'active' : '' }}">Add</a>
           </li>
           @endif
           @if(can(url('admin/countries')))
           <li>
             <a href="{{route('admin.country')}}" class="{{ request()->is('admin/countries') ? 'active' : '' }}">View</a>
           </li>
           @endif
         </ul>
       </li>
       @endif
       @if(can(url('admin/demands')) || can(url('admin/demands/create/')))
       <li class="{{request()->is('admin/demands/create') ||  request()->is('admin/demands') ? 'open' : '' }}">
        <p><i class="fa fa-graduation-cap"></i>Demand <i class="fa fa-chevron-right"></i></p>
        <ul class="side-dropdown">
         @if(can(url('admin/demands/create')))

         <li>
          <a href="{{route('admin.demand.create')}}" class="{{ request()->is('admin/demands/create') ? 'active' : '' }}">Add</a>
        </li>
        @endif
        @if(can(url('admin/demands')))
        <li>
          <a href="{{route('admin.demand')}}" class="{{ request()->is('admin/demands') ? 'active' : '' }}">View</a>
        </li>
        @endif
      </ul>
    </li>
    @endif
    @if(can(url('admin/positions')) || can(url('admin/positions/create/')))
    <li class="{{request()->is('admin/positions/create') ||  request()->is('admin/positions') ? 'open' : '' }}">
      <p><i class="fa fa-graduation-cap"></i>Position <i class="fa fa-chevron-right"></i></p>
      <ul class="side-dropdown">
       @if(can(url('admin/positions/create')))
       <li>
         <a href="{{route('admin.position.create')}}" class="{{ request()->is('admin/positions/create') ? 'active' : '' }}">Add</a>
       </li>
       @endif
       @if(can(url('admin/positions')))
       <li>
         <a href="{{route('admin.position')}}" class="{{ request()->is('admin/positions') ? 'active' : '' }}">View</a>
       </li>
       @endif
     </ul>
   </li>
   @endif
   @if(can(url('admin/leadershipBoard')))
   <li>
     <a href="{{route('admin.leadershipBoard')}}" class="{{ request()->is('admin/leadershipBoard') ? 'active' : '' }}"><i class="fa fa-trophy"></i>Leadership Board</a>
   </li>
   @endif

 </ul>
</nav>
</div>
</div>
</aside>