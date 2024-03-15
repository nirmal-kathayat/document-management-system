@extends('layouts.default')
@section('title',isset($editData) ? 'Update Job Position' : 'Add Job Position')
@php
$url = isset($editData) ? route('admin.jobPosition.update',['id' => $editData->id]) : route('admin.jobPosition.store');
@endphp
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
  <form action="{{$url}}" method="post" class="form-data">
    @csrf
    @if(isset($editData))
    @method('PUT')
    @endif
    <div class="form-wrapper">
      <div class="form-group group-row align-center">
        <label>Job Position:</label>
        <select name="title" class="select-grey-bg validation-control" data-validation="required">
          <option value="" selected>Select job position
          </option>
          <option value="Domestic Worker" {{ isset($editData) && $editData->title == 'Domestic Worker' ? 'selected' : '' }}>Domestic Worker</option>
          <option value="House Keeping" {{ isset($editData) && $editData->title == 'House Keeping' ? 'selected' : '' }}>House Keeping</option>
          <option value="Sales person" {{ isset($editData) && $editData->title == 'Sales person' ? 'selected' : '' }}>Sales person</option>
          <option value="Cleaner" {{ isset($editData) && $editData->title == 'Cleaner' ? 'selected' : '' }}>Cleaner</option>
        </select>

        @error('title')
        <p class="validation-error">
          {{$message}}
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="">Description:</label>
        <div class="form-group">
          <label for="male">Male</label>
          <input type="radio" class="form-radio" id="male" value="Male" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Male') checked @endif>

          <label for="female">Female</label>
          <input type="radio" id="female" class="form-radio" value="Female" name="isDescription" @if(isset($editData) && $editData->isDescription == 'Female') checked @endif>

        </div>
        @error('isDescription')
        <p class="validation-error">
          {{$message}}
        </p>
        @enderror
      </div>
      <div class="form-group flex-end">
        <button type="submit" class="primary-btn">{{isset($country) ? 'Update' : 'Add'}} Job Position </button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('js')
@include('scripts.validation')
@endpush