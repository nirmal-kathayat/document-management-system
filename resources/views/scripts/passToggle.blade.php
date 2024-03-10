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