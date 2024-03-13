@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{ isset($editData) ? route('admin.continent.update', $editData->id) : route('admin.continent.store') }}" method="post">
    @csrf
    @if(isset($editData))
    @method('PUT')
    @endif
    <div class="flex-row justify-space-between">
      <div class="application-select-option">
        <div class="form-group group-column">
          <label>Select Continent:</label>
          <select name="title" class="select-grey-bg">
            <option value="" disabled selected>Select continent
            </option>
            <option value="Europe" {{ isset($editData) && $editData->title == 'Europe' ? 'selected' : '' }}>Europe</option>
            <option value="Asia" {{ isset($editData) && $editData->title == 'Asia' ? 'selected' : '' }}>Asia</option>
            <option value="Australia" {{ isset($editData) && $editData->title == 'Australia' ? 'selected' : '' }}>Australia</option>
            <option value="Africa" {{ isset($editData) && $editData->title == 'Africa' ? 'selected' : '' }}>Africa</option>
          </select>

          @error('title')
          <span class="validation-error">
            {{$message}}
          </span>
          @enderror

          <div class="button-wrap">
            <button type="submit" id="submit-button">{{isset($editData) ? 'Update' : 'Add'}} continent </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection