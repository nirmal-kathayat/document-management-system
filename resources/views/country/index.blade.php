@extends('layouts.default')
@section('title','Country')
@section('content')
<div class="inner-section-wrapper">
  <div class="create-link">
    <a href="{{route('admin.country.create')}}">Add country</a>
  </div>

  <div class="data-table-wrapper">
    <table id="country-table" class="table">
<<<<<<< HEAD
      <thead>
        <tr>
          <td>S.No</td>
          <td>Title</td>
          <td>Continent</td>
          <td>Action</td>
        </tr>
      </thead>
=======
        <thead>
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Continent</th>
                <th>Action</th>
            </tr>
        </thead>
>>>>>>> b222d5bbc6fcf2f08755ba2a13b61cbb0dc86edd
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
      url: "{{route('admin.country')}}",

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
        data: 'continent_title',
        name: 'continent_title',
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
            "{{ route('admin.country.edit', ['id' => ':id']) }}"
            .replace(':id', full.id);
          var deleteUrl =
            "{{ route('admin.country.delete', ['id' => ':id']) }}"
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