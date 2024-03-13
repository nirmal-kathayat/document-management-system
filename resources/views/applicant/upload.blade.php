@extends('layouts.default')
@section('title','Upload Passport')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
	<form>
		<div class="flex-row justify-space-between">
			<div class="upload-passport-wrapper">
				<div class="form-group">
					<label>Scan Passport & upload</label>
				</div>
				<div class="upload-passport-img-wrapper white-bg"></div>
			</div>
			<div class="upload-password-form-wrapper ">
				<div class="form-wrapper upload-passport-input-items">
					<div class="grid-row template-repeat-3 col-gap-30">
						<div class="form-group group-column">
							<label>Type</label>
							<input type="text" name="type" class="bg-white">
						</div>
						<div class="form-group group-column">
							<label>Country Code</label>
							<input type="text" name="country_code" class="bg-white">
						</div>
						<div class="form-group group-column">
							<label>Passport No</label>
							<input type="number" name="passport_no" class="bg-white">
						</div>
					</div>
					<div class="form-group group-column">
						<label>Surname</label>
						<input type="text" name="surname" class="bg-white">
					</div>
					<div class="form-group group-column">
						<label>Given Name</label>
						<input type="text" name="name" class="bg-white">
					</div>
					<div class="form-group group-column">
						<label>Nationality</label>
						<input type="text" name="nationality" class="bg-white">
					</div>
					<div class="grid-row template-repeat-3 col-gap-20">
						<div class="form-group group-column">
							<label>Dob</label>
							<input type="date" name="dob" class="bg-white">
						</div>
						<div class="form-group group-column">
							<label>Date of Issue</label>
							<input type="date" name="issue_date" class="bg-white">
						</div>
						<div class="form-group group-column">
							<label>Expiry Date</label>
							<input type="datge" name="expiry_date" class="bg-white">
						</div>
					</div>
					<div class="grid-row template-repeat-2 col-gap-20">
						<div class="form-group group-column">
							<label>Sex</label>
							<input type="text" name="dob" class="bg-white">
						</div>
						<div class="form-group group-column">
							<label>Place of Birth</label>
							<input type="text" name="birth_place" class="bg-white">
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection