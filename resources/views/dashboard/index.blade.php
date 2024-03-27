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
       <h4>UPLOAD <br>PASSPORT </h4>
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
  <h4>APPROVED <br><span class="text-blue">{{$total_approved}}</span> </h4>
</a>
</div>
</div>
</section>

<section class="upload-table-content">
  <div class="flex-row justify-space-between">
    <div class="card-info">
       <div class="form-group group-column  card-column">
            <select name="position" class="dashboard-position-select">
               @foreach($positions as $key=>$position)
                   <option value="{{$position->id}}" {{$key === 0 ? "selected" : ''}}>{{$position->title}}</option>
               @endforeach
            </select>
       </div>
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
        <table class="table" id="applicant-table">
          <thead>
            <tr role="row">
              <th>S.No</th>
              <th>Given Name</th>
              <th>Surname</th>
              <th>Age</th>
              <th>Experience</th>
            </tr>
          </thead>
         
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/dataTables.bootstrap.min.css')}}"
rel="stylesheet">
@endpush
@push('js')
<script type="text/javascript" src="{{asset('vendor/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatable/dataTables.bootstrap.min.js')}}"></script>
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

const dataTable = $('#applicant-table').DataTable({
    processing:true,
    serveSide:true,
    responsive:true,
    searching:false,
    ordering: false,
    paging:   false,
    ajax:{
      url:`{{route('admin.applicant')}}?position=${$('.dashboard-position-select').val()}`,

    },
    columns:[
    {
      data:'id',
      name:'id',
      searchable:false,
      render:function(data,type,full,meta){
        return full?.DT_RowIndex
      }
    },
    {
      data:'first_name',
      name:'first_name',
    },
    {
      data:'last_name',
      name:'last_name',
    },
    {
      data:'dob',
      name:'dob',
      render:function(data,type,full,meta){
          const currentDate = new Date();
          const dob = new Date(full?.dob);
          let age = currentDate.getFullYear() - dob.getFullYear();
          return age
      }
    },
    {
      data:'experience',
      name:'experience',
    },
   
    ]
  })
$('.dashboard-position-select').on('change',function(){
    dataTable.ajax.url("{{ route('admin.applicant') }}?position=" + $(this).val()).load();

})
</script>
@endpush