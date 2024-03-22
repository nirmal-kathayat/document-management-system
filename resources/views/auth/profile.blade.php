@extends('layouts.default')
@section('title','My Profile')
@php
	$user = auth()->guard('admin')->user();
@endphp
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{route('admin.profile.update')}}" method="post" class="form-data" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex-row justify-space-between">
      <div class="upload-passport-wrapper">
        <div class="form-group group-column">
          <label>Upload Image <span class="text-red">*</span></label>
          <input type="file" name="image" class="d-none validation-control" id="passport-file-input" data-validation="{{isset($user) ? '' : 'required'}}" accept="image/*">
          @error('image')
          <p class="validation-error">{{$message}}</p>
          @enderror
        </div>
        <label class="upload-passport-img-wrapper white-bg drop-zone" id="drop-zone" for="passport-file-input">
          @if(isset($user) && !empty($user->image))
          <div class="uploaded-img">
            <img src="{{asset($user->image)}}">
          </div>
          @else
          <div class="upload-passport-info">
            <i class="fa fa-upload"></i>
          </div>
          @endif

        </label>
      </div>
      <div class="upload-password-form-wrapper ">
        <div class="form-wrapper upload-passport-input-items">
          <div class="form-group group-column">
            <label>Full Name <span class="text-red">*</span></label>
            <input type="text" name="name" class="validation-control" data-validation="required" value="{{old('name',$user->name ?? '')}}">
          </div>
          <div class="form-group group-column">
            <label>Username <span class="text-red">*</span></label>
            <input type="text" name="username" class="validation-control" data-validation="required" value="{{old('username',$user->username ?? '')}}">
            @error('username')
              <p class="validation-error">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group group-column">
            <label>Email <span class="text-red">*</span></label>
            <input type="email" name="email" class="validation-control" data-validation="required" value="{{old('email',$user->email ?? '')}}">
          </div>
      
          <div class="form-group group-column">
            <label>Designation <span class="text-red">*</span></label>
            <input type="text" name="designation" class="validation-control" data-validation="required" value="{{old('designation',$user->designation ?? '')}}">
          </div>
          <div class="grid-row template-repeat-3 col-gap-20">
            <div class="form-group group-column">
              <label>DOB <span class="text-red">*</span></label>
              <input type="date" name="dob" class="validation-control" data-validation="required" value="{{old('dob',$user->dob ?? '')}}">
            </div>
            <div class="form-group group-column">
              <label>Phone Number <span class="text-red">*</span></label>
              <input type="number" name="phone_no" class="validation-control" data-validation="required" value="{{old('phone_no',$user->phone_no ?? '')}}">
            </div>
            
          </div>
          <div class="form-group flex-end">
            <button type="submit" class="primary-btn">Update Profile</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection