<div class="step-four" style="margin-top:15px;">
	<div class="flex-row justify-space-between">
		<div class="grid-row template-repeat-3 col-gap-20 row-gap-10" style="width:100%">
			<div class="grey-bg">
				<div class="attachment-title">
					<h4>Passport  <span class="text-red">*</span></h4>
				</div>
				<div style="padding:20px;">
					<div class="white-bg attachment-preview">
						@if(!empty($passport->image))
						<div class="attach-uploaded-img">
							<img src="{{asset($passport->image)}}">
						</div>
						@endif
					</div>
					@if(!isset($info))
					<div class="attach-upload-btn-wrapper">
						<input type="file" name="attachments[passport_img]" class="d-none attach-upload-input" id="passport_image" accept="image/*">
						<label for="passport_image" class="attach-upload-label">Upload</label>
						
					</div>
					@endif

				</div>
			</div>
			<div class="grey-bg">
				<div class="attachment-title">
					<h4>Full Body Photo <span class="text-red">*</span></h4>
				</div>
				<div style="padding:20px;">
					<div class="white-bg attachment-preview-full">
						@if(isset($applicant) && isset($applicant->attachments['full_body_img']))
						<div class="attach-uploaded-img ">
							<img src="{{asset($applicant->attachments['full_body_img'])}}" style="aspect-ratio:3/5;object-fit:contain;" >
						</div>
						@endif
					</div>
					@if(!isset($info))
					<div class="attach-upload-btn-wrapper">
						<input type="file" name="attachments[full_body_img]" class="d-none attach-upload-input full_body validation-control" id="full_body_img" accept="image/*" data-validation="{{empty($applicant->attachments['full_body_img']) || ! isset($applicant->attachments['full_body_img']) ? 'required' : ''}}" >
						<label for="full_body_img" class="attach-upload-label">Upload</label>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	@if(isset($applicant->attachments['others']) && count($applicant->attachments['others']) > 0)
	<ul class="uploaded-docs-list" style="margin-top:10px" >
		@foreach($applicant->attachments['others'] as $other)
		<li><a href="{{asset($other)}}" target="_blank">{{$other}}</a></li>
		@endforeach
	</ul>
	@endif
	<ul class="other-docs-list" style="margin-top:10px"></ul>
	@if(!isset($info))
	<div class="form-group group-row video-section">
		<p>Other Documents</p>
		
		
		<input type="file" name="attachments[others][]" class="other-docs-input"  accept="image/*" multiple>

		
	</div>
	@endif
</div>
@if(!isset($info))
<div class="form-group group-row video-section" style="margin-bottom:20px">
	<p>Video Link</p>
	<input type="url" name="attachments[video_link]">
</div>
@endif
</div>