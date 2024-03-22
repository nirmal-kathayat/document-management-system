@php
	use Carbon\Carbon;
	$age = isset($passport) ? Carbon::createFromFormat('Y-m-d', $passport->dob)->diffInYears(Carbon::now()) : '';
@endphp
<div class="step-one">
	<div class="grid-row template-repeat-3 col-gap-20">
		<div class="form-group group-column">
			<label>
				Select Continent <span class="text-red">*</span>
			</label>
			<select name="continent_id" class="validation-control grey-bg "  data-validation="required" >
				<option value="">Select Continent</option>
				@foreach($continents as $continent)
				<option value="{{$continent->id}}" {{isset($applicant) && $applicant->continent_id == $continent->id ? 'selected' : ''}}>{{$continent->title}}</option>
				@endforeach
			</select>	
		</div>
		<div class="form-group group-column">
			<label>
				Select Country <span class="text-red">*</span>
			</label>
			<select name="country_id" class="validation-control grey-bg" data-validation="required" data-selected = "{{$applicant->country_id ?? ''}}">
				<option value="">Select Country</option>
			</select>	
		</div>
		<div class="form-group group-column">
			<label>
				Select Position <span class="text-red">*</span>
			</label>
			<select name="job_position_id" class="validation-control grey-bg" data-validation="required">
				<option value="">Select Position</option>
				@foreach($positions as $position)
				<option value="{{$position->id}}" {{isset($applicant) && $applicant->job_position_id == $position->id ? 'selected' : ''}}>{{$position->title}}</option>
				@endforeach
			</select>	
		</div>
	</div>
	<div class="flex-row justify-space-between">
		<div class="left-form-wrapper">
			<div class="grey-bg form-one details-form-block">
				<div class="form-section-title">
					<h4>Passport Details <span class="text-red">*</span></h4>
				</div>
				<div class="step-form-wrapper form-wrapper">
					<div class="grid-row template-repeat-3 col-gap-30">
						<div class="form-group group-column">
							<label>Type <span class="text-red">*</span></label>
							<input type="text" name="passport_details[type]" class="validation-control" data-validation="required" value="{{old('passport_details[type]',$passport->type ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Country Code <span class="text-red">*</span></label>
							<input type="text" name="passport_details[country_code]" class="validation-control" data-validation="required" value="{{old('passport_details[country_code]',$passport->country_code ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Passport No <span class="text-red">*</span></label>
							<input type="text" name="passport_details[passport_no]"  class="validation-control" data-validation="required"  value="{{old('passport_details[passport_no]',$passport->passport_no ?? '')}}">
						</div>
					</div>
					<div class="form-group group-row align-center">
						<label>Surname <span class="text-red">*</span></label>
						<input type="text" name="passport_details[last_name]"  class="validation-control" data-validation="required" value="{{old('passport_details[last_name]',$passport->last_name ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Given Names <span class="text-red">*</span></label>
						<input type="text" name="passport_details[first_name]"  class="validation-control" data-validation="required" value="{{old('passport_details[first_name]',$passport->first_name ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Nationality <span class="text-red">*</span></label>
						<input type="text" name="passport_details[nationality]"  class="validation-control" data-validation="required" value="{{old('passport_details[nationality]',$passport->nationality ?? '')}}">
					</div>
					<div class="grid-row template-repeat-3 col-gap-30">
						<div class="form-group group-column">
							<label>DOB <span class="text-red">*</span></label>
							<input type="date" name="passport_details[dob]"  class="validation-control" data-validation="required" value="{{old('passport_details[dob]',$passport->dob ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Issued Date <span class="text-red">*</span></label>
							<input type="date" name="passport_details[issued_date]"  class="validation-control" data-validation="required" value="{{old('passport_details[issued_date]',$passport->issued_date ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Expiry Date <span class="text-red">*</span></label>
							<input type="date" name="passport_details[expiry_date]"  class="validation-control" data-validation="required" value="{{old('passport_details[expiry_date]',$passport->expiry_date ?? '')}}">
						</div>
					</div>
					<div class="grid-row template-repeat-2 col-gap-30">
						<div class="form-group group-column">
							<label>Sex <span class="text-red">*</span></label>
							<select  name="passport_details[gender]" class="validation-control" data-validation="required">
								<option value="">Select Gender</option>
								@foreach(getGender() as $gender)
								<option value="{{$gender}}" {{isset($passport) ? $gender == $passport->gender ? 'selected' : '' : ''}}>{{$gender}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group group-column">
							<label>Birth Place <span class="text-red">*</span></label>
							<select  name="passport_details[district]" class="validation-control" data-validation="required">
								<option value="">Select Birth Place</option>
								@foreach(getDistricts() as $district)
								<option value="{{strtoupper($district)}}" {{isset($passport) ? strtoupper($district) == $passport->district ? 'selected' : '' : ''}}>{{$district}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="grey-bg form-two details-form-block">
				<div class="form-section-title">
					<h4>Personal Details <span class="text-red">*</span></h4>
				</div>
				<div class="step-form-wrapper form-wrapper">
					<div class="grid-row template-repeat-3 col-gap-30 row-gap-20">
						<div class="form-group group-column">
							<label>Age <span class="text-red">*</span></label>
							<input type="number" name="personal_details[age]" class="validation-control" data-validation="required" value="{{old('personal_details[age]',$applicant->personal_details['age'] ?? $age)}}">
						</div>
						<div class="form-group group-column">
							<label>Home No</label>
							<input type="text" name="personal_details[home_no]"   value="{{old('personal_details[home_no]',$applicant->personal_details['home_no'] ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Cell No <span class="text-red">*</span></label>
							<input type="number" name="personal_details[cell_no]" class="validation-control" data-validation="required"   value="{{old('personal_details[cell_no]',$applicant->personal_details['cell_no'] ?? '')}}">
						</div>
						<div class="form-group group-column">
							<label>Marital Status <span class="text-red">*</span></label>
							<select id="marital-select" name="personal_details[marital_status]" class="validation-control" data-validation="required" >
								<option value="">Select Marital Status</option>
								@foreach(getMaritalStatus() as $status)
								<option value="{{$status}}" {{isset($applicant) && $applicant?->personal_details['marital_status'] == $status ? 'selected' : ''}}>{{$status}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group group-column">
							<label>Height <span class="text-red">*</span> (In Meter)</label>
							<input type="text" name="personal_details[height]"  value="{{old('personal_details[height]',$applicant->personal_details['height'] ?? '')}}" class="validation-control" data-validation="required"  >
						</div>
						<div class="form-group group-column">
							<label>Weight <span class="text-red">*</span> (In Kg)</label>
							<input type="text" name="personal_details[weight]"  value="{{old('personal_details[weight]',$applicant->personal_details['weight'] ?? '')}}" class="validation-control" data-validation="required" >
						</div>

					</div>
					
					<div class="form-group group-row align-center">
						<label>Father Name <span class="text-red">*</span></label>
						<input type="text" name="personal_details[father_name]" class="validation-control" data-validation="required"  value="{{old('personal_details[father_name]',$applicant->personal_details['father_name'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Mother Name <span class="text-red">*</span></label>
						<input type="text" name="personal_details[mother_name]" class="validation-control" data-validation="required"  value="{{old('personal_details[mother_name]',$applicant->personal_details['mother_name'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Temporary Address <span class="text-red">*</span></label>
						<input type="text" name="personal_details[temporary_address]" class="validation-control" data-validation="required"  value="{{old('personal_details[temporary_address]',$applicant->personal_details['temporary_address'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Permanent Address <span class="text-red">*</span></label>
						<input type="text" name="personal_details[permanent_address]" class="validation-control" data-validation="required"
						value="{{old('personal_details[permanent_address]',$applicant->personal_details['permanent_address'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Religion <span class="text-red">*</span></label>
						<input type="text" name="personal_details[religion]" class="validation-control" data-validation="required"  value="{{old('personal_details[religion]',$applicant->personal_details['religion'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Email</label>
						<input type="email" name="personal_details[email]" value="{{old('personal_details[email]',$applicant->personal_details['email'] ?? '')}}">
					</div>
				</div>
			</div>
			<div class="grey-bg form-two details-form-block family-form">
				<div class="form-section-title">
					<h4>Family Details <span class="text-red">*</span></h4>
				</div>
				<div class="step-form-wrapper form-wrapper">
					<div class="form-group group-row align-center">
						<label>Spouse Name</label>
						<input type="text" name="family_details[spouse_name]" value="{{old('family_details[spouse_name]',$applicant->family_details['spouse_name'] ?? '')}}">
					</div>
					
					<div class="form-group group-row align-center">
						<label>Age</label>
						<input type="number" name="family_details[age]" value="{{old('family_details[age]',$applicant->family_details['age'] ?? '')}}">

					</div>
					<div class="form-group group-row align-center">
						<label>Occupation</label>
						<input type="text" name="family_details[occupation]" value="{{old('family_details[occupation]',$applicant->family_details['occupation'] ?? '')}}">
					</div>
					<div class="form-group group-row align-center">
						<label>Gender</label>
						<select name="family_details[gender]">
							<option value="">Select Gender</option>
							@foreach(getGender() as $gender)
								<option value="{{$gender}}" {{isset($applicant) ? $gender == $applicant->family_details['gender'] ? 'selected' : '' : ''}}>{{$gender}}</option>
							@endforeach
						</select>

					</div>
					<div class="form-group group-row align-center">
						<label>No of Children</label>
						<input type="number" name="family_details[no_of_children]" value="{{old('family_details[no_of_children]',$applicant->family_details['no_of_children'] ?? '')}}">
					</div>
					
					<div class="form-group group-column">
						<label>Who will care for your children during your employment abroad?</label>
						<input type="text" name="family_details[care]" value="{{old('family_details[care]',$applicant->family_details['care'] ?? '')}}">
					</div>
				</div>
			</div>
		</div>
		<div class="right-form-wrapper">
			<div class="form-wrapper">
				<div class="grey-bg upload-img-preview">
					@if(isset($applicant) && isset($applicant->attachments['profile_img']))
						<div class="uploaded-img">
							<img src="{{asset($applicant->attachments['profile_img'])}}">
						</div>
					@else
					<div class="default-img">
						<i class="fa fa-user"></i>
					</div>
					@endif
					
				</div>
				<div class="form-group group-column">
					<input type="file" name="attachments[profile_img]" class="d-none" accept="image/*"  id="profile-input">
					<div class="flex-row justify-center">
						<label for="profile-input" class="profile-btn">
							Upload Photo
						</label>
					</div>
				</div>
				<div class="form-group group-column">
					<label>Referred By <span class="text-red">*</span></label>
					<input type="text" name="referred_by" class="grey-bg validation-control" value="{{old('referred_by',$applicant->referred_by ?? '')}}" data-validation="required">

				</div>
				<div class="form-group group-column">
					<label>Contact No <span class="text-red">*</span></label>
					<input type="number" name="contact_no" class="validation-control grey-bg" data-validation="required" value="{{old('contact_no',$applicant->contact_no ?? '')}}">
				</div>
			</div>
		</div>

	</div>
</div>