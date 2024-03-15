@extends('layouts.default')
@section('title',isset($demand) ? 'Update Demand' : 'Add Demand')
@section('content')
<<<<<<< HEAD
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{ isset($editData) ? route('admin.demand.update', $editData->id) : route('admin.demand.store') }}" method="post" class="form-data">
=======
<div class="inner-section-wrapper grey-bg country-form">
  <form action="{{ isset($demand) ? route('admin.demand.update', $demand->id) : route('admin.demand.store') }}" method="post" class="form-data">
>>>>>>> b222d5bbc6fcf2f08755ba2a13b61cbb0dc86edd
    @csrf
    @if(isset($demand))
    @method('PUT')
    @endif

<<<<<<< HEAD
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

      <div class="form-group flex-end">
        <button type="submit" class="primary-btn" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} Demand </button>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
@include('scripts.validation')
=======
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
            <label for="">Title:</label>
            <input type="text" name="title" value="{{isset($demand) ? $demand->title: ''}}" class="validation-control" data-validation="required">
            @error('title')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row align-center">
            <label for="">Salary:</label>
            <input type="number" name="salary" value="{{isset($demand) ? $demand->salary: ''}}" class="validation-control" data-validation="required">
          
            @error('salary')
            <span class="validation-error">
              {{$message}}
            </span>
            @enderror
          </div>

          <div class="form-group group-row align-center">
            <label for="">Experience:</label>
            <select name="experience_id" class="validation-control" data-validation="required">

              <option value="" selected>Select Experience</option>
              @foreach($experiences as $id => $experience)
              <option value="{{ $id }}" {{ isset($demand) && $demand->experience_id == $id ? 'selected' : '' }}>
                {{ $experience }}
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
            <label for="">Country:</label>
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
            <label for="comment">Comment:</label>
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

>>>>>>> b222d5bbc6fcf2f08755ba2a13b61cbb0dc86edd
@endpush