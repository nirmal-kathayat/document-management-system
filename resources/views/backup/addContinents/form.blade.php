@extends('layouts.default')
@section('title','Job Application')
@section('content')
<form action="{{ isset($editData) ? route('admin.continent.update', $editData->id) : route('admin.continent.store') }}" method="post">
  @csrf
  @if(isset($editData))
    @method('PUT')
  @endif
  <div class="application-form-wrapper">
    <div class="application-select-option">
      <div class="form-group column">
        <label>Select Continent</label>
        <select name="title" class="select-grey-bg">
          <option value="" disabled selected>Select continent
          </option>
          <option value="Europe" {{ isset($editData) && $editData->title == 'Europe' ? 'selected' : '' }}>Europe</option>
          <option value="Asia" {{ isset($editData) && $editData->title == 'Asia' ? 'selected' : '' }}>Asia</option>
          <option value="Australia" {{ isset($editData) && $editData->title == 'Australia' ? 'selected' : '' }}>Australia</option>
          <option value="Africa" {{ isset($editData) && $editData->title == 'Africa' ? 'selected' : '' }}>Africa</option>
        </select>

        @error('title')
        <span class="error-message">
          {{$message}}
        </span>
        @enderror

        <div class="button-wrap">
          <button type="submit" id="submit-button" class="btn-add">{{isset($editData) ? 'Update' : 'Add'}} continent </button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection