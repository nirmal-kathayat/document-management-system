<div class="step-four" style="margin-top:15px;">
	<div class="flex-row justify-space-between">
		<div class="grid-row template-repeat-2 col-gap-20 row-gap-10" style="width:67%">
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
					<h4>Education 1  <span class="text-red">*</span></h4>
				</div>
				<div style="padding:20px;">
					<div class="white-bg attachment-preview">
						@if(isset($applicant) && isset($applicant->attachments['education_1']))
						<div class="attach-uploaded-img">
							<img src="{{asset($applicant->attachments['education_1'])}}">
						</div>
						@endif
					</div>
					@if(!isset($info))
					<div class="attach-upload-btn-wrapper">
						<input type="file" name="attachments[education_1]" class="d-none attach-upload-input" id="education_1" accept="image/*">
						<label for="education_1" class="attach-upload-label">Upload</label>
						
					</div>
					@endif
				</div>
			</div>
			<div class="grey-bg">
				<div class="attachment-title">
					<h4>Education 2</h4>
				</div>
				<div style="padding:20px;">
					<div class="white-bg attachment-preview">
						@if(isset($applicant) && isset($applicant->attachments['education_2']))
						<div class="attach-uploaded-img">
							<img src="{{asset($applicant->attachments['education_2'])}}">
						</div>
						@endif
					</div>
					@if(!isset($info))
					<div class="attach-upload-btn-wrapper">
						<input type="file" name="attachments[education_2]" class="d-none attach-upload-input" id="education_2" accept="image/*">
						<label for="education_2" class="attach-upload-label">Upload</label>
						
					</div>
					@endif
				</div>
			</div>
			<div class="grey-bg">
				<div class="attachment-title">
					<h4>Education 3</h4>
				</div>
				<div style="padding:20px;">
					<div class="white-bg attachment-preview">
						@if(isset($applicant) && isset($applicant->attachments['education_3']))
						<div class="attach-uploaded-img">
							<img src="{{asset($applicant->attachments['education_3'])}}">
						</div>
						@endif
					</div>
					@if(!isset($info))
					<div class="attach-upload-btn-wrapper">
						<input type="file" name="attachments[education_3]" class="d-none attach-upload-input" id="education_3" accept="image/*">
						<label for="education_3" class="attach-upload-label">Upload</label>
						
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="grey-bg" style="width:30%">
			<div class="attachment-title">
				<h4>Full Body Photo <span class="text-red">*</span></h4>
			</div>
			<div style="padding:20px;">
				<div class="white-bg attachment-preview-full">
					@if(isset($applicant) && isset($applicant->attachments['full_body_img']))
					<div class="attach-uploaded-img ">
						<img src="{{asset($applicant->attachments['full_body_img'])}}" style="height:700px;aspect-ratio:3/5;object-fit:contain;">
					</div>
					@endif
				</div>
				@if(!isset($info))
				<div class="attach-upload-btn-wrapper">
					<input type="file" name="attachments[full_body_img]" class="d-none attach-upload-input full_body" id="full_body_img" accept="image/*">
					<label for="full_body_img" class="attach-upload-label">Upload</label>

				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="grid-row template-repeat-3 col-gap-20 row-gap-10" style="margin-top: 10px">
		<div class="grey-bg">
			<div class="attachment-title">
				<h4>Training 1</h4>
			</div>
			<div style="padding:20px;">
				<div class="white-bg attachment-preview">
					@if(isset($applicant) && isset($applicant->attachments['training_1']))
					<div class="attach-uploaded-img">
						<img src="{{asset($applicant->attachments['training_1'])}}">
					</div>
					@endif
				</div>
				@if(!isset($info))
				<div class="attach-upload-btn-wrapper">
					<input type="file" name="attachments[training_1]" class="d-none attach-upload-input" id="training_1" accept="image/*">
					<label for="training_1" class="attach-upload-label">Upload</label>

				</div>
				@endif
			</div>
		</div>
		<div class="grey-bg">
			<div class="attachment-title">
				<h4>Training 2</h4>
			</div>
			<div style="padding:20px;">
				<div class="white-bg attachment-preview">
					@if(isset($applicant) && isset($applicant->attachments['training_2']))
					<div class="attach-uploaded-img">
						<img src="{{asset($applicant->attachments['training_2'])}}">
					</div>
					@endif
				</div>
				@if(!isset($info))
				<div class="attach-upload-btn-wrapper">
					<input type="file" name="attachments[training_2]" class="d-none attach-upload-input" id="training_2" accept="image/*">
					<label for="training_2" class="attach-upload-label">Upload</label>
					
				</div>
				@endif
			</div>
		</div>
		<div class="grey-bg">
			<div class="attachment-title">
				<h4>Others</h4>
			</div>
			<div style="padding:20px;">
				<div class="white-bg attachment-preview">
					@if(isset($applicant) && isset($applicant->attachments['other_img']))
					<div class="attach-uploaded-img">
						<img src="{{asset($applicant->attachments['other_img'])}}">
					</div>
					@endif
				</div>
				@if(!isset($info))
				<div class="attach-upload-btn-wrapper">
					<input type="file" name="attachments[other_img]" class="d-none attach-upload-input" id="other_img" accept="image/*">
					<label for="other_img" class="attach-upload-label">Upload</label>
					
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="form-group group-row video-section">
		<p>Video Link</p>
		<input type="url" name="attachments[video_link]">
	</div>
</div>