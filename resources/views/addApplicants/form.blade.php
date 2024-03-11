@extends('layouts.default')
@section('title','Job Application -Step 1')
@section('content')

<section class="applicants">
  <!-- dropdowns -->
  <div class="select-dropdowns">
    <div class="continent-dropdown">
      <label for="">Select Continent</label>
      <select class="continents" name="" id="">
        <option value="continent">Europe</option>
        <option value="continent">Asia</option>
        <option value="continent">Australia</option>
        <option value="continent">Africa</option>
      </select>
    </div>

    <div class="country-dropdown">
      <label for="select-country">Select Country</label>
      <select class="country" name="" id="">
        <option value="country">Cyprus</option>
        <option value="country">Maldives</option>
        <option value="country">Nepal</option>
        <option value="country">South Africa</option>
      </select>
    </div>

    <div class="job-position-dropdown">
      <label for="">Select Job Position</label>
      <select class="job-position" name="" id="">
        <option value="position">Domestic Worker</option>
        <option value="position">House Worker</option>
        <option value="position">Office Worker</option>
        <option value="position">Supermarket Worker</option>
      </select>
    </div>
  </div>

  <!-- Passport Details -->
  <div class="passport-container">
    <div class="form-details">
      <h1>Passport Details<span class="asterisk">*</span></h1>
      <form action="" method="post">
        <div class="form-inputs">
          <div class="input-wrapper">
            <div class="pass-number">
              <label for="">Passport No:</label>
              <input type="number" name="passport-number">
            </div>

            <div class="gender-input">
              <label for="gender">Sex:</label>
              <input type="text" name="sex">
            </div>
          </div>

          <div class="surname-input">
            <label for="surname">Surname:</label>
            <input type="text" name="surname">
          </div>

          <div class="name-input">
            <label for="name">Given Name:</label>
            <input type="text" name="name">
          </div>

          <div class="nationality-input">
            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality">
          </div>

          <div class="date-birth-wrapper">
            <div class="birth_date">
              <label for="birth-date">Date of Birth:</label>
              <input type="date" name="birth-date">
            </div>

            <div class="birth_place">
              <label for="birthPlace">Place of Birth</label>
              <input type="text" name="birthPlace">
            </div>
          </div>

          <div class="issue-expiry-wrapper">
            <div class="issue-date">
              <label for="issueDate">Date of Issue:</label>
              <input type="date" name="issueDate">
            </div>

            <div class="expiry-date">
              <label for="expiryDate">Date of Expiry</label>
              <input type="date" name="expiryDate">
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- image upload -->
  <div class="image-upload-wrapper">
    <div class="image-wrapper">
      <img src="{{ asset('images/profile 1.svg') }}" style="width: 200px; height:200px" alt="">
    </div>
    <div class="btn-upload">
      <button type="submit" class="upload-btn">Upload Photo</button>
    </div>

    <div class="input-wraps">
      <label for="">Referred By:</label>
      <input type="text" name="referred">
    </div>

    <div class="input-contact">
      <label for="">Contact no:</label>
      <input type="number" name="contact">
    </div>
  </div>
</section>

<!-- personal details -->
<section class="personal-details">
  <div class="personal-detail-container">
    <div class="form-details">
      <h1>Personal Details<span class="asterisk">*</span></h1>

      <form action="" method="post">
        <div class="form-inputs">

          <div class="input-wrapper-details">
            <div class="age-input">
              <label for="age">Age:</label>
              <input type="number" name="age">
            </div>

            <div class="home-number">
              <label for="home">Home No:</label>
              <input type="number" name="home-number">
            </div>

            <div class="cell-number-input">
              <label for="cell-number">Cell No:</label>
              <input type="number" name="cell-number">
            </div>
          </div>

          <div class="input-wrapper-details">
            <div class="marital-input">
              <label for="marital-status">Marital Status:</label>
              <select class="marital-select" name="" id="">
                <option value="marital__status"></option>
                <option value="marital__status"></option>
              </select>
            </div>

            <div class="height-input">
              <label for="height">Height:</label>
              <input type="number" name="height">
            </div>

            <div class="weight-input">
              <label for="weight">Weight:</label>
              <input type="number" name="weight">
            </div>
          </div>


          <div class="fathername-input">
            <label for="father-name">Father's Name:</label>
            <input type="text" name="father-name">
          </div>

          <div class="mothername-input">
            <label for="name">Mother's Name:</label>
            <input type="text" name="mother-name">
          </div>

          <div class="address-input">
            <h5>Address:</h5>
            <div class="permanent-address-input">
              <label for="permanent-address">Permanent:</label>
              <input type="text" name="permanent-address">
            </div>

            <div class="temporary-address-input">
              <label for="temporary-address">Temporary:</label>
              <input type="text" name="temporary-address">
            </div>
          </div>

          <div class="email-input">
            <label for="email">Email:</label>
            <input type="email" name="email-address">
          </div>

        </div>
      </form>

    </div>
  </div>
</section>

<!-- Family Details -->
<section class="family-details">
  <div class="family-detail-container">
    <div class="form-details">
      <h1>Family Details<span class="asterisk">*</span></h1>

      <form action="" method="post">
        <div class="form-inputs">
          <div class="fathername-input">
            <label for="father-name">Spouse Name:</label>
            <input type="text" name="father-name">
          </div>

          <div class="input-wrapper-details">
            <div class="family-age-input">
              <label for="age">Age:</label>
              <input type="number" name="age">
            </div>

            <div class="occupation-input">
              <label for="status">Occupation:</label>
              <input type="text" name="occupation">
            </div>
          </div>

          <div class="input-wrapper-details">
            <div class="child-input">
              <label for="child-number">No. of Children:</label>
              <input type="number" name="children">
            </div>

            <div class="child-age-input">
              <label for="age">Ages:</label>
              <input type="number" name="age">
            </div>

            <div class="gender-category">
              <label for="gender">Sex:</label>
              <input type="text" name="sex">
            </div>
          </div>

          <div class="text-input">
            <label for="text-name">Who will care for your children during your employment abroad?:</label>
            <input type="text" name="text-name">
          </div>

        </div>
      </form>

    </div>
    <div class="next-button">
      <button type="submit" class="btn-next">
        NEXT
        <img src="{{ asset('images/Polygon.svg') }}" style="width: 20px; height:20px" alt="">
      </button>
    </div>
  </div>
</section>

@endsection