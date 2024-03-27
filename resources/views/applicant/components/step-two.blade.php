
<div class="step-two" style="margin-top:15px">
	<div class="grey-bg details-form-block" data-index="0">
		<div class="form-section-title">
			<h4>Professional Experience</h4>
		</div>
		<div class="form-section-sub-title">
			<h5>Experience 1 <span class="text-red">*</span></h5>
		</div>
		<div class="form-wrapper" style="padding:0px 15px;">
			<div class="grid-row template-repeat-3 col-gap-20">
				<div class="form-group group-column">
					<label>Country <span class="text-red">*</span></label>
					<input type="text" name="experiences[professionals][0][country]" class="validation-control" data-validation="required" value="{{old('experiences[professionals][0][country]',$applicant->experiences['professionals'][0]['country'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Job Position <span class="text-red">*</span></label>
					<input type="text" name="experiences[professionals][0][position]" class="validation-control" data-validation="required" value="{{old('experiences[professionals][0][country]',$applicant->experiences['professionals'][0]['position'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Duration <span class="text-red">*</span></label>
					<select name="experiences[professionals][0][duration]" class="validation-control" data-validation="required">
						<option value="">Select Duration</option>
						@foreach($experiences as $experience)
							<option value="{{$experience->experience}}" {{isset($applicant) && isset($applicant->experiences['professionals'][0]) && $applicant->experiences['professionals'][0]['duration'] == $experience->experience ? 'selected' : '' }}>{{$experience->experience}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-section-sub-title">
			<h5>Comment</h5>
		</div>
		<div class="form-wrapper" style="padding:0px 15px;padding-bottom:20px">
			<div class="form-group group-column">
				<textarea name="experiences[professionals][0][comment]">{{ $applicant->experiences['professionals'][0]['comment'] ?? ''}}</textarea>
			</div>
			
		</div>
	</div>

	<div class="grey-bg details-form-block" data-index="1" style="margin-top:15px">
		<div class="form-section-sub-title">
			<h5>Experience 2</h5>
		</div>
		<div class="form-wrapper" style="padding:0px 15px;">
			<div class="grid-row template-repeat-3 col-gap-20">
				<div class="form-group group-column">
					<label>Country</label>
					<input type="text" name="experiences[professionals][1][country]" value="{{old('experiences[professionals][0][country]',$applicant->experiences['professionals'][1]['country'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Job Position</label>
					<input type="text" name="experiences[professionals][1][position]" value="{{old('experiences[professionals][0][country]',$applicant->experiences['professionals'][1]['position'] ?? '')}}" >
				</div>
				<div class="form-group group-column">
					<label>Duration</label>
					<select name="experiences[professionals][1][duration]">
						<option value="">Select Duration</option>
						@foreach($experiences as $experience)
							<option value="{{$experience->experience}}" {{isset($applicant) && isset($applicant->experiences['professionals'][1]) && $applicant->experiences['professionals'][1]['duration'] == $experience->experience ? 'selected' : '' }}>{{$experience->experience}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-section-sub-title">
			<h5>Comment</h5>
		</div>
		<div class="form-wrapper" style="padding:0px 15px;padding-bottom:20px">
			<div class="form-group group-column">
				<textarea name="experiences[professionals][1][comment]">{{ $applicant->experiences['professionals'][1]['comment'] ?? ''}}</textarea>
			</div>
			
		</div>
	</div>

	<div class="grey-bg details-form-block" style="margin-top:15px"  data-index="0">
		<div class="form-section-title" style="margin-bottom:20px">
			<h4>Other Employment Background</h4>
		</div>
		<div class="form-wrapper" style="padding:0px 15px;padding-bottom:20px">
			<div class="grid-row template-repeat-3 col-gap-20">
				<div class="form-group group-column">
					<label>Job Position</label>
					<input type="text" name="experiences[others][0][position]"  value="{{old('experiences[others][0][position]',$applicant->experiences['others'][0]['position'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Country</label>
					<input type="text" name="experiences[others][0][country]"  value="{{old('experiences[others][0][country]',$applicant->experiences['others'][0]['country'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Period</label>
					<select name="experiences[others][0][duration]">
						<option value="">Select Period</option>
						@foreach($experiences as $experience)
							<option value="{{$experience->experience}}"  {{isset($applicant) && isset($applicant->experiences['professionals'][0]) && $applicant->experiences['others'][0]['duration'] == $experience->experience ? 'selected' : '' }}>{{$experience->experience}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="grey-bg details-form-block" style="margin-top:10px;padding-top:20px;"  data-index="1">
		<div class="form-wrapper" style="padding:0px 15px;padding-bottom:20px">
			<div class="grid-row template-repeat-3 col-gap-20">
				<div class="form-group group-column">
					<label>Job Position</label>
					<input type="text" name="experiences[others][1][position]" value="{{old('experiences[others][1][position]',$applicant->experiences['others'][1]['position'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Country</label>
					<input type="text" name="experiences[others][1][country]" value="{{old('experiences[others][1][country]',$applicant->experiences['others'][1]['country'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Period</label>
					<select name="experiences[others][1][duration]">
						<option value="">Select Period</option>
						@foreach($experiences as $experience)
							<option value="{{$experience->experience}}" {{isset($applicant) && isset($applicant->experiences['professionals'][1]) && $applicant->experiences['others'][1]['duration'] == $experience->experience ? 'selected' : '' }}>{{$experience->experience}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="grey-bg details-form-block" style="margin-top:10px;padding-top:20px;"  data-index="2">
		<div class="form-wrapper" style="padding:0px 15px;padding-bottom:20px">
			<div class="grid-row template-repeat-3 col-gap-20">
				<div class="form-group group-column">
					<label>Job Position</label>
					<input type="text" name="experiences[others][2][position]" value="{{old('experiences[others][2][position]',$applicant->experiences['others'][2]['position'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Country</label>
					<input type="text" name="experiences[others][2][country]" value="{{old('experiences[others][2][country]',$applicant->experiences['others'][2]['country'] ?? '')}}">
				</div>
				<div class="form-group group-column">
					<label>Period</label>
					<select name="experiences[others][2][duration]">
						<option value="">Select Period</option>
						@foreach($experiences as $experience)
							<option value="{{$experience->experience}}" {{isset($applicant) && isset($applicant->experiences['professionals'][2]) && $applicant->experiences['others'][2]['duration'] == $experience->experience ? 'selected' : '' }}>{{$experience->experience}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>