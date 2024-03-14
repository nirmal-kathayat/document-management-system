@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{route('admin.country.store')}}" method="post">
    @csrf


    <div class="form-wrapper">
      <div class="form-group group-column">
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
        <span class="validation-error">
          {{$message}}
        </span>
        @enderror
      </div>

      <div class="form-group group-column">
        <label for="">Country Title:</label>
        <input type="text" name="title" value="{{isset($editData) ? $editData->title: ''}}">

        @error('title')
        <span class="validation-error">
          {{$message}}
        </span>
        @enderror
      </div>
      <div class="form-input group-column button-wrap">
        <button type="submit" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} country </button>
      </div>
    </div>

  </form>
</div>
@endsection