document.addEventListener("DOMContentLoaded", () => {
  const pwInput = document.getElementById("password");
  const eyeBtn = document.getElementById("eye-btn");
  const emailInput = document.getElementById("email");
  const emailErr = document.getElementById("email-err");
  const passwordErr = document.getElementById("password-err");
  const loginBtn = document.getElementById("btn-login");

  function showError(el, msg) {
    if (!el) return;
    el.style.display = "block";
    el.innerText = msg;
  }

  function hideError(el) {
    if (!el) return;
    el.style.display = "none";
    el.innerText = "";
  }

  hideError(emailErr);
  hideError(passwordErr);

  if (eyeBtn && pwInput) {
    eyeBtn.addEventListener("click", () => {
      pwInput.type = pwInput.type === "password" ? "text" : "password";
      eyeBtn.textContent = pwInput.type === "password" ? "👁" : "🙈";
    });
  }

  if (loginBtn) {
    loginBtn.addEventListener("click", (e) => {
      e.preventDefault();

      let valid = true;
      const email = emailInput.value.trim();
      const password = pwInput.value.trim();

      if (email === "") {
        showError(emailErr, "Email wajib diisi.");
        valid = false;
      } else {
        hideError(emailErr);
      }

      if (password === "") {
        showError(passwordErr, "Password wajib diisi.");
        valid = false;
      } else {
        hideError(passwordErr);
      }

      if (valid) {
        alert("Login berhasil (demo)");
      }
    });
  }
});