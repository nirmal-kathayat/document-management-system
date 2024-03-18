@extends('layouts.default')
@section('title','All Users')
@section('content')

<div class="inner-section-wrapper">
  <div class="create-link">
    <a href="{{route('admin.users.create')}}">Add Users</a>
  </div>
  <div class="data-table-wrapper">
    <table id="position-table" class="table">
      <thead>
        <tr>
          <th>S.No</th>
          <th>Full name</th>
          <th>Designation</th>
          <th>DOB</th>
          <th>phone No.</th>
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
  const dataTable = $('#position-table').DataTable({
    processing: true,
    serveSide: true,
    responsive: true,
    ajax: {
      url: "{{route('admin.users')}}",

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
      // {
      //   data: 'username',
      //   name: 'username',
      //   orderable: false,
      // },
      // {
      //   data: 'email',
      //   name: 'email',
      //   orderable: false,
      // },
      // {
      //   data: 'password',
      //   name: 'password',
      //   orderable: false,
      // },
      {
        data: 'designation',
        name: 'designation',
        orderable: false,
      },
      {
        data: 'dob',
        name: 'dob',
        orderable: false,
      },
      {
        data: 'phone_no',
        name: 'phone_no',
        orderable: false,
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false,
        render: function(data, type, full, meta) {
          var editUrl =
            "{{ route('admin.users.edit', ['id' => ':id']) }}"
            .replace(':id', full.id);
          var deleteUrl =
            "{{ route('admin.users.delete', ['id' => ':id']) }}".replace(':id', full.id);
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