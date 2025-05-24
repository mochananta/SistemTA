  function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    icon.outerHTML = `<i id="${iconId}" data-feather="${isPassword ? 'eye-off' : 'eye'}" class="w-5 h-5"></i>`;

    setTimeout(() => feather.replace(), 10);
  }

  document.addEventListener("DOMContentLoaded", () => {
    feather.replace();
  });