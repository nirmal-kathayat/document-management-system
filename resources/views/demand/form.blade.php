@extends('layouts.default')
@section('title','Add Demand')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{ isset($editData) ? route('admin.demand.update', $editData->id) : route('admin.demand.store') }}" method="post" class="form-data">
    @csrf
    @if(isset($editData))
    @method('PUT')
    @endif

    <div class="form-wrapper demand-form">
      <div class="form-group group-row">
        <label for="">Date:</label>
        <input type="date" name="date" value="{{isset($editData) ? $editData->date: ''}}" class="validation-control" data-validation="required">
      </div>

      <div class="form-group group-row">
        <label for="">Demand Name:</label>
        <input type="text" name="demand_name" value="{{isset($editData) ? $editData->demand_name: ''}}" class="validation-control" data-validation="required">
      </div>

      <div class="form-group group-row">
        <label for="">Salary:</label>
        <input type="number" name="salary" value="{{isset($editData) ? $editData->salary: ''}}" class="validation-control" data-validation="required">
      </div>

      <div class="form-group group-row">
        <label for="">Experience:</label>
        <select name="experience" id="" class=" validation-control"
        data-validation="required">

          <option value="" disabled selected>Select Experience</option>
          @foreach($experiences as $id => $experience)
          <option value="{{ $id }}" {{ isset($editData) && $editData->experience == $id ? 'selected' : '' }}>
            {{ $experience }}
          </option>
          @endforeach
        </select>
      </div>

      <div class="form-group group-row">
        <label for="">Country:</label>
        <select name="country" id="" class=" validation-control" data-validation="required">
          <option value="" disabled selected>Select Country
          </option>
          <option value="Nepal" {{ isset($editData) && $editData->country == 'Nepal' ? 'selected' : '' }}>Nepal</option>
          <option value="China" {{ isset($editData) && $editData->country == 'China' ? 'selected' : '' }}>China</option>
          <option value="Hongkong" {{ isset($editData) && $editData->country == 'Hongkong' ? 'selected' : '' }}>Hongkong</option>
          <option value="India" {{ isset($editData) && $editData->country == 'India' ? 'selected' : '' }}>India</option>
        </select>
      </div>

      <div class="form-group group-row">
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
      </div>

      <div class="form-group group-column flex-end">
        <button type="submit" class="demand-btn" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} Demand </button>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
@include('scripts.validation')
@endpush