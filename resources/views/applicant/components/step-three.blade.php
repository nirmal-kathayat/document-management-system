<div class="step-three">
	<div class="grey-bg details-form-block" data-index="0" style="padding-bottom:20px">
		<div class="form-section-title">
			<h4>Education Background</h4>
		</div>
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-row col-gap-10 align-center">
				<label>Educational Organization  <span class="text-red">*</span></label>
				<input type="text" name="educations[backgrounds][0][organization]" class="validation-control" data-validation="required"
				value="{{old('educations[backgrounds][0][organization]',$applicant->educations['backgrounds'][0]['organization'] ?? '')}}">
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Title <span class="text-red">*</span></label>
				<input type="text" name="educations[backgrounds][0][title]" class="validation-control" data-validation="required" value="{{old('educations[backgrounds][0][title]',$applicant->educations['backgrounds'][0]['title'] ?? '')}}">
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Period <span class="text-red">*</span></label>
				<input type="text" name="educations[backgrounds][0][duration]" class="validation-control" data-validation="required"  value="{{old('educations[backgrounds][0][duration]',$applicant->educations['backgrounds'][0]['duration'] ?? '')}}">
			</div>
		</div>
	</div>
	<div class="grey-bg details-form-block" data-index="1" style="padding-bottom:20px;margin-top:15px;padding-top:10px">
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-row col-gap-10 align-center">
				<label>Educational Organization</label>
				<input type="text" name="educations[backgrounds][1][organization]" value="{{old('educations[backgrounds][1][organization]',$applicant->educations['backgrounds'][1]['organization'] ?? '')}}">
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Title</label>
				<input type="text" name="educations[backgrounds][1][title]" value="{{old('educations[backgrounds][1][title]',$applicant->educations['backgrounds'][1]['title'] ?? '')}}">
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Period</label>
				<input type="text" name="educations[backgrounds][1][duration]" value="{{old('educations[backgrounds][1][duration]',$applicant->educations['backgrounds'][1]['duration'] ?? '')}}">
			</div>
		</div>
	</div>

	<div class="grey-bg details-form-block" data-index="2" style="padding-bottom:20px;margin-top:15px;padding-top:10px">
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-row col-gap-10 align-center">
				<label>Educational Organization</label>
				<input type="text" name="educations[backgrounds][2][organization]"
				value="{{old('educations[backgrounds][2][organization]',$applicant->educations['backgrounds'][2]['organization'] ?? '')}}">
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Title</label>
				<input type="text" name="educations[backgrounds][2][title]" value="{{old('educations[backgrounds][2][title]',$applicant->educations['backgrounds'][2]['title'] ?? '')}}" >
			</div>
			<div class="form-group group-row col-gap-10 align-center">
				<label>Period</label>
				<input type="text" name="educations[backgrounds][2][duration]" value="{{old('educations[backgrounds][2][duration]',$applicant->educations['backgrounds'][2]['duration'] ?? '')}}">
			</div>
		</div>
	</div>
	<div class="grey-bg details-form-block" style="padding-bottom:20px;margin-top:15px;padding-top:10px">
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-row col-gap-10 align-center">
				<label>Other Certificates</label>
				<input type="text" name="educations[backgrounds][2][organization]"
				value="{{old('educations[other_certificate]',$applicant->educations['other_certificate'] ?? '')}}">
			</div>
		</div>
	</div>

	<div class="grey-bg details-form-block" style="padding-bottom:20px;margin-top:15px;padding-top:10px">
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-column col-gap-10">
				<label>English Language Level</label>
				<div class="flex-row flex-wrap col-gap-10 row-gap-10 justify-space-between" style="width:100%">
					@foreach(englishLevels() as $level)
					<div class="form-group group-row align-center col-gap-10">
						<label style="width:auto;">{{$level}}</label>
						<input type="radio" name="educations[english_level]" value="{{$level}}" style="width:25px;height:25px;border:0px"  {{isset($applicant) && isset($applicant->educations["english_level"]) && $applicant->educations['english_level'] == $level  ? 'checked' : ''}}>
					</div>
					@endforeach
				</div>
			</div>
			<div class="form-group group-column">
				<label>Other Languages</label>
				<input type="text" name="educations[other_languages]" value="{{old('educations[other_languages]',$applicant->educations['other_languages'] ?? '')}}">
			</div>
		</div>
	</div>

	<div class="grey-bg details-form-block" style="padding-bottom:20px;margin-top:15px;padding-top:10px">
		<div class="form-wrapper education-form-wrapper" style="padding:0px 15px;margin-top:15px">
			<div class="form-group group-column">
				<label>Have you attended the Apps Group Training Schema? If yes select</label>
				<div class="flex-row col-gap-20 row-gap-20">
					<div class="form-group group-row  align-center col-gap-10">
						<label style="width:auto;">Housekeeping</label>
						<input type="checkbox" name="educations[apps_trainings][]" value="Housekeeping" style="width:25px;height:25px;border:0px"  {{ isset($applicant) && isset($applicant->educations['apps_trainings']) && in_array('Housekeeping', $applicant->educations['apps_trainings']) ? 'checked' : '' }}>
					</div>
					<div class="form-group group-row  align-center col-gap-10">
						<label style="width:auto;">Caregiving</label>
						<input type="checkbox" name="educations[apps_trainings][]" value="Caregiving" style="width:25px;height:25px;border:0px" {{isset($applicant) && isset($applicant->educations['apps_trainings']) && in_array('Caregiving',$applicant->educations['apps_trainings']) ? 'checked' : '' }}>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="grey-bg details-form-block" style="margin-top:15px">
		<div class="form-section-title">
			<h4>Personal Question</h4>
		</div>
		<div class="form-wrapper" style="padding:15px 15px;">
			<div class="flex-row justify-space-between">
				<div style="width:60%">
					<div class="form-wrapper">
						<div class="form-group group-row justify-space-between">
							<label></label>
							<div class="form-group group-row col-gap-10">
								<label style="text-align:center">Yes&nbsp;</label>
								<label style="text-align:center">No&nbsp;</label>
							</div>
						</div>
						@foreach(getPersonalQuestions() as $key=>$question)
						<div class="form-group group-row justify-space-between">
							<label>{{$question}}</label>
							<div class="form-group group-row col-gap-10">
								<input type="radio" value="Yes" name="personal_checklist[personal_questions][{{$key}}]" style="width:25px;height:25px;border:0px" {{isset($applicant) && isset($applicant->personal_checklist['personal_questions']) && $applicant->personal_checklist['personal_questions'][$key] ==='Yes' ? 'checked' : '' }}>
								<input type="radio" value="No" name="personal_checklist[personal_questions][{{$key}}]" style="width:25px;height:25px;border:0px" {{isset($applicant) && isset($applicant->personal_checklist['personal_questions']) && $applicant->personal_checklist['personal_questions'][$key] ==='No' ? 'checked' : '' }}>

							</div>
						</div>
						@endforeach
					</div>

				</div>
				<div style="width:37%">
					<div class="form-group group-column">
						<label>Is yes,please specify</label>
						<textarea name="personal_checklist[description]" style="height:100px">{{$applicant->personal_checklist['description'] ?? ''}}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(isset($selectedPosition) && count($selectedPosition->job_questions) > 0)
	<div class="grey-bg details-form-block" style="margin-top:15px">
		<div class="form-section-title">
			<h4>On-Job Question</h4>
		</div>
		<div style="padding:15px">
			<div class="grid-row col-gap-20 row-gap-20 template-repeat-3">
				@foreach($selectedPosition->job_questions as $key=>$question)
				<div class="form-group group-column">
					<label style="background:var(--white);padding:7px 15px;border-radius:4px;">{{$question['title']}}</label>
					<div class="form-group group-column">
						@foreach($question['items'] as $item)
						<div class="flex-row justify-space-between align-center" style="padding:0px 15px">
							<label>{{$item}}</label>
							<input type="checkbox" name="on_job_checklist[{{$question['title']}}][]" value="{{$item}}" style="width:25px;height:25px;border:0px"{{ isset($applicant) && isset($applicant['on_job_checklist'][$question['title']]) && in_array($item, $applicant['on_job_checklist'][$question['title']]) ? 'checked' : '' }}>
						</div>
						@endforeach 
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif
	
</div>