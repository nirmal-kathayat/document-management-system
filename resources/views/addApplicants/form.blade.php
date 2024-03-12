@extends('layouts.default')
@section('title','Job Application -Step 1')
@section('content')
<section class="inner-section">
  <div class="container">
    <form>
      <div class="application-wrapper">
        <div class="application-form-wrapper">
          <div class="application-select-option">
            <div class="form-group column">
              <label>Select Continent</label>
              <select name="" id="" class="select-grey-bg">
                <option value="continent">Europe</option>
                <option value="continent">Asia</option>
                <option value="continent">Australia</option>
                <option value="continent">Africa</option>
              </select>
            </div>
            <div class="form-group column">
              <label>Select Continent</label>
              <select name="" id="" class="select-grey-bg">
                <option value="country">Cyprus</option>
                <option value="country">Maldives</option>
                <option value="country">Nepal</option>
                <option value="country">South Africa</option>
              </select>
            </div>
          </div>
        </div>
        <div class="application-upload-wrapper"></div>
      </div>
    </form>
  </div>
</section>

@endsection