@extends('layouts.default')
@section('title','Job Application')
@section('content')
<form action="{{ isset($editData) ? route('admin.jobPosition.update', $editData->id) : route('admin.jobPosition.store') }}" method="post">
  @csrf
  @if(isset($editData))
    @method('PUT')
  @endif
  <div class="application-form-wrapper">
    <div class="application-select-option">
      <div class="form-group column">
        <label>Select Job Position:</label>
        <select name="title" class="select-grey-bg">
          <option value="" disabled selected>Select Job Position</option>
          <option value="Domestic Worker" {{ isset($editData) && $editData->title == 'Domestic Worker' ? 'selected' : '' }}>Domestic Worker</option>
          <option value="House Keeping" {{ isset($editData) && $editData->title == 'House Keeping' ? 'selected' : '' }}>House Keeping</option>
          <option value="Sales person" {{ isset($editData) && $editData->title == 'Sales person' ? 'selected' : '' }}>Sales person</option>
          <option value="Cleaner" {{ isset($editData) && $editData->title == 'Cleaner' ? 'selected' : '' }}>Cleaner</option>
        </select>

        @error('title')
        <span class="error-message">{{$message}}</span>
        @enderror
      </div>

      <div class="gender-wrap">
        <label for="">Description:</label>
        <div class="radio">
          <label for="male">Male</label>
          <input type="radio" id="male" value="Male" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Male') checked @endif>

          <label for="female">Female</label>
          <input type="radio" id="female" value="Female" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Female') checked @endif>
        </div>
        @error('isDescription')
        <span class="error-message">{{$message}}</span>
        @enderror
      </div>
    </div>
    <div class="btns-wrap">
      <button type="submit" id="submit-button" class="job-add">{{isset($editData) ? 'Update' : 'Add'}} Job Position</button>
    </div>
  </div>
</form>
@endsection
