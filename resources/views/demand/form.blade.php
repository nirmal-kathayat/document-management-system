@extends('layouts.default')
@section('title',isset($demand) ? 'Update Demand' : 'Add Demand')
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
  <form action="{{ isset($demand) ? route('admin.demand.update', $demand->id) : route('admin.demand.store') }}" method="post" class="form-data">
    @csrf
    @if(isset($demand))
    @method('PUT')
    @endif

        <div class="form-wrapper">
          <div class="form-group group-row align-center">
            <label for="">Date:</label>
            <input type="date" name="date" value="{{isset($demand) ? $demand->date: ''}}" class="validation-control" data-validation="required">
           
            @error('date')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row align-center">
            <label for="">Position</label>
            <select name="job_position_id" class="validation-control" data-validation="required">
              <option value="">Select</option>
              @foreach($positions as $position)
                <option value="{{$position->id}}">{{$position->title}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group group-row align-center">
            <label for="">Salary</label>
            <input type="number" name="salary" value="{{isset($demand) ? $demand->salary: ''}}" class="validation-control" data-validation="required">
          
            @error('salary')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row align-center">
            <label for="">Experience</label>
            <select name="experience_id" class="validation-control" data-validation="required">

              <option value="" selected>Select Experience</option>
              @foreach($experiences as $experience)
              <option value="{{ $experience->id }}" {{ isset($demand) && $demand->experience_id == $experience->id ? 'selected' : '' }}>
                {{ $experience->experience }}
              </option>
              @endforeach
            </select>

            @error('experience_id')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row align-center">
            <label for="">Country</label>
            <select name="country_id" class="validation-control" data-validation="required">
                <option value = "">Select Country</option>
                @foreach($countries as $country)
                  <option value="{{$country->id}}" {{ isset($demand) && $demand->country_id == $country->id ? 'selected' : '' }}>{{$country->title}}</option>
                @endforeach
            </select>
           
            @error('country_id')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" rows="4" cols="50" class="validation-control" data-validation="required"></textarea>
          </div>

          <div class="form-group flex-end">
            <button type="submit" class="primary-btn" id="submit-button">{{isset($demand) ? 'Update' : 'Add'}} Demand </button>
          </div>
        </div>
  </form>
</div>
@endsection

@push('js')
@include('scripts.validation')

@endpush