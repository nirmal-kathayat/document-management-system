@extends('layouts.default')
@section('title','Uploaded Passport')
@section('content')
<div class="inner-section-wrappe">
  <div class="create-link">
    <a href="{{route('admin.passport.create')}}">Upload Passport</a>
  </div>

  <div class="data-table-wrapper">
    <table id="passport-table" class="table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Given Name</th>
                <th>Surname</th>
                <th>Passport No</th>
                <th>Birth Place</th>
                <th>Gender</th>
                <th>Upload On</th>
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
     const dataTable = $('#passport-table').DataTable({
        processing:true,
        serveSide:true,
        responsive:true,
        ajax:{
          url:"{{route('admin.passport')}}",

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
            orderable:false,
          },
          {
            data:'last_name',
            name:'last_name',
            orderable:false,
          },
          {
            data:'passport_no',
            name:'passport_no',
            orderable:false,
          },
          {
            data:'district',
            name:'district',
            orderable:false,
          },
          {
            data:'gender',
            name:'gender',
            orderable:false,
          },
          {
            data:'created_at',
            name:'created_at',
            orderable:false,
            render:function(data,type,full,meta){
              const date = new Date(full.created_at); 
              const options = { day: 'numeric', month: 'short', year: 'numeric' };
              return  date.toLocaleDateString('en-GB', options);
            }
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            render:function(data,type,full,meta){
              var editUrl =
                "{{ route('admin.passport.edit', ['id' => ':id']) }}"
                .replace(':id', full.id);
              var editButton =
                '<a title="Edit" class="primary-btn" href="' + editUrl + '"><i class="fa fa-pencil"></i></a>';
              var actionButtons =
                 `<div style='display:flex;column-gap:10px'> ${editButton}</div>`;
              return actionButtons
            }
          }
        ]
     })
  </script>
@endpush