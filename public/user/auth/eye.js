    feather.replace();

    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('data-feather', 'eye-off');
      } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('data-feather', 'eye');
      }

      feather.replace();
    }