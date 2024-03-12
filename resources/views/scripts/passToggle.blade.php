<script>
  const passwordField = document.getElementById("password");
  const togglePassword = document.querySelector(".password-toggle-icon i");

  const confirmPasswordField = document.getElementById("confirm-password");
  const toggleConfirmPassword = document.querySelector(
    ".confirm-pass .password-toggle-icon i"
  );

  togglePassword.addEventListener("click", function() {
    togglePasswordFieldVisibility(passwordField, togglePassword);
  });

  toggleConfirmPassword.addEventListener("click", function() {
    togglePasswordFieldVisibility(confirmPasswordField, toggleConfirmPassword);
  });

  function togglePasswordFieldVisibility(field, toggleIcon) {
    if (field.type === "password") {
      field.type = "text";
      toggleIcon.classList.remove("fa-eye");
      toggleIcon.classList.add("fa-eye-slash");
    } else {
      field.type = "password";
      toggleIcon.classList.remove("fa-eye-slash");
      toggleIcon.classList.add("fa-eye");
    }
  }
</script>

<script>
  $('#account-form').validate({
    rules: {
      confirm: {
        equalTo: "#password"
      }
    }
  });
  $('#profile-form').validate();
  $('#form-1').validate();
  $('#jquery-steps').steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
      if (newIndex < currentIndex) {
        return true;
      }
      var form = $('.body.current form');
      if (form.length == 1) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
      }
      return true;
    },
    onFinishing: function(event, currentIndex) {

      var form = $('.body.current form');
      if (form.length == 1) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
      }
      return true;
    },
    onFinished: function(event, currentIndex) {
      alert("Submitted!");
    }
  });
</script>