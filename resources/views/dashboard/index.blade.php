@extends('layouts.default')
@section('title','Dashboard')
@section('content')
<section class="card-view">
  <div class="grid-row template-repeat-4  col-gap-20">
    <div class="form-group group-row card-row-1">
      <i class="fa fa-photo"></i>
      <h2>UPLOAD <br>PASSPORT</h2>
    </div>
    <div class="form-group group-row  card-row-1">
      <i class="fa fa-user"></i>
      <h2>ADD <br>APPLICANT</h2>
    </div>

    <div class="form-group group-row card-row">
      <i class="fa fa-check"></i>
      <h4>Total APPLICANTS <br> <span class="text-blue">3500</span> </h4>
    </div>
    <div class="form-group group-row card-row">
      <i class="fa fa-plane"></i>
      <h4>APPROVED <br><span class="text-blue">30</span> </h4>
    </div>
  </div>
</section>

<section class="upload-table-content">
  <div class="grid-row template-repeat-2">
    <div class="grid-column">
      <div class="form-group group-column card-column">
        <img src="https://culinarylabschool.com/wp-content/uploads/2019/06/Pros-and-cons-to-working-in-culinary-arts-CulinaryLab-School.jpg" style="width: 200px;height:200px;" alt="img">
        <select class="card-dropdown" name="" id="">
          <option value="cook">cook</option>
          <option value="cook">cook</option>
          <option value="cook">cook</option>
        </select>
        <span class="text-black">256</span>
      </div>
      <div class="form-group group-column  card-column">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/63/Pie-chart.jpg" style="width: 200px;height:200px;" alt="piechart">
      </div>
    </div>
    <div class="table-wrapper">
      <div class="flex-row justify-space-between">
        <h1>Quick <span class="text-blue">view</span></h1>
        <a href="#">View All</a>
      </div>
      <div class="col-sm-12">
        <table style="width: 100%;" class="table">
          <thead>
            <tr role="row">
              <th>Full Name</th>
              <th>Experience</th>
              <th>Age</th>
              <th>Sex</th>
            </tr>
          </thead>
          <tbody>
            <tr role="row" class="odd">
              <td>Ram kumar Bista</td>
              <td>4 Years</td>
              <td>30</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Anjana Shrestha</td>
              <td>2 Years</td>
              <td>40</td>
              <td>Female</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Rashmi Bista</td>
              <td>6 Years</td>
              <td>37</td>
              <td>Female</td>
            </tr>
            <tr>
              <td>Ram kumar Bista</td>
              <td>4 Years</td>
              <td>30</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Rashmi Bista</td>
              <td>6 Years</td>
              <td>37</td>
              <td>Female</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Rashmi Bista</td>
              <td>6 Years</td>
              <td>37</td>
              <td>Female</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Niraj Basnet</td>
              <td>5 Years</td>
              <td>35</td>
              <td>Male</td>
            </tr>
            <tr>
              <td>Anjana Shrestha</td>
              <td>2 Years</td>
              <td>40</td>
              <td>Female</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection