@extends('layouts.default')
@section('title','Upload Passport')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
	<form action="{{route('admin.passport.create')}}" method="post" class="form-data" enctype="multipart/form-data">
		@csrf
		<div class="flex-row justify-space-between">
			<div class="upload-passport-wrapper">
				<div class="form-group group-column">
					<label>Scan Passport & upload</label>
					<input type="file" name="image" class="d-none validation-control" id="passport-file-input" data-validation="required" accept="image/*">

				</div>
				<label class="upload-passport-img-wrapper white-bg drop-zone" id="drop-zone" for="passport-file-input">
					<div class="upload-passport-info">
						<i class="fa fa-upload"></i>
					</div>
				</label>
			</div>
			<div class="upload-password-form-wrapper ">
				<div class="form-wrapper upload-passport-input-items">
					<div class="grid-row template-repeat-3 col-gap-30">
						<div class="form-group group-column">
							<label>Type</label>
							<input type="text" name="type" class="bg-white validation-control" data-validation="required">
						</div>
						<div class="form-group group-column">
							<label>Country Code</label>
							<input type="text" name="country_code" class="bg-white validation-control" data-validation="required">
						</div>
						<div class="form-group group-column">
							<label>Passport No</label>
							<input type="text" name="passport_no" class="bg-white validation-control" data-validation="required">
						</div>
					</div>
					<div class="form-group group-column">
						<label>Surname</label>
						<input type="text" name="last_name" class="bg-white validation-control" data-validation="required">
					</div>
					<div class="form-group group-column">
						<label>Given Name</label>
						<input type="text" name="first_name" class="bg-white validation-control" data-validation="required">
					</div>
					<div class="form-group group-column">
						<label>Nationality</label>
						<input type="text" name="nationality" class="bg-white validation-control" data-validation="required">
					</div>
					<div class="grid-row template-repeat-3 col-gap-20">
						<div class="form-group group-column">
							<label>Dob</label>
							<input type="date" name="dob" class="bg-white validation-control" data-validation="required">
						</div>
						<div class="form-group group-column">
							<label>Date of Issue</label>
							<input type="date" name="issued_date" class="bg-white validation-control" data-validation="required">
						</div>
						<div class="form-group group-column">
							<label>Expiry Date</label>
							<input type="date" name="expiry_date" class="bg-white validation-control" data-validation="required">
						</div>
					</div>
					<div class="grid-row template-repeat-2 col-gap-20">
						<div class="form-group group-column">
							<label>Sex</label>
							<select class="validation-control" data-validation="required" name="gender">
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="form-group group-column">
							<label>Place of Birth</label>
							<select class="validation-control" data-validation="required" name="district">
								<option value="">Select</option>
								@foreach(getDistricts() as $district)
								<option value="{{strtoupper($district)}}">{{$district}}</option>
								@endforeach
							</select>
						</div>
						
					</div>
					<div class="form-group flex-end">
						<button type="submit" class="primary-btn">Submit</button>
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
			this.formattingImgContent = function(text){

			};
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
							$('input[name=type]').val(result?.type)

							if(!!result?.district){
								$('select[name=district]').val(result?.district)
							}
							if(!!result?.surname){
								$('input[name=last_name]').val(result?.surname)
							}
							if(!!result?.name){
								$('input[name=first_name]').val(result?.name)
							}
							if(!!result?.passport_no){
								$('input[name=passport_no]').val(result?.passport_no)
							}
							if(!!result?.dob){
								$('input[name=dob]').val(result?.dob)
							}
							if(!!result?.gender){
								$('select[name=gender]').val(result?.gender)

							}
							if(!!result?.expiry_date){
								$('input[name=expiry_date]').val(result?.expiry_date)
							}

							if(!!result?.issued_date){
								$('input[name=issued_date]').val(result?.issued_date)
							}
							$('input[name=country_code]').val(result?.country_code)
							$('input[name=nationality]').val(result?.nationality)

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