@extends('layouts.default')
@section('title','Job Application')
@section('content')
<form action="{{route('admin.country.store')}}" method="post">
  @csrf
  <div class="application-form-wrapper">
    <div class="application-select-option">
      <div class="form-group column">
        <label>Select Continents:</label>
        <select name="continent_id" class="select-grey-bg">
          <option value="" disabled selected>Select Continents
          </option>

          @foreach ($continentsList as $list => $continentList)
          <option value="{{ $list }}" {{ isset($editData) && $editData->continent_id == $list ? 'selected' : '' }}>
            {{ $continentList }}
          </option>
          @endforeach
        </select>

        @error('continent_id')
        <span class="error-message">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="country-wrap">
        <label for="">Country Title:</label>
        <input type="text" name="title" value="{{isset($editData) ? $editData->title: ''}}">

        @error('title')
        <span class="error-message">
          {{$message}}
        </span>
        @enderror
      </div>

    </div>
    <div class="btn-wrap">
      <button type="submit" id="submit-button" class="add-country">{{isset($editData) ? 'Update' : 'Add'}} continent </button>
    </div>
  </div>
</form>
@endsection