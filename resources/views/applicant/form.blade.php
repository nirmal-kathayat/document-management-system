@extends('layouts.default')
@php 
	$step = $_GET['step'] ?? 'one';
	$url = isset($applicant) ? route('admin.applicant.edit', ['id' => $applicant->id]) : 
       (isset($passport) ? route('admin.applicant.create', ['passport_id' => $passport->id]) : 
       route('admin.applicant.create'));
@endphp
@section('title','Job Application')
@section('content')
<div class="inner-section-wrapper applicant-block">
	<form action="{{$url}}" method="post" class="form-data" enctype="multipart/form-data">
		@csrf
		@if(isset($applicant))
			@method('PUT')
		@endif
		<input type="hidden" name="step" value="{{$step}}">
		<div class="form-wrapper">
			@if($step =='one')
				@include('applicant.components.step-one')
			@elseif($step =='two')
				@include('applicant.components.step-two')
			@elseif($step =='three')
			@endif
			<div class="form-group group-row flex-end col-gap-20">
				@if($step!=='one')
					<a class="back-btn" href="{{route('admin.applicant.edit',['id' => $applicant->id,'step' => $step=='two' ? 'one' :'two'])}}">Back</a>
				@endif
				<button type="submit" class="primary-btn">Next</button>
			</div>
		</div>
	</form>
</div>
@endsection

@push('js')
@include('scripts.validation')
<script>
	(function() {
		function Initial() {
			let _this = this;

			this.fetchCountryListener = function(){
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

				continentSelect.on('change',function(){
					requestApi($(this).val())
				})
			}

			this.previewFileListener = function(files,target){
				const file = files[0]
				console.log(files)
				const reader = new FileReader();
				target.find('.default-img').hide()
				reader.onload = function(event) {
					const imgWrapper = $('<div />',{
						class:'uploaded-img',
					})
					const img = $('<img />',{
						src:event.target.result
					})
					$('.uploaded-img').remove()
					$('.upload-passport-info').hide()
					imgWrapper.append(img)
					target.append(imgWrapper)
				};

				reader.readAsDataURL(file);
			}

			this.fileChangeListener = function(){
				const profile = $('#profile-input')
				profile.on('change',function(e){
					_this.previewFileListener(e.target.files,$(this).parent().prev())
				})
			}

			this.maritalStatusListener = function(){
				const maritalSelect = $('#marital-select')
				maritalSelect.on('change',function(){
					const val = $(this).val()

					if(val ==='Single'){
						$('.family-form').hide()
					}else{
						$('.family-form').show()

					}
				})
			}

			this.init = function(){
				_this.fetchCountryListener()
				_this.fileChangeListener()
				_this.maritalStatusListener()
				
			}

		} 
		let initialObj = new Initial();
		initialObj.init();
	})();


</script>
@endpush