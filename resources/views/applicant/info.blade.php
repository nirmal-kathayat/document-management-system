@extends('layouts.default')
@section('title',$passport->first_name.' '.$passport->last_name)
@php 
$type = isset($_GET['type']) && $_GET['type'] == 'cv' ? 'cv' : null;
$demand_id = isset($_GET['demand_id']) ? $_GET['demand_id'] : null;
@endphp
@section('content')
<div class="inner-section-wrapper applicant-block">
	@if($type!=='cv' && !empty($demand_id))
	<div class="flex-row justify-center" style="margin-bottom:20px;column-gap:20px">
		<a href="{{ route('admin.applicant.info', ['id' => $applicant->id]) }}?type=cv&demand_id={{$demand_id}}" class="primary-btn">Convert to CV</a>
	</div>
	@endif
	@if(empty($type))
	@include('applicant.components.step-one')
	@include('applicant.components.step-two')
	@include('applicant.components.step-three')
	@include('applicant.components.step-four',['info' => true])
	@else
	@include('applicant.components.cv')
	<div class="attachment-upload-wrapper">
		<form action="{{route('admin.applicant.edit', ['id' => $applicant->id])}}" method="post"  enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group group-row video-section">
				<p style="width:30%">Other Documents</p>
				<input required type="file" name="attachments[others][]" class="other-docs-input"  accept="image/*" multiple style="height:40px">
				<input type="hidden" name="redirect_path" value="back">
				<input type="hidden" name="step" value="four">
				<button class="primary-btn">Upload</button>
			</div>
		</form>
	</div>
	<div class="flex-row flex-end" style="margin-top:30px;column-gap:30px;">
		@if(isset($demandApplicant) && $demandApplicant->status!=='Approved')
			<form method="post" action="{{route('admin.applicant.status',['id' => $demand_id])}}">
				@csrf
				@method('PUT')
				<input type="hidden" name="status" value="Approved">
				<button class="primary-btn">Approved</button>
			</form>
		@endif
		
		<a href="{{route('admin.applicant.info',['id' => $applicant->id])}}?type=download&demand_id={{$demand_id}}" class="primary-btn" style="display:flex;align-items: center;justify-content: center;">Download</a>
	</div>
	@endif

</div>
@endsection

@push('js')

<script type="text/javascript">
	@if(empty($type))
	$('select').prop('disabled',true)
	$('textarea').prop('disabled',true)
	$('input[type=checkbox]').prop('disabled',true)
	$('input[type=radio]').prop('disabled',true)
	$('input[type=file]').prop('disabled',true)
	$('input').attr('readonly',true)
	@endif
	$('.text-red').remove()

	const continentSelect = $('select[name=continent_id]')
	const countrySelect = $('select[name=country_id]')
	const continentVal = continentSelect.val()
	function requestApi(continentId){
		$.ajax({
			type:'get',
			url:'{{route("admin.country.fetch")}}',
			data:{
				continent_id:continentId
			},success:function(resp){
				countrySelect.html('')
				countrySelect.append($('<option/>',{
					text:'Select Country',
					value:''
				}))
				const countryVal = countrySelect.data('selected')
				resp?.data?.forEach(country =>{
					countrySelect.append($('<option/>',{
						text:country.title,
						value:country.id,
						selected:parseInt(countryVal) == country.id ? true : false
					}))
				})
			},error:function(err){
				console.log(err)
			}
		})
	}
	if(!!continentVal){
		requestApi(continentVal)
	}

</script>
@endpush