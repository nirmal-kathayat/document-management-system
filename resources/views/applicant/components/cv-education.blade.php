@if(isset($applicant->educations['backgrounds'][0]) && !empty($applicant->educations['backgrounds'][0]['title']))
<h2 style="font-size:16px;font-weight:700;">{{$title}}</h2>
@foreach($applicant->educations['backgrounds'] as $background)
@if(!empty($background['title']))
<ul style="display: flex;flex-direction:column;width:100%;list-style:none;margin-top:15px;">
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Organization:</span><span style="font-weight: 600;">{{$background['organization']}}</span>
	</li>
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Degree:</span><span style="font-weight: 600;">{{$background['title']}}</span>
	</li>
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Period:</span><span style="font-weight: 600;">{{$background['duration']}} Yrs</span>
	</li>
</ul>
@endif
@endforeach	
@endif