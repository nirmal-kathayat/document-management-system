@extends('layouts.default')
@php
  use Carbon\Carbon;

@endphp
@section('title','Dashboard')
@section('content')
<section class="card-view">
  <div class="grid-row template-repeat-4  col-gap-20">
    <div class="form-group column card-row">
      <a href="{{route('admin.passport.create')}}" class="flex-row col-gap-20">
       <i class="fa fa-photo"></i>
       <h4>UPLOAD <br>PASSPORT</h4>
     </a>
   </div>
   <div class="form-group column  card-row">
     <a href="{{route('admin.applicant.create')}}" class="flex-row col-gap-20">
      <i class="fa fa-user"></i>
      <h4>ADD <br>APPLICANT</h4>
    </a>
  </div>

  <div class="form-group column card-row">
   <a href="{{route('admin.applicant')}}" class="flex-row col-gap-20">
    <i class="fa fa-check"></i>
    <h4>Total APPLICANTS <br> <span class="text-blue">{{$total_applicant}}</span> </h4>
  </a>
</div>
<div class="form-group column card-row">
 <a href="{{route('admin.applicant')}}" class="flex-row col-gap-20">
  <i class="fa fa-plane"></i>
  <h4>APPROVED <br><span class="text-blue">30</span> </h4>
</a>
</div>
</div>
</section>

<section class="upload-table-content">
  <div class="flex-row justify-space-between">
    <div class="card-info">
      <div class="form-group group-column  card-column">
          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
      </div>
    </div>
    <div class="table-wrapper dashboard-quick-view">
      <div class="flex-row justify-space-between align-center">
        <h1 style="font-size:21px;font-weight:700">Quick <span class="text-blue">view</span></h1>
        <a href="{{route('admin.applicant')}}">View All</a>
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
            @foreach($applicants as $applicant)
            @php
               $age =  Carbon::createFromFormat('Y-m-d', $applicant->dob)->diffInYears(Carbon::now());

            @endphp
            <tr role="row" class="odd">
              <td>{{$applicant->first_name}} {{$applicant->last_name}}</td>
              <td>{{$applicant->experiences['professionals'][0]['duration'] ?? ''}}</td>
              <td>{{$age}}</td>
              <td>{{$applicant->gender}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection

@push('js')
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script>
window.onload = function () {

var options = {
  theme: "light2",
  animationEnabled: true,
  data: [{
    type: "pie",
    startAngle: 40,
    toolTipContent: "<b>{label}</b>: {y}%",
    showInLegend: "true",
    legendText: "{label}",
    indexLabelFontSize: 16,
    indexLabel: "{label} - {y}%",
    dataPoints: [
      { y: `{{$stats['total_female_percentage']}}`, label: "Female", },
      { y: `{{$stats['total_male_percentage']}}`, label: "Male" },
    ]
  }]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
@endpush