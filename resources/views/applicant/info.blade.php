@extends('layouts.default')
@section('title',$passport->first_name.' '.$passport->last_name)
@section('content')
<div class="inner-section-wrapper applicant-block">
	@include('applicant.components.step-one')
	@include('applicant.components.step-two')
	@include('applicant.components.step-three')
	@include('applicant.components.step-four',['info' => true])

</div>
@endsection

@push('js')

	<script type="text/javascript">
		$('.text-red').remove()
		$('select').prop('disabled',true)
		$('textarea').prop('disabled',true)
		$('input[type=checkbox]').prop('disabled',true)
		$('input[type=radio]').prop('disabled',true)
		$('input[type=file]').prop('disabled',true)


		$('input').attr('readonly',true)
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