const forgotPasswordForm = document.getElementById("forgotPasswordForm");
const emailInput = document.getElementById("email");
const emailError = document.getElementById("emailError");
const successModal = document.getElementById("successModal");
const closeModalBtn = document.getElementById("closeModalBtn");

function validateEmail(value) {
  if (!value.trim()) {
    return "This field is required.";
  }

  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!pattern.test(value)) {
    return "Please enter a valid email address.";
  }

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

function openModal() {
  successModal.classList.add("show");
  successModal.setAttribute("aria-hidden", "false");
}

function closeModal() {
  successModal.classList.remove("show");
  successModal.setAttribute("aria-hidden", "true");
}

emailInput.addEventListener("blur", () => {
  showError(emailInput, emailError, validateEmail(emailInput.value));
});

emailInput.addEventListener("input", () => {
  if (emailError.classList.contains("show")) {
    showError(emailInput, emailError, validateEmail(emailInput.value));
  }
});

forgotPasswordForm.addEventListener("submit", (event) => {
  event.preventDefault();

  const emailMessage = validateEmail(emailInput.value);
  showError(emailInput, emailError, emailMessage);

  if (!emailMessage) {
    openModal();
  }
});

closeModalBtn.addEventListener("click", closeModal);

successModal.addEventListener("click", (event) => {
  if (event.target === successModal) {
    closeModal();
  }
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape" && successModal.classList.contains("show")) {
    closeModal();
  }
});