@extends('layouts.default')
@section('title','Leadership Board')
@section('content')

<div class="inner-section-wrapper">
  <div class="data-table-wrapper">
    <table id="position-table" class="table">
      <thead>
        <tr>
          <th>S.No</th>
          <th>Full name</th>
          <th>Designation</th>
          <th>Applicants</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endpush
@push('js')
<script type="text/javascript" src="{{asset('vendor/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatable/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  const dataTable = $('#position-table').DataTable({
    processing: true,
    serveSide: true,
    responsive: true,
    ajax: {
      url: "{{route('admin.leadershipBoard')}}",

    },
    columns: [{
        data: 'id',
        name: 'id',
        searchable: false,
        render: function(data, type, full, meta) {
          return full?.DT_RowIndex
        }
      },
      {
        data: 'name',
        name: 'name',
        orderable: false,
      },
      {
        data: 'designation',
        name: 'designation',
        orderable: false,
      },
      {
        data: 'applicants_count',
        name: 'applicants_count',
        orderable: false,
        searchable:false,

      },
    ]
  })
</script>
@endpush