@extends('layouts.default')
@section('title','Demand')
@section('content')
<div class="inner-section-wrapper">
  <div class="create-link">
    <a href="{{route('admin.demand.create')}}">Add demand</a>
  </div>

  <div class="data-table-wrapper">
    <table id="country-table" class="table">
      <thead>
        <tr>
        <th>SN No.</th>
        <th>Date</th>
        <th>Demand Name</th>
        <th>Salary</th>
        <th>Experience</th>
        <th>Country</th>
        <th>Comment</th>
        <th>Action</th>
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
  const dataTable = $('#country-table').DataTable({
    processing: true,
    serveSide: true,
    responsive: true,
    ajax: {
      url: "{{route('admin.demand')}}",

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
        data: 'date',
        name: 'date',
        orderable: false,
      },
      {
        data: 'title',
        name: 'title',
        orderable: false,
        searchable: false
      },
      {
        data: 'salary',
        name: 'salary',
        orderable: false,
        searchable: false
      },
      {
        data: 'experience',
        name: 'experience',
        orderable: false,
        searchable: false
      },
      {
        data: 'country',
        name: 'country',
        orderable: false,
        searchable: false
      },
      {
        data: 'comment',
        name: 'comment',
        orderable: false,
        searchable: false
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false,
        render: function(data, type, full, meta) {
          var editUrl =
            "{{ route('admin.demand.edit', ['id' => ':id']) }}"
            .replace(':id', full.id);
          var deleteUrl =
            "{{ route('admin.demand.delete', ['id' => ':id']) }}"
          var editButton =
            '<a class="primary-btn" href="' + editUrl + '"><i class="fa fa-pencil"></i></a>';
          var deleteButton =
            `<a class="danger-btn" href=${deleteUrl}><i class="fa fa-trash"></i></a>`;
          var actionButtons =
            `<div style='display:flex;column-gap:10px'> ${editButton} ${deleteButton}</div>`;
          return actionButtons
        }
      }
    ]
  })
</script>
@endpush