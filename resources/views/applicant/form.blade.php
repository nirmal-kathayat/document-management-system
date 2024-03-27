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
			@include('applicant.components.step-three')
			@elseif($step =='four')
			@include('applicant.components.step-four')
			@endif
			<div class="form-group group-row flex-end col-gap-20">
				@if($step!=='one')
				<a class="back-btn" href="{{ route('admin.applicant.edit', [
				'id' => $applicant->id,
				'step' => $step == 'two' ? 'one' : ($step == 'three' ? 'two' : 'three')
				]) }}">Back</a>
				@endif
				<button type="submit" class="primary-btn">{{$step =='four' ? 'Finished' : 'Next'}}</button>
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

			this.positionChangeListener = function(){
				$(document).on('change','.position-select-wrapper',function(e){
					const value = $(this).val()
					var selectedDuties = $(this).find('option:selected').data('duties') || [];
					const parent = $(this).parent().parent().parent()
					parent.parent().find('.duties-add-on').remove()
					if(!!selectedDuties?.length){
						const subTitleWrapper = $('<div />',{
							class:'form-section-sub-title duties-add-on',

						})
						const subTitle = $('<h5/>',{
							text:'Duties'
						})
						subTitleWrapper.append(subTitle)
						const wrapper = $('<div />',{
							class:'form-wrapper',
							style:'padding:0px 15px;'
						})
						const gridRow = $('<div />',{
							class:'grid-row template-repeat-4 col-gap-20 duties-add-on row-gap-10'
						})

						selectedDuties?.forEach(item =>{
							const group = $('<div />',{
								class:'form-group group-row col-gap-10 align-center checkbox-wrapper'
							})


							const label = $('<label />',{
								text:item
							})

							const checkbox = $('<input />',{
								type:'checkbox',
								name:`experiences[professionals][${parseInt(parent.parent().data('index'))}][duties][]`,
								class:'duties-checkbox',
								value:item
							})

							group.append(label)
							group.append(checkbox)
							gridRow.append(group)

						})

						wrapper.append(gridRow)

						parent.after(wrapper)
						parent.after(subTitleWrapper)
					}

				})
			}

			this.attachmentListener = function(){
				const target = $('.attach-upload-input')
				const otherDocs = $('.other-docs-input');
				target.on('change',function(event){
					const current = $(this)
					const file = event.target.files[0]
					const reader = new FileReader();
					reader.onload = function(event) {
						const imgWrapper = $('<div />',{
							class:'attach-uploaded-img',
						})

						const img = $('<img />',{
							src:event.target.result,
							style: 'height:300px;aspect-ratio:3/5;object-fit:contain;'
						})
						current.parent().prev().html('')
						imgWrapper.append(img)
						current.parent().prev().append(imgWrapper)
					};

					reader.readAsDataURL(file);
				})

				otherDocs.on('change',function(event){
					const files = event.target.files;
					$('.other-docs-list').html()
					Object.entries(files)?.forEach(([index,file]) =>{
						const reader = new FileReader();
						console.log(file,'files')
						reader.onload =  function(event){
							const list = $('<li/>')
							const fileLink = $('<a />',{
								href:'#',
								target:"_blank",
								text:file?.name
							})
							list.append(fileLink);
							$('.other-docs-list').append(list)
						}
						reader.readAsDataURL(file);

					})
					
				})
			}

			this.init = function(){
				_this.fetchCountryListener()
				_this.fileChangeListener()
				_this.maritalStatusListener()
				_this.positionChangeListener()
				_this.attachmentListener()
				
			}

		} 
		let initialObj = new Initial();
		initialObj.init();
	})();


</script>
@endpush