@extends('layouts.default')
@section('content')



<!-- icons box -->
<section class="icon-boxes">
  <div class="icon-container">
    <div class="add-users-info">
      <div class="img-1">
        <img src="{{ asset('images/icon-inbox.svg') }}" style="width: 40px; height: 40px;" alt="upload">

        <h4>UPLOAD <br> PASSPORT</h4>
      </div>

      <div class="img-2">
        <img src="{{ asset('images/icon-addApli.svg') }}" style="width: 40px; height: 40px;" alt="upload">

        <h4>ADD <br> APPLICANT</h4>
      </div>


      <div class="img-3">
        <img src="{{ asset('images/icon-inbox.svg') }}" style="width: 40px; height: 40px;" alt="upload">

        <h6>TOTAL APPLICANTS</h6>
        <h2>3500</h2>
      </div>

      <div class="img-4">
        <img src="{{ asset('images/icon-addApli.svg') }}" style="width: 40px; height: 40px;" alt="upload">

        <h6>APPROVED</h6>
        <h2>30</h2>
      </div>
    </div>
  </div>
</section>

<!-- info box -->
<section class="table-box">
  <div class="dropdown-wrap">
    <div class="img-dropdown">
      <img src="https://img.freepik.com/premium-photo/chef-preparing-food-kitchen-restaurant_777271-3987.jpg" style="width: 180px; height: 180px" alt="chef-image">

      <div class="select">
        <select name="dropdown" id="">
          <option value="cook">cooks</option>
          <option value="cook">cooks</option>
          <option value="cook">cooks</option>
          <option value="cook">cooks</option>
        </select>
      </div>
      <h4>256</h4>
    </div>
  </div>

  <div class="dropdown-wrap">
    <div class="img-dropdown">
      <img src="https://img.freepik.com/premium-photo/portrait-young-woman-chef-background_488220-23685.jpg" style="width: 50px; height: 50px" alt="chef-image">
    </div>
  </div>

  <!-- listing table -->
  <div class="listing-table">
    <div class="view">
      <h3>Quick <p>view</p></h3>
      <a href="#">View All</a>
    </div>
  <table>
  <tr>
    <h4>
    <th>Full Name</th>
    <th>Experience</th>
    <th>Age</th>
    <th>Sex</th>
    </h4>
    
  </tr>
  <tr>
    <td>Ram Kumar Bista</td>
    <td>4 Years</td>
    <td>30</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Anjana Shrestha</td>
    <td>2 Years</td>
    <td>34</td>
    <td>Female</td>
  </tr>
  <tr>
    <td>Niraj Basnet</td>
    <td>6 Years</td>
    <td>28</td>
    <td>Male</td>
  </tr>
  
  <tr>
    <td>Niraj Basnet</td>
    <td>6 Years</td>
    <td>28</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Niraj Basnet</td>
    <td>6 Years</td>
    <td>28</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Niraj Basnet</td>
    <td>6 Years</td>
    <td>28</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Ram Kumar Bista</td>
    <td>4 Years</td>
    <td>30</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Ram Kumar Bista</td>
    <td>4 Years</td>
    <td>30</td>
    <td>Male</td>
  </tr>
  <tr>
    <td>Anjana Shrestha</td>
    <td>2 Years</td>
    <td>34</td>
    <td>Female</td>
  </tr>
  <tr>
    <td>Anjana Shrestha</td>
    <td>2 Years</td>
    <td>34</td>
    <td>Female</td>
  </tr>
</table>
  </div>
</section>
@endsection