@extends('layouts.default')
@section('title','Add Demand')
@section('content')
<form action="{{ isset($editData) ? route('admin.demand.update', $editData->id) : route('admin.demand.store') }}" method="post">
  @csrf
  @if(isset($editData))
  @method('PUT')
  @endif
  <div class="form-container">
    <div class="form-inputs">
      <div class="form-input-1">
        <label for="">Date:</label>
        <input type="date" name="date" value="{{isset($editData) ? $editData->date: ''}}">
        <br>
        @error('date')
        <span class="error-messages">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-input-2">
        <label for="">Demand Name:</label>
        <input type="text" name="demand_name" value="{{isset($editData) ? $editData->demand_name: ''}}">
        @error('demand_name')
        <span class="error-messages">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-input-3">
        <label for="">Salary:</label>
        <input type="number" name="salary" value="{{isset($editData) ? $editData->salary: ''}}">
        <br>
        @error('salary')
        <span class="error-messages">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-input-4">
        <label for="">Experience:</label>
        <select name="experience" id="">

          <option value="" disabled selected>Select Experience</option>
          @foreach($experiences as $id => $experience)
          <option value="{{ $id }}" {{ isset($editData) && $editData->experience == $id ? 'selected' : '' }}>
            {{ $experience }}
          </option>
          @endforeach
        </select>
        <br>
        @error('experience')
        <span class="error-messages">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-input-5">
        <label for="">Country:</label>
        <select name="country" id="">
          <option value="" disabled selected>Select Country
          </option>
          <option value="Nepal" {{ isset($editData) && $editData->country == 'Nepal' ? 'selected' : '' }}>Nepal</option>
          <option value="China" {{ isset($editData) && $editData->country == 'China' ? 'selected' : '' }}>China</option>
          <option value="Hongkong" {{ isset($editData) && $editData->country == 'Hongkong' ? 'selected' : '' }}>Hongkong</option>
          <option value="India" {{ isset($editData) && $editData->country == 'India' ? 'selected' : '' }}>India</option>
        </select>
        <br>
        @error('country')
        <span class="error-messages">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-input-6">
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
      </div>

      <div class="btn-demand">
      <button type="submit" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} Demand </button>
      </div>
    </div>
  </div>
</form>
@endsection