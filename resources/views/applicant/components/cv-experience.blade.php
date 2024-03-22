@if(isset($applicant->experiences['professionals'][0]) && !empty($applicant->experiences['professionals'][0]['position']))
<h2 style="font-size:16px;font-weight:700;">{{$title}}</h2>
@foreach($applicant->experiences['professionals'] as $experience)
@if(!empty($experience['position']))
<ul style="display: flex;flex-direction:column;width:100%;list-style:none;margin-top:15px;">
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Positon:</span><span style="font-weight: 600;">{{$experience['position']}}</span>
	</li>
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Country:</span><span style="font-weight: 600;">{{$experience['country']}}</span>
	</li>
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Duration:</span><span style="font-weight: 600;">{{$experience['duration']}}</span>
	</li>
	@if(!empty($experience['comment']))
	<li style="display:flex;color:#000;font-size:14px;margin-bottom:15px;">
		<span style="width:20%;font-weight: 600;">Description:</span><span style="font-weight: 600;">{{$experience['comment']}}</span>
	</li>
	@endif
</ul>
@endif
@endforeach
@endif