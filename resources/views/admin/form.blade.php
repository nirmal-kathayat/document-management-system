@extends('layouts.default')
@section('title','All Users')
@php
$url = isset($user) ? route('admin.user.edit',['id' => $user->id]) : route('admin.user.create');
@endphp
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
  <form action="{{$url}}" method="post" class="form-data" enctype="multipart/form-data">
    @csrf
    @if(isset($user))
    @method('PUT')
    @endif
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
          @if(!isset($user))
          <div class="form-group group-column">
            <label>Password @if(!isset($user)) <span class="text-red">*</span> @endif</label>
            <input type="password" name="password" class="validation-control" data-validation="{{isset($user) ? '' : 'required'}}">
          </div>
          <div class="form-group group-column">
            <label>Confrim Password @if(!isset($user)) <span class="text-red">*</span> @endif</label>
            <input type="password" name="confirm_password" class="validation-control" data-validation="{{isset($user) ? '' : 'required|confirm'}}">
          </div>
          @endif
          <div class="form-group group-column">
            <label>Designation <span class="text-red">*</span></label>
            <input type="text" name="designation" class="validation-control" data-validation="required" value="{{old('designation',$user->designation ?? '')}}">
          </div>
          <div class="form-group group-column">
                <label>Role</label>
                <select name="roles[]" class="validation-control" data-validation="required">
                    <option value="">Select</option>
                    @foreach($roles as $role)
                      <option value="{{$role->id}}" {{isset($user) && in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
          <div class="grid-row template-repeat-3 col-gap-20">
            <div class="form-group group-column">
              <label>DOB <span class="text-red">*</span></label>
              <input type="date" name="dob" class="validation-control" data-validation="required" value="{{old('dob',$user->dob ?? '')}}">
            </div>
            <div class="form-group group-column">
              <label>Phone Number <span class="tvalext-red">*</span></label>
              <input type="number" name="phone_no" class="validation-control" data-validation="required" value="{{old('phone_no',$user->phone_no ?? '')}}">
            </div>
            
          </div>
          <div class="form-group flex-end">
            <button type="submit" class="primary-btn">{{isset($user) ? 'Update' : 'Add'}}</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
@include('scripts.validation')
<script>
  (function() {
    function Initial() {
      let _this = this;

      this.fileInputListener = function() {
        const dropZone = $('#drop-zone')
        const fileInput = $('#passport-file-input')

        function handleFile(files) {
          const file = files[0]
          const reader = new FileReader();
          reader.onload = function(event) {
            const imgWrapper = $('<div />', {
              class: 'uploaded-img',
            })
            const img = $('<img />', {
              src: event.target.result
            })
            $('.uploaded-img').remove()
            $('.upload-passport-info').hide()
            imgWrapper.append(img)
            dropZone.append(imgWrapper)
          };

          reader.readAsDataURL(file);
          $('.progress-loader-wrapper').fadeIn()
          _this.makeInputEmpty()

        }
        dropZone.on('dragover', function(e) {
          e.preventDefault()
          dropZone.addClass('dragged-over')
        })
        dropZone.on('dragleave', function(e) {
          dropZone.removeClass('dragged-over')
        })
        dropZone.on('drop', function(e) {
          e.preventDefault()
          dropZone.removeClass('dragged-over')
          handleFile(e.originalEvent.dataTransfer.files)
        })

        fileInput.on('change', function(e) {
          handleFile(e.target.files)
        })
      };
      this.init = function() {
        _this.fileInputListener();
      };
    }
    let initialObj = new Initial();
    initialObj.init();
  })();
</script>
@endpush