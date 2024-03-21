@extends('layouts.default')
@section('title','Change Password')
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
  <form action="{{route('admin.changePassword.passwordChange')}}" method="post" class="form-data">
    @csrf
    <div class="form-wrapper">
      <div class="form-group group-column">
        <label for="">Current Password:</label>
        <input type="password" name="current_password" class="validation-control" data-validation="required">
      </div>

      <div class="form-group group-column">
        <label for="">New Password:</label>
        <input type="password" name="password" class="validation-control" data-validation="required">
      </div>

      <div class="form-group group-column">
        <label for="">Confirm Password:</label>
        <input type="password" name="password_confirmation" class="validation-control" data-validation="required">
      </div>

      <div class="form-group flex-end">
        <button type="submit" class="primary-btn" id="submit-button">Change Password</button>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
@include('scripts.validation')
@endpush