@extends('layouts.default')
@section('title','Applicants')
@section('content')
<div class="inner-section-wrapper applicant-block">
	<div class="filter-wrapper">
		<div class="flex-row justify-space-between align-center">
			<div class="search-wrapper">
				<input type="text" name="search">
				<i class="fa fa-search"></i>
			</div>
			<div class="other-action-wrapper flex-end">
				<a href="{{route('admin.applicant.create')}}" title="Create Applicant"><i class="fa fa-user-plus"></i></a>
				<form method="post" class="excel-export-form"action="{{route('admin.applicant.export')}}">
					@csrf
					 <input type="hidden" name="from_date">
					 <input type="hidden" name="to_date">
					 <input type="hidden" name="age">
					 <input type="hidden" name="position">
					 <input type="hidden" name="country">
					 <input type="hidden" name="experience">
					 <input type="hidden" name="gender">
					 <input type="hidden" name="isSelected" value="false">
					<button title="Download Excel"><i class="fa fa-file-excel-o"></i></button>
				</form>
				<button type="button" class="filter-btn"><i class="fa fa-filter"></i></button>
			</div>
		</div>
		<div class="grey-bg filter-fields-wrapper">
			<form method="get" class="filter-submit-form">
				<div class="grid-row col-gap-10 row-gap-20 template-repeat-3">
					<div class="form-group group-row ">
						<label>From Date</label>
						<input type="date" name="from_date">
					</div>
					<div class="form-group group-row">
						<label>Country</label>
						<select name="country">
							<option value="">Select</option>
							@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group group-row">
						<label>Experience</label>
						<select name="experience">
							<option value="">Select</option>
							@foreach($experiences as $experience)
								<option value="{{$experience->experience}}">{{$experience->experience}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group group-row ">
						<label>To Date</label>
						<input type="date" name="to_date">
					</div>
					<div class="form-group group-row">
						<label>Position</label>
						<select name="position">
							<option value="">Select</option>
							@foreach($positions as $position)
								<option value="{{$position->id}}">{{$position->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group group-column">
						<div class="grid-row col-gap-10 template-repeat-2">
							<div class="form-group group-row">
								<label>Age</label>
								<input type="number" name="age">
							</div>
							<div class="form-group group-row">
								<label>Sex</label>
								<select name="gender">
									<option value="">Select</option>
									@foreach(getGender() as $gender)
										<option value="{{$gender}}">{{$gender}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="form-group group-row">
						<label style="display: flex;align-items: center;width:50%">Selected&nbsp;&nbsp;<input style="width:20px;height:20px" type="checkbox" name="isSelected" class="filter-is-select"></label>
						
					</div>

				</div>
				<div class="form-group group-column filter-submit-wrapper">
					<button class="primary-btn">Filter</button>
				</div>
			</form>
		</div>
	</div>
	<div class="data-table-wrapper">
		<table id="applicant-table" class="table">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Date</th>
					<th>Given Name</th>
					<th>Surname</th>
					<th>Position</th>
					<th>Country</th>
					<th>Experience</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="flex-row flex-end move-btn-wrapper" style="margin-top:20px">
		<a href="" class="primary-btn">Move to Selected</a>
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
	const dataTable = $('#applicant-table').DataTable({
		processing:true,
		serveSide:true,
		responsive:true,
		searching:false,
		ordering: false,
		ajax:{
			url:"{{route('admin.applicant')}}",

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
			data:'created_at',
			name:'created_at',
			searchable:false,
			orderable:false,
			render:function(data,type,full,meta){
				const date = new Date(full.created_at); 
				const options = { day: 'numeric', month: 'short', year: 'numeric' };
				return  `${date.toLocaleDateString('en-GB', options)}`;
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
			data:'position_name',
			name:'position_name',
			orderable:false,
		},
		{
			data:'country_name',
			name:'country_name',
			orderable:false,
		},
		{
			data:'experience',
			name:'experience',
			orderable:false,
			searchable:false,
		},
		{
			data: 'action',
			name: 'action',
			orderable: false,
			searchable: false,
			render:function(data,type,full,meta){
				var editUrl =
				"{{ route('admin.applicant.edit', ['id' => ':id']) }}"
				.replace(':id', full.id);
				var editButton =
				'<a title="Edit" class="primary-btn" href="' + editUrl + '"><i class="fa fa-pencil"></i></a>';
				var viewUrl =
				"{{ route('admin.applicant.info', ['id' => ':id']) }}"
				.replace(':id', full.id);
				var viewButton =
				'<a title="Info" class="primary-btn" href="' + viewUrl + '"><i class="fa fa-eye"></i></a>';
				var cvUrl =
				"{{ route('admin.applicant.info', ['id' => ':id']) }}?type=cv"
				.replace(':id', full.id);
				var cvButton =
				'<a title="Info" class="primary-btn" href="' + cvUrl + '">CV</a>';
				   var deleteUrl =
                "{{ route('admin.applicant.delete', ['id' => ':id']) }}".replace(':id', full.id);
                var deleteButton =
                  `<button type="button" class="danger-btn confirm-modal-open" href=${deleteUrl}><i class="fa fa-trash"></i></button>`;
				var checkbox =!!full?.is_selected ? '' :  `<input value="${full.id}"  type='checkbox' class="applicant-selected-checkbox"  />`
				var actionButtons =
				`<div style='display:flex;column-gap:10px;align-items:center;justify-content:flex-end;'>${checkbox} ${editButton} ${viewButton} ${cvButton} ${deleteButton}</div>`;
				return actionButtons
			}
		}
		]
	})
	var timeout;
	$('.search-wrapper input').on('change',function(){
		const val = $(this).val()
		dataTable.ajax.url("{{ route('admin.applicant') }}?search=" + val).load();
	})
	$('.filter-btn').on('click',function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active')
			$('.filter-fields-wrapper').fadeOut()
		}else{
			$(this).addClass('active')
			$('.filter-fields-wrapper').fadeIn()

		}
	})

	$('.filter-submit-form').on('submit',function(event){
		event.preventDefault()
		const formData = $(this).serialize()
		const arrayData = $(this).serializeArray()
		arrayData?.forEach(item =>{
			$(`.excel-export-form input[name=${item?.name}]`).val(item?.value)
		})
		dataTable.ajax.url("{{ route('admin.applicant') }}?" + formData).load();
	})

	$('.filter-is-select').on('change',function(){
		const val  = $(this).prop('checked') ? 'on' : 'off';
		$(`.excel-export-form input[name=isSelected]`).val(val)
	})

	const checkbox = $('.applicant-selected-checkbox')
	let selected = []
	$(document).on('change','.applicant-selected-checkbox',function(){
		const isChecked = $(this).prop('checked')
		const val = parseInt($(this).val())
		if(!!isChecked){
			selected.push(val)
		}else{
			selected = selected?.filter(item => val!=item)
		}
		

		if(!!selected?.length){
			let url = "{{route('admin.applicant.move')}}?ids="+selected.toString()
			$('.move-btn-wrapper a').attr('href',url)
			$('.move-btn-wrapper').show()
		}else{
			$('.move-btn-wrapper').hide()
			$('.move-btn-wrapper a').attr('href','')
		}
	})
</script>
@endpush