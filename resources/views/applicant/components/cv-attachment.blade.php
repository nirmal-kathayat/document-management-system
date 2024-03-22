@php
	$isDownload = isset($_GET['type']) && $_GET['type'] == 'download' ? true : false 
@endphp
<div style="page-break-before: always;display: block;">
	<h2 style="font-size:16px;font-weight:700;">Attachments</h2>
	<div style="display:block;margin-top:20px;">
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Passport</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($passport->image) :asset($passport->image)}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@if(isset($applicant->attachments['education_1']) && !empty($applicant->attachments['education_1']))
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Education 1</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['education_1']) : asset($applicant->attachments['education_1'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		@if(isset($applicant->attachments['full_body_img']) && !empty($applicant->attachments['full_body_img']))
		<div style="width:31%;background:#fafafa;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Education 1</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['full_body_img']) : asset($applicant->attachments['full_body_img'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		<div style="clear:both;"></div>
	</div>
	<div style="display:block;margin-top:20px;">
		@if(isset($applicant->attachments['education_2']) && !empty($applicant->attachments['education_2']))
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Education 2</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['education_2']) : asset($applicant->attachments['education_2'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		@if(isset($applicant->attachments['education_3']) && !empty($applicant->attachments['education_3']))
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Education 3</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['education_3']) : asset($applicant->attachments['education_3'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		@if(isset($applicant->attachments['training_1']) && !empty($applicant->attachments['training_1']))
		<div style="width:31%;background:#fafafa;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Training 1</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['training_1']) : asset($applicant->attachments['training_1'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		<div style="clear:both;"></div>

	</div>
	<div style="display:block;margin-top:20px;">
		@if(isset($applicant->attachments['training_2']) && !empty($applicant->attachments['training_2']))
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Training 2</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['training_2']) : asset($applicant->attachments['training_2'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		@if(isset($applicant->attachments['other_img']) && !empty($applicant->attachments['other_img']))
		<div style="width:31%;background:#fafafa;margin-right:2%;float:left;">
			<h5 style="background:#01ACF1;padding:5px 10px;color:#fff;font-size: 14px;font-weight:700;margin:0px">Other</h5>
			<div style="background:#f5f5f5;padding:10px">
				<img src="{{$isDownload == true ? public_path($applicant->attachments['other_img']) : asset($applicant->attachments['other_img'])}}" style="width:100%;height:300px;object-fit: contain;">
			</div>
		</div>
		@endif
		<div style="clear:both;"></div>

	</div>	
</div>
