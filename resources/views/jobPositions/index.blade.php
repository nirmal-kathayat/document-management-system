@extends('layouts.default')
@section('title','Job Position')
@section('content')
<div class="inner-section-wrapper">
  <div class="create-link">
    <a href="{{route('admin.jobPosition.create')}}">Add job position</a>
  </div>

  <div class="data-table-wrapper">
    <table id="country-table" class="table">
      <thead>
        <tr>
        <th>SN No.</th>
        <th>Job Position Title</th>
        <th>IS Description</th>
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
      url: "{{route('admin.jobPosition')}}",

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
        data: 'title',
        name: 'title',
        orderable: false,
      },
      {
        data: 'isDescription',
        name: 'isDescription',
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
            "{{ route('admin.jobPosition.edit', ['id' => ':id']) }}"
            .replace(':id', full.id);
          var deleteUrl =
            "{{ route('admin.jobPosition.delete', ['id' => ':id']) }}"
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