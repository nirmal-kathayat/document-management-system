<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Permission List</title>
</head>

<body>
  <section class="inner-section-wrapper">
    <div class="bg-white room">
      <div class="title-wrapper flex">
        <div class="page-title">Permissions</div>
        <div class="flex align-items-center">

          <a href="{{ route('admin.permission.create') }}">
            <button class="btn btn--primary btn--icon ml-24">
              <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 4.16663V15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.66669 10H16.3334" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span>New Permission</span>
            </button>
          </a>
        </div>
      </div>

      <div class="container">
        <div class="table-wrapper">
          <table id="roomTable" class="display" style="width:100%">
            <thead>
              <tr class="table-header">
                <th>S.no</th>
                <th>Name</th>
                <th>Permision Type</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </section>
</body>

</html>

<script>
  $(document).ready(function() {
    $('#roomTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.permission') }}", // Replace with the correct route
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
          data: 'access_uri',
          name: 'access_uri',
          orderable: false,
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          render: function(data, type,
            full, meta
          ) {


            var editUrl = "{{route('admin.permission.edit',['id'=>':id'])}}"
              .replace(':id', full.id);

            var deleteUrl =
              "{{route('admin.permission.delete',['id'=>':id'])}}"
              .replace(':id', full.id);

            var editButton =
              '<a class="btn btn-secondary btn-sm" href="' +
              editUrl + '"><i class="fas fa-edit"></i></a>';

            var deleteButton =
              `<a class="btn btn-danger deleteAction btn-sm" href=${deleteUrl}><i class="fa fa-trash"></i></a>`;


            var actionButtons = `<div style='display:flex;'>
                                      ${editButton} ${deleteButton}
                                     </div>`;
            return actionButtons;

          }
        }
      ],
      initComplete: function(settings, json) {
        console.log(json); // Log the received JSON data
      }
    });
  });
</script>