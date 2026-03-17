const email = document.getElementById("email");
const password = document.getElementById("password");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const loginBtn = document.getElementById("loginBtn");
const togglePassword = document.getElementById("togglePassword");
const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

function validateEmail(value) {
  if (!value.trim()) return "This field is required.";
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!pattern.test(value)) return "Please enter a valid email address.";
  return "";
}

function validatePassword(value) {
  if (!value.trim()) return "This field is required.";
  return "";
}

function showError(input, errorEl, message) {
  if (message) {
    input.classList.add("error");
    errorEl.textContent = message;
    errorEl.classList.add("show");
  } else {
    input.classList.remove("error");
    errorEl.classList.remove("show");
  }
}

email.addEventListener("blur", () => {
  showError(email, emailError, validateEmail(email.value));
});

password.addEventListener("blur", () => {
  showError(password, passwordError, validatePassword(password.value));
});

email.addEventListener("input", () => {
  if (emailError.classList.contains("show")) {
    showError(email, emailError, validateEmail(email.value));
  }
});

password.addEventListener("input", () => {
  if (passwordError.classList.contains("show")) {
    showError(password, passwordError, validatePassword(password.value));
  }
});

togglePassword.addEventListener("click", () => {
  const isPassword = password.type === "password";
  password.type = isPassword ? "text" : "password";
  eyeOpen.style.display = isPassword ? "none" : "block";
  eyeClosed.style.display = isPassword ? "block" : "none";
});

loginBtn.addEventListener("click", () => {
  const emailMsg = validateEmail(email.value);
  const passwordMsg = validatePassword(password.value);

  showError(email, emailError, emailMsg);
  showError(password, passwordError, passwordMsg);

  if (!emailMsg && !passwordMsg) {
    alert("Logging in...");
  }
});