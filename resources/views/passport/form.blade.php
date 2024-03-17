@extends('layouts.default')
@section('title',isset($passport) ? 'Update Upload Passport' : 'Upload Passport')
@php
	$url = isset($passport) ? route('admin.passport.edit',['id' => $passport->id]) : route('admin.passport.create');
@endphp
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
	<form action="{{$url}}" method="post" class="form-data" enctype="multipart/form-data">
		@csrf
		@if(isset($passport))
			@method('PUT')
		@endif
		<div class="flex-row justify-space-between">
			<div class="upload-passport-wrapper">
				<div class="form-group group-column">
					<label>Scan Passport & upload <span class="text-red">*</span></label>
					<input type="file" name="image" class="d-none validation-control" id="passport-file-input" data-validation="{{isset($passport) ? '' : 'required'}}" accept="image/*">
					@error('image')
						<p class="validation-error">{{$message}}</p>
					@enderror
				</div>
				<label class="upload-passport-img-wrapper white-bg drop-zone" id="drop-zone" for="passport-file-input">
					@if(isset($passport) && !empty($passport->image))
					<div class="uploaded-img">
						<img src="{{asset('uploaded/passports/'.$passport->image)}}">
					</div>
					@else
					<div class="upload-passport-info">
						<i class="fa fa-upload"></i>
					</div>
					@endif
					
				</label>
			</div>
			<div class="upload-password-form-wrapper ">
				<div class="form-wrapper upload-passport-input-items">
					<div class="grid-row template-repeat-3 col-gap-30">
						<div class="form-group group-column">
							<label>Type <span class="text-red">*</span></label>
							<input type="text" name="type" class="bg-white validation-control" data-validation="required" value="{{old('type',$passport->type ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Country Code <span class="text-red">*</span></label>
							<input type="text" name="country_code" class="bg-white validation-control" data-validation="required" value="{{old('country_code',$passport->country_code ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Passport No <span class="text-red">*</span></label>
							<input type="text" name="passport_no" class="bg-white validation-control" data-validation="required" value="{{old('passport_no',$passport->passport_no ?? '')}}">
							@error('passport_no')
							<p class="validation-error">{{$message}}</p>
							@enderror
						</div>
					</div>
					<div class="form-group group-column">
						<label>Surname <span class="text-red">*</span></label>
						<input type="text" name="last_name" class="bg-white validation-control" data-validation="required" value="{{old('last_name',$passport->last_name ?? '')}}">
					</div>
					<div class="form-group group-column">
						<label>Given Name <span class="text-red">*</span></label>
						<input type="text" name="first_name" class="bg-white validation-control" data-validation="required" value="{{old('first_name',$passport->first_name ?? '')}}">
					</div>
					<div class="form-group group-column">
						<label>Nationality <span class="text-red">*</span></label>
						<input type="text" name="nationality" class="bg-white validation-control" data-validation="required" value="{{old('nationality',$passport->nationality ?? '')}}">
					</div>
					<div class="grid-row template-repeat-3 col-gap-20">
						<div class="form-group group-column">
							<label>DOB <span class="text-red">*</span></label>
							<input type="date" name="dob" class="bg-white validation-control" data-validation="required" value="{{old('dob',$passport->dob ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Issued Date <span class="text-red">*</span></label>
							<input type="date" name="issued_date" class="bg-white validation-control" data-validation="required" value="{{old('issued_date',$passport->issued_date ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Expiry Date <span class="text-red">*</span></label>
							<input type="date" name="expiry_date" class="bg-white validation-control" data-validation="required" value="{{old('expiry_date',$passport->expiry_date ?? '')}}">
						</div>
					</div>
					<div class="grid-row template-repeat-2 col-gap-20">
						<div class="form-group group-column">
							<label>Sex <span class="text-red">*</span></label>
							<select class="validation-control" data-validation="required" name="gender" >
								<option value="">Select</option>
								@foreach(getGender() as $gender)
									<option value="{{$gender}}" {{isset($passport) ? $gender == $passport->gender ? 'selected' : '' : ''}}>{{$gender}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group group-column">
							<label>Place of Birth <span class="text-red">*</span></label>
							<select class="validation-control" data-validation="required" name="district">
								<option value="">Select</option>
								@foreach(getDistricts() as $district)
								<option value="{{strtoupper($district)}}" {{isset($passport) ? strtoupper($district) == $passport->district ? 'selected' : '' : ''}}>{{$district}}</option>
								@endforeach
							</select>
						</div>
						
					</div>
					<div class="form-group flex-end">
						<button type="submit" class="primary-btn">{{isset($passport) ? 'Update' : 'Next'}}</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@include('components.progress-loader')
@endsection
@push('js')
@include('scripts.validation')
<script src="https://cdn.jsdelivr.net/npm/tesseract.js"></script>
<script type="text/javascript" src="{{asset('js/mrz.js')}}"></script>
<script>
	(function() {
		function Initial() {
			let _this = this;
			this.makeInputEmpty = function(){
				$('select[name=district]').val("")
				$('input[name=last_name]').val("")
				$('input[name=first_name]').val("")
				$('input[name=passport_no]').val("")
				$('input[name=country_code]').val("")
				$('input[name=nationality]').val("")
				$('input[name=type]').val("")
				$('input[name=dob]').val("")
				$('input[name=expiry_date]').val("")
				$('input[name=issued_date]').val("")
				$('select[name=gender]').val("")
			}

			this.fileInputListener = function() {
				const dropZone = $('#drop-zone')
				const fileInput = $('#passport-file-input')
				function handleFile(files){
					const file = files[0]
					const reader = new FileReader();
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
						dropZone.append(imgWrapper)
					};

					reader.readAsDataURL(file);
					$('.progress-loader-wrapper').fadeIn()
					_this.makeInputEmpty()
					Tesseract.recognize(
						file,
						'eng',
						{ logger: m => {
							if((m?.progress || 0) * 100 <= 100 && m?.status === 'initializing tesseract'){
								$('.progress-bg').css('width', (m?.progress || 0) * 100 + '%');
								$('.progress-bg').css('background', 'var(--primary)');
							}

						} }
						).then(({ data: { text } }) => {
							const MRZData = new MRZ(text)
							const result = MRZData.result
							$('input[name=type]').val(result?.type).trigger('input')

							if(!!result?.district){
								$('select[name=district]').val(result?.district).trigger('change')
							}
							if(!!result?.surname){
								$('input[name=last_name]').val(result?.surname).trigger('input')
							}
							if(!!result?.name){
								$('input[name=first_name]').val(result?.name).trigger('input')
							}
							if(!!result?.passport_no){
								$('input[name=passport_no]').val(result?.passport_no).trigger('input')
							}
							if(!!result?.dob){
								$('input[name=dob]').val(result?.dob).trigger('input')
							}
							if(!!result?.gender){
								$('select[name=gender]').val(result?.gender).trigger('change')
							}
							if(!!result?.expiry_date){
								$('input[name=expiry_date]').val(result?.expiry_date).trigger('input')
							}

							if(!!result?.issued_date){
								$('input[name=issued_date]').val(result?.issued_date).trigger('input')
							}
							$('input[name=country_code]').val(result?.country_code).trigger('input')
							$('input[name=nationality]').val(result?.nationality).trigger('input')

							$('.progress-loader-wrapper').fadeOut();
							$('.progress-bg').css('width','0%');


						}).catch(err => {
							console.error('Error during OCR:', err);
							$('.progress-loader-wrapper').fadeOut();
							$('.progress-bg').css('width','0%');

						});

					}
					dropZone.on('dragover',function(e){
						e.preventDefault()
						dropZone.addClass('dragged-over')
					})
					dropZone.on('dragleave',function(e){
						dropZone.removeClass('dragged-over')
					})
					dropZone.on('drop',function(e){
						e.preventDefault()
						dropZone.removeClass('dragged-over')
						handleFile(e.originalEvent.dataTransfer.files)
					})

					fileInput.on('change',function(e){
						handleFile(e.target.files)
					})
				};	
				this.init = function() {
					_this.fileInputListener();
				};
			}
			let initialObj = new Initial();
			initialObj.init();
		})();
	</script>
	@endpush