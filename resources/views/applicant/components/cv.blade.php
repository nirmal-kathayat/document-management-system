@php
use Carbon\Carbon;
@endphp
<div>
	<h1 style="font-size:28px;font-weight:800;text-align:center">CURRICULUM - VITAE</h1>
	<ul style="margin-top:30px;display: flex;flex-direction:column;width:100%;list-style:none">
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;"><span style="width:20%;font-weight: 600;">Last Name:</span><span style="font-weight: 600;">{{$passport->last_name}}</span></li>
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">First Name:</span><span style="font-weight: 600;">{{$passport->first_name}}</span></li>
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Place of Birth:</span><span style="font-weight: 600;">{{ucfirst(strtolower($passport->district))}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Date of Birth:</span><span style="font-weight: 600;">{{Carbon::parse($passport->dob)->format('d M Y')}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Father Name:</span><span style="font-weight: 600;">{{$applicant->personal_details['father_name'] ?? ''}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Mother Name:</span><span style="font-weight: 600;">{{$applicant->personal_details['mother_name'] ?? ''}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Citizenship:</span><span style="font-weight: 600;">Nepal</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Nationality:</span><span style="font-weight: 600;">{{$passport->nationality}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Passport No:</span><span style="font-weight: 600;">{{$passport->passport_no}}</span></li>
		<li style="margin-bottom:20px;width:100%;">
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
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Address:</span><span style="font-weight: 600;">{{$applicant->personal_details['temporary_address'] ?? ''}}</span></li>
		<li style="display:flex;color:#000;font-size: 14px;margin-bottom:20px"><span style="width:20%;font-weight: 600;">Marital Status:</span><span style="font-weight: 600;">{{$applicant->personal_details['marital_status'] ?? ''}}</span></li>
	</ul>
	@if(isset($applicant->educations['backgrounds'][0]) && !empty($applicant->educations['backgrounds'][0]['title']))
	<h2 style="font-size:18px;font-weight:700;margin:15px 0px;">Studies/Qualification</h2>
	@foreach($applicant->educations['backgrounds'] as $background)
	@if(!empty($background['title']))
	<ul style="display: flex;flex-direction:column;width:100%;list-style:none;margin-bottom:15px;">
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
			<span style="width:20%;font-weight: 600;">Organization:</span><span style="font-weight: 600;">{{$background['organization']}}</span>
		</li>
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
			<span style="width:20%;font-weight: 600;">Degree:</span><span style="font-weight: 600;">{{$background['title']}}</span>
		</li>
		<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
			<span style="width:20%;font-weight: 600;">Period:</span><span style="font-weight: 600;">{{$background['duration']}} Yrs</span>
		</li>
	</ul>
	@endif
	@endforeach	
	@endif
	@if(isset($applicant->experiences['professionals'][0]) && !empty($applicant->experiences['professionals'][0]['position']))
		<h2 style="font-size:18px;font-weight:700;margin:15px 0px;">Previous Employers/Position Held</h2>
		@foreach($applicant->experiences['professionals'] as $experience)
			@if(!empty($experience['position']))
			<ul style="display: flex;flex-direction:column;width:100%;list-style:none;margin-bottom:15px;">
				<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
					<span style="width:20%;font-weight: 600;">Positon:</span><span style="font-weight: 600;">{{$experience['position']}}</span>
				</li>
				<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
					<span style="width:20%;font-weight: 600;">Country:</span><span style="font-weight: 600;">{{$experience['country']}}</span>
				</li>
				<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
					<span style="width:20%;font-weight: 600;">Duration:</span><span style="font-weight: 600;">{{$experience['duration']}}</span>
				</li>
				@if(!empty($experience['comment']))
				<li style="display:flex;color:#000;font-size:14px;margin-bottom:20px;">
					<span style="width:20%;font-weight: 600;">Description:</span><span style="font-weight: 600;">{{$experience['comment']}}</span>
				</li>
				@endif
			</ul>
			@endif
		@endforeach
	@endif
</div>