@extends('layouts.default')
@section('title','Job Position')
@section('content')

<div class="inner-section-wrappe">
  <div class="create-link">
    <a href="{{route('admin.position.create')}}">Add Position</a>
  </div>

  <div class="data-table-wrapper">
    <table id="position-table" class="table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Duties</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>
@endsection

@push('style')
 <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/dataTables.bootstrap.min.css')}}"
  rel="stylesheet">
@endpush
@push('js')
  <script type="text/javascript" src="{{asset('vendor/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatable/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
     const dataTable = $('#position-table').DataTable({
        processing:true,
        serveSide:true,
        responsive:true,
        ajax:{
          url:"{{route('admin.position')}}",

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
            data:'title',
            name:'title',
            orderable:false,
          },
          {
            data:'duties',
            name:'duties',
            orderable:false,
            searchable:false,
            render:function(data,type,full,meta){
              return !!full.duties ?  full.duties.toString() : ''
            }
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            render:function(data,type,full,meta){
              var editUrl =
                "{{ route('admin.position.edit', ['id' => ':id']) }}"
                .replace(':id', full.id);
                var deleteUrl =
                "{{ route('admin.position.delete', ['id' => ':id']) }}" .replace(':id', full.id);
              var editButton =
                '<a class="primary-btn" href="' + editUrl + '"><i class="fa fa-pencil"></i></a>';
              var deleteButton =
                  `<button type="button" class="danger-btn confirm-modal-open" href=${deleteUrl}><i class="fa fa-trash"></i></button>`;
              var actionButtons =
                 `<div style='display:flex;column-gap:10px'> ${editButton} ${deleteButton}</div>`;
              return actionButtons
            }
          }
        ]
     })
  </script>
@endpush