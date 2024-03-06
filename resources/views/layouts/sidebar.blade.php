<!-- Important sidebar code -->

<div class="sidebar-wrapper">
  <div class="sidebar">
    <div class="logo-wrapper">
      <img src="{{ asset('images/logoWrap.svg') }}" style="width: 175px; height: 115px;" alt="logo">
    </div>

    <div class="dashboard-icon">
      <div class="nav-item-1">
        <img src="{{ asset('images/dashboard12.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="{{route('admin.dashboard')}}" class="nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}">
        <div class="nav-item-label-1">
          <h4> Dashboard</h4>
        </div>
      </a>
    </div>


    <div class="upload-pass">
      <div class="nav-item-2">
        <img src="{{ asset('images/uploadPass.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="#">
        <div class="nav-item-label-2">
          <h4>Upload Passport</h4>
        </div>
      </a>
    </div>


    <div class="add-user">
      <div class="nav-item-3">
        <img src="{{ asset('images/userApplicant.svg') }}" class="icon-1" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="#">
        <div class="nav-item-label-3">
          <h4>Add Applicant</h4>
        </div>
      </a>
    </div>


    <div class="view-applicant">
      <div class="nav-item-4">
        <img src="{{ asset('images/viewApplicant.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="#">
        <div class="nav-item-label-4">
          <h4>View Applicants</h4>
        </div>
      </a>
    </div>


    <div class="add-category">
      <div class="nav-item-5">
        <img src="{{ asset('images/categoryLogin.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="#">
        <div class="nav-item-label-5">
          <h4>Add Category</h4>
        </div>
      </a>
    </div>


    <div class="login-history">
      <div class="nav-item-6">
        <img src="{{ asset('images/categoryLogin.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="#">
        <div class="nav-item-label-6">
          <h4>Login History</h4>
        </div>
      </a>
    </div>

    <hr class="line-wrap">

    <div class="logout-wrapper">
      <div class="nav-item-7">
        <img src="{{ asset('images/categoryLogin.svg') }}" style="width: 25px; height: 30px;" alt="logo">
      </div>
      <a href="{{route('logout')}}">
        <div class="nav-item-label-7">
         <h4> Logout</h4>
        </div>
      </a>
    </div>
  </div>
</div>