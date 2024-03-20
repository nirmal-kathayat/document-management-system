@extends('layouts.default')
@section('title',isset($country) ? 'Update Country' : 'Add Country')
@php
  $url = isset($country) ? route('admin.country.update',['id' => $country->id]) : route('admin.country.store');
@endphp
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
  <form action="{{$url}}" method="post" class="form-data">
    @csrf
    @if(isset($country))
      @method('PUT')
    @endif
    <div class="form-wrapper">
      <div class="form-group group-row align-center">
        <label>Continents</label>
        <select name="continent_id" class="select-grey-bg validation-control" data-validation="required" >
          <option value="" selected>Select Continent
          </option>

          @foreach ($continents as $continent)
          <option value="{{ $continent->id }}" {{ isset($country) && $country->continent_id == $continent->id ? 'selected' : '' }}>
            {{ $continent->title }}
          </option>
          @endforeach
        </select>

        @error('continent_id')
        <p class="validation-error">
          {{$message}}
        </p>
        @enderror
      </div>

      <div class="form-group group-row align-center">
        <label for="">Title</label>
        <input type="text" name="title" value="{{isset($country) ? $country->title: ''}}" class="validation-control" data-validation="required">

        @error('title')
        <p class="validation-error">
          {{$message}}
        </p>
        @enderror
      </div>
      <div class="form-group flex-end">
        <button type="submit" class="primary-btn">{{isset($country) ? 'Update' : 'Add'}} country </button>
      </div>
    </div>

  </form>
</div>
@endsection

@push('js')
  @include('scripts.validation')
@endpush