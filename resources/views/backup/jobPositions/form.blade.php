@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{ isset($editData) ? route('admin.jobPosition.update', $editData->id) : route('admin.jobPosition.store') }}" method="post">
    @csrf
    @if(isset($editData))
    @method('PUT')
    @endif
    <div class="flex-row justify-space-between">
      <div class="form-group">
        <div class="form-wrapper upload-passport-input-items">
          <div class="form-group group-column">
            <label>Select Job Position:</label>
            <select name="title" class="select-grey-bg">
              <option value="" disabled selected>Select Job Position</option>
              <option value="Domestic Worker" {{ isset($editData) && $editData->title == 'Domestic Worker' ? 'selected' : '' }}>Domestic Worker</option>
              <option value="House Keeping" {{ isset($editData) && $editData->title == 'House Keeping' ? 'selected' : '' }}>House Keeping</option>
              <option value="Sales person" {{ isset($editData) && $editData->title == 'Sales person' ? 'selected' : '' }}>Sales person</option>
              <option value="Cleaner" {{ isset($editData) && $editData->title == 'Cleaner' ? 'selected' : '' }}>Cleaner</option>
            </select>

            @error('title')
            <span class="validation-error">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group group-column">
            <label for="">Description:</label>
            <div class="form-group group-row">
              <label for="male">Male</label>
              <input type="radio" id="male" class="form-radio" value="Male" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Male') checked @endif>

              <label for="female">Female</label>
              <input type="radio" class="form-radio" id="female" value="Female" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Female') checked @endif>
            </div>
            @error('isDescription')
            <span class="validation-error">{{$message}}</span>
            @enderror
          </div>

          <div class="button-wrap">
            <button type="submit" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} Job Position</button>
          </div>
        </div>
      </div>
    </div>
</div>
</form>
</div>
@endsection