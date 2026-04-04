document.addEventListener("DOMContentLoaded", function () {
    const passwordForm = document.getElementById("passwordForm");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");

    const newPasswordError = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    const ruleLength = document.getElementById("ruleLength");
    const ruleUpperLower = document.getElementById("ruleUpperLower");
    const ruleNumber = document.getElementById("ruleNumber");

    const successModal = document.getElementById("successModal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    const toggleButtons = document.querySelectorAll(".toggle-password");

    function validateRules(password) {
        const hasMinLength = password.length >= 8;
        const hasUpperLower = /[a-z]/.test(password) && /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);

        ruleLength.classList.toggle("valid", hasMinLength);
        ruleUpperLower.classList.toggle("valid", hasUpperLower);
        ruleNumber.classList.toggle("valid", hasNumber);

        return hasMinLength && hasUpperLower && hasNumber;
    }

    function clearErrors() {
        newPasswordError.textContent = "";
        confirmPasswordError.textContent = "";
    }

    function validateForm() {
        const passwordValue = newPassword.value.trim();
        const confirmValue = confirmPassword.value.trim();

        clearErrors();

        let isValid = true;
        const rulesValid = validateRules(passwordValue);

        if (passwordValue === "") {
            newPasswordError.textContent = "Please enter your new password.";
            isValid = false;
        } else if (!rulesValid) {
            newPasswordError.textContent = "Password must match all required conditions.";
            isValid = false;
        }

        if (confirmValue === "") {
            confirmPasswordError.textContent = "Please confirm your new password.";
            isValid = false;
        } else if (passwordValue !== confirmValue) {
            confirmPasswordError.textContent = "Passwords do not match.";
            isValid = false;
        }

        return isValid;
    }

    if (newPassword) {
        newPassword.addEventListener("input", function () {
            validateRules(this.value);
            if (this.value.trim() !== "") {
                newPasswordError.textContent = "";
            }
        });
    }

    if (confirmPassword) {
        confirmPassword.addEventListener("input", function () {
            if (this.value.trim() !== "") {
                confirmPasswordError.textContent = "";
            }
        });
    }

    toggleButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const targetInput = document.getElementById(targetId);

            if (targetInput.type === "password") {
                targetInput.type = "text";
                this.textContent = "🙈";
            } else {
                targetInput.type = "password";
                this.textContent = "👁";
            }
        });
    });

    if (passwordForm) {
        passwordForm.addEventListener("submit", function (e) {
            e.preventDefault();

            if (validateForm()) {
                successModal.classList.add("show");
            }
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            successModal.classList.remove("show");
        });
    }

    if (successModal) {
        successModal.addEventListener("click", function (e) {
            if (e.target === successModal) {
                successModal.classList.remove("show");
            }
        });
    }
});