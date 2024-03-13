@extends('layouts.default')
@section('title','My Profile')
@section('content')

<section class="upload-file">
  <div class="upload-container">
    <div class="form-details">
      <div class="form-wrapper">
        <div class="img-uploads">
          <img src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg" alt="alt" style="width: 200px; height: 200px" />
          <div class="img-submit">
            <button type="submit" class="btn-img">Upload Images</button>
          </div>
        </div>

        <form action="" method="post">
          @csrf
          <div class="form-wraps">
            <div class="name">
              <label for="">Full Name</label>
              <input type="text" class="name-input" name="name" id="name" />
            </div>

            <div class="email-address">
              <label for="">Email Address</label>
              <input type="email" class="email-input" name="email" id="email" />
            </div>

            <div class="numbers">
              <div class="ph-num">
                <label for="ph-number">Phone Number</label>
                <input type="number" id="ph-number" class="number-input" />
              </div>

              <div class="mob-num">
                <label for="">Mobile Number</label>
                <input type="number" class="number-input-1" id="number" />
              </div>
            </div>

            <div class="designation">
              <label for="">Designation</label>
              <input type="text" class="designation-input" name="name" id="designations" />
            </div>

            <div class="birth-date">
              <label for="">Date of Birth</label>
              <input type="date" name="date" class="birth-input" id="date" />
            </div>

            <div class="password-wrapper">
              <div class="password">
                <label for="">Password</label>
                <input type="password" id="password" class="pass-input" />
                <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
              </div>

              <div class="confirm-pass">
                <label for="">Retype Password</label>
                <input type="password" id="confirm-password" class="pass-input-1" />
                <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
              </div>
            </div>

            <div class="role">
              <label for="">Role</label>
              <select class="role-dropdown" name="role" id="role">
                <option value="role">Super Admin</option>
                <option value="role">Super Admin</option>
                <option value="role">Super Admin</option>
              </select>
            </div>

            <div class="btn-wrapper">
              <div class="add-btn">
                <button type="submit" class="add">Add</button>
              </div>

              <div class="update-btn">
                <button type="submit" class="update">Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
@include('scripts.passToggle');
@endpush