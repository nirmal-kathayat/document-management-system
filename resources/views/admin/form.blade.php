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
            <img src="{{asset('uploaded/user/'.$user->image)}}">
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
            <input type="text" name="name" class="bg-white validation-control" data-validation="required" value="{{old('name',$user->name ?? '')}}">
          </div>
          <div class="form-group group-column">
            <label>User Name <span class="text-red">*</span></label>
            <input type="text" name="username" class="bg-white validation-control" data-validation="required" value="{{old('username',$user->username ?? '')}}">
          </div>
          <div class="form-group group-column">
            <label>Email <span class="text-red">*</span></label>
            <input type="email" name="email" class="bg-white validation-control" data-validation="required" value="{{old('email',$user->email ?? '')}}">
          </div>
          <div class="form-group group-column">
            <label>Password <span class="text-red">*</span></label>
            <input type="password" name="password" class="bg-white validation-control" data-validation="required" value="{{old('password',$user->password ?? '')}}">
          </div>
          <div class="form-group group-column">
            <label>Designation <span class="text-red">*</span></label>
            <input type="text" name="designation" class="bg-white validation-control" data-validation="required" value="{{old('designation',$user->designation ?? '')}}">
          </div>
          <div class="grid-row template-repeat-3 col-gap-20">
            <div class="form-group group-column">
              <label>DOB <span class="text-red">*</span></label>
              <input type="date" name="dob" class="bg-white validation-control" data-validation="required" value="{{old('dob',$user->dob ?? '')}}">
            </div>
            <div class="form-group group-column">
              <label>Phone Number <span class="text-red">*</span></label>
              <input type="number" name="phone_no" class="bg-white validation-control" data-validation="required" value="{{old('phone_no',$user->phone_no ?? '')}}">
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
      this.makeInputEmpty = function() {
        $('input[name=name]').val("")
        $('input[name=username]').val("")
        $('input[name=email]').val("")
        $('input[name=password]').val("")
        $('input[name=designation]').val("")
        $('input[name=type]').val("")
        $('input[name=dob]').val("")
        $('input[name=phone_no]').val("")
      }

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
          Tesseract.recognize(
            file,
            'eng', {
              logger: m => {
                if ((m?.progress || 0) * 100 <= 100 && m?.status === 'initializing tesseract') {
                  $('.progress-bg').css('width', (m?.progress || 0) * 100 + '%');
                  $('.progress-bg').css('background', 'var(--primary)');
                }

              }
            }
          ).then(({
            data: {
              text
            }
          }) => {
            const MRZData = new MRZ(text)
            const result = MRZData.result
            $('input[name=type]').val(result?.type).trigger('input')

            if (!!result?.name) {
              $('select[name=name]').val(result?.name).trigger('change')
            }
            if (!!result?.username) {
              $('input[name=username]').val(result?.username).trigger('input')
            }
            if (!!result?.email) {
              $('input[name=email]').val(result?.email).trigger('input')
            }
            if (!!result?.password) {
              $('input[name=password]').val(result?.password).trigger('input')
            }
            if (!!result?.designation) {
              $('input[name=designation]').val(result?.designation).trigger('input')
            }
            if (!!result?.dob) {
              $('select[name=dob]').val(result?.dob).trigger('input')
            }
            if (!!result?.phone_no) {
              $('input[name=phone_no]').val(result?.phone_no).trigger('input')
            }


            $('.progress-loader-wrapper').fadeOut();
            $('.progress-bg').css('width', '0%');


          }).catch(err => {
            console.error('Error during OCR:', err);
            $('.progress-loader-wrapper').fadeOut();
            $('.progress-bg').css('width', '0%');

          });

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