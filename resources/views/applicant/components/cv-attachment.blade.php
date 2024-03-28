@php
$isDownload = isset($_GET['type']) && $_GET['type'] == 'download' ? true : false 
@endphp
<div style="page-break-before: always;display: block;">
	<h2 style="font-size:16px;font-weight:700;">Attachments</h2>
	<div style="display:block;margin-top:20px;">
		<div>
			<div style="padding:10px;text-align:center;">
				<img src="{{$isDownload == true ? public_path($passport->image) :asset($passport->image)}}" style="width:{{$isDownload ? '400px' : '100%'}};height:400px;object-fit: contain;">
			</div>
		</div>
	</div>

</div>
<div style="page-break-before: always;display: block;">
	@if(isset($applicant->attachments['full_body_img']) && !empty($applicant->attachments['full_body_img']))
	<div>
		<div style="padding:10px;text-align:center;">
			<img src="{{$isDownload == true ? public_path($applicant->attachments['full_body_img']) : asset($applicant->attachments['full_body_img'])}}" style="width:{{$isDownload ? '400px' : '100%'}};height:400px;object-fit: contain;aspect-ratio: 3 / 5;">
		</div>
	</div>
	@endif
</div>
<div style="page-break-before: always;display: block;">
	@if(isset($applicant->attachments['full_body_img']) && !empty($applicant->attachments['full_body_img']))
	<div>
		<div style="padding:10px;text-align:center;">
			<img src="{{$isDownload == true ? public_path($applicant->attachments['full_body_img']) : asset($applicant->attachments['full_body_img'])}}" style="width:{{$isDownload ? '400px' : '100%'}};height:400px;object-fit: contain;aspect-ratio: 3 / 5;">
		</div>
	</div>
	@endif
</div>


@if(isset($applicant->attachments['others']) && !empty($applicant->attachments['others']))
<div style="page-break-before: always;display: block;">
	<div>
		<div style="padding:10px;text-align:center;">
			@foreach($applicant->attachments['others'] as $other)
			<img src="{{$isDownload == true ? public_path($other) : asset($other)}}" style="width:{{$isDownload ? '400px' : '100%'}};height:400px;object-fit: contain;margin-bottom:20px;aspect-ratio: 3 / 5;">
			@endforeach
		</div>
	</div>
</div>
@endif

