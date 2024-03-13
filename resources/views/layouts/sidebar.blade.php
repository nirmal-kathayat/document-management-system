<aside class="sidebar">
  <div class="sidebar-wrapper">
      <div class="logo">
         <img src="{{ asset('images/logo.png') }}" style="width:100%; height: 120px;" alt="logo">
      </div>
      <div class="sidebar-nav-wrapper">
          <nav>
              <ul>
                  <li>
                      <a href="#"><i class="fa fa-home"></i>Dashboard</a>
                  </li>
                  <li>
                      <a href="{{route('admin.applicant.upload')}}"><i class="fa fa-photo"></i>Upload Passport</a>
                  </li>

                  <li>
                       <a href="#"><i class="fa fa-user"></i>Add Applicant</a>
                  </li>
                   <li>
                       <a href="#"><i class="fa fa-eye"></i>View Applicants</a>
                  </li>

                  <li>
                       <a href="{{route('admin.continent.create')}}"><i class="fa fa-eye"></i>Add Continent</a>
                  </li>

                  <li>
                       <a href="{{route('admin.country.create')}}"><i class="fa fa-eye"></i>Add Country</a>
                  </li>

                  <li>
                       <a href="{{route('admin.demand.create')}}"><i class="fa fa-eye"></i>Add Demand</a>
                  </li>

                  <li>
                       <a href="{{route('admin.jobPosition.create')}}"><i class="fa fa-eye"></i>Add Job Position</a>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
</aside>