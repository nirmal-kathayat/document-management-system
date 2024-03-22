@php
use Carbon\Carbon;
$age = isset($passport) ? Carbon::createFromFormat('Y-m-d', $passport->dob)->diffInYears(Carbon::now()) : '';
@endphp
<div>
	<h1 style="font-size:28px;font-weight:800;text-align:center">CURRICULUM - VITAE</h1>
	<ul style="margin-top:30px;display: flex;flex-direction:column;width:100%;list-style:none">
		@if(strtolower($applicant->country_name) =='romania')
			<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;"><span style="width:20%;font-weight: 600;">Last Name:</span><span style="font-weight: 600;">{{$passport->last_name}}</span></li>
			<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">First Name:</span><span style="font-weight: 600;">{{$passport->first_name}}</span></li>
		@else
			<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Name:</span><span style="font-weight: 600;">{{$passport->first_name}} {{$passport->last_name}}</span></li>
		@endif
		@if(strtolower($applicant->country_name)=='romania')
			<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Place of Birth:</span><span style="font-weight: 600;">{{ucfirst(strtolower($passport->district))}}</span></li>
		@else
			<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Age:</span><span style="font-weight: 600;">{{$age}}</span></li>
		@endif
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Date of Birth:</span><span style="font-weight: 600;">{{Carbon::parse($passport->dob)->format('d M Y')}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Father Name:</span><span style="font-weight: 600;">{{$applicant->personal_details['father_name'] ?? ''}}</span></li>
		
		@if(strtolower($applicant->country_name) =='romania')
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Mother Name:</span><span style="font-weight: 600;">{{$applicant->personal_details['mother_name'] ?? ''}}</span></li>
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Citizenship:</span><span style="font-weight: 600;">Nepal</span></li>
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Nationality:</span><span style="font-weight: 600;">{{$passport->nationality}}</span></li>
		@else
			@if(isset($applicant->personal_details['marital_status']) && !empty($applicant->personal_details['marital_status']))
				<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Marital Status:</span><span style="font-weight: 600;">{{$applicant->personal_details['marital_status'] ?? ''}}</span></li>
			@endif
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Nationality:</span><span style="font-weight: 600;">{{$passport->nationality}}</span></li>
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Permanent Address:</span><span style="font-weight: 600;">{{$passport->district ?? ''}}</span></li>
			<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Language:</span><span style="font-weight: 600;">{{isset($applicant->educations['english_level']) && ($applicant->educations['english_level'] !== 'Poor' || $applicant->educations['english_level'] !== 'Very Poor' ) ? 'English' : ''}}{{isset($applicant->educations['other_languages']) ? ', '.$applicant->educations['other_languages'] : '' }}</span></li>
			@if(isset($applicant->personal_details['religion']) && !empty($applicant->personal_details['religion']))
				<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Religion:</span><span style="font-weight: 600;">{{$applicant->personal_details['religion']}}</span></li>
			@endif
			@if(isset($applicant->personal_details['height']) && !empty($applicant->personal_details['height']))
				<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Height:</span><span style="font-weight: 600;">{{$applicant->personal_details['height']}} M</span></li>
			@endif
			@if(isset($applicant->personal_details['weight']) && !empty($applicant->personal_details['weight']))
				<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Weight:</span><span style="font-weight: 600;">{{$applicant->personal_details['weight']}} KG</span></li>
			@endif
			@if(isset($applicant->personal_details['cell_no']) && !empty($applicant->personal_details['cell_no']))
				<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Contact No:</span><span style="font-weight: 600;">{{$applicant->personal_details['cell_no']}}</span></li>
			@endif
		@endif
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Passport No:</span><span style="font-weight: 600;">{{$passport->passport_no}}</span></li>
		@if(strtolower($applicant->country_name) =='romania')
		<li style="margin-bottom:15px;width:100%;">
			<div style="width:50%; float: left;">
				<span style="font-weight:600;color:#000;font-size: 14px;width:39%;">Issue Date:</span>
				<span style="font-weight:600;color:#000;font-size: 14px;">{{$passport->issued_date}}</span>
			</div>
			<div style="width:50%; float: left;">
				<span style="font-weight:600;color:#000;font-size: 14px;;width:39%;">Expiry Date:</span>
				<span style="font-weight:600;color:#000;font-size: 14px;">{{$passport->expiry_date}}</span>
			</div>
			<div style="clear:both;"></div>
		</li>
		@endif
		@if(strtolower($applicant->country_name) =='romania')
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Address:</span><span style="font-weight: 600;">{{$applicant->personal_details['temporary_address'] ?? ''}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:15px"><span style="width:20%;font-weight: 600;">Marital Status:</span><span style="font-weight: 600;">{{$applicant->personal_details['marital_status'] ?? ''}}</span></li>
		@endif
	</ul>
	@if(strtolower($applicant->country_name) =='romania')
		@include('applicant.components.cv-education',['title' => 'Studies/Qualifications'])
		@include('applicant.components.cv-experience',['title' => 'Previous Employers/Positions Held'])

	@else
		@include('applicant.components.cv-experience',['title' => 'Job Experiences'])
		@include('applicant.components.cv-education',['title' => 'Education'])

	@endif
	@include('applicant.components.cv-attachment')
</div>