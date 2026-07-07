document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("passwordForm");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const newPasswordError = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    const ruleLength = document.getElementById("ruleLength");
    const ruleUpperLower = document.getElementById("ruleUpperLower");
    const ruleNumber = document.getElementById("ruleNumber");
    const successModal = document.getElementById("successModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const modalLoginBtn = document.getElementById("modalLoginBtn");
    const submitBtn = document.getElementById("submitResetBtn");

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
        const pass = newPassword.value.trim();
        const confirm = confirmPassword.value.trim();
        clearErrors();

        let isValid = true;
        const rulesValid = validateRules(pass);

        if (pass === "") {
            newPasswordError.textContent = "Please enter your new password.";
            isValid = false;
        } else if (!rulesValid) {
            newPasswordError.textContent = "Password must meet all requirements.";
            isValid = false;
        }

        if (confirm === "") {
            confirmPasswordError.textContent = "Please confirm your new password.";
            isValid = false;
        } else if (pass !== confirm) {
            confirmPasswordError.textContent = "Passwords do not match.";
            isValid = false;
        }

        return isValid;
    }

    newPassword.addEventListener("input", function () {
        validateRules(this.value);
        if (this.value.trim() !== "") newPasswordError.textContent = "";
    });

    confirmPassword.addEventListener("input", function () {
        if (this.value.trim() !== "") confirmPasswordError.textContent = "";
    });

    document.querySelectorAll(".toggle-password").forEach(btn => {
        btn.addEventListener("click", function () {
            const target = document.getElementById(this.dataset.target);
            if (target.type === "password") {
                target.type = "text";
                this.textContent = "🙈";
            } else {
                target.type = "password";
                this.textContent = "👁";
            }
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        if (!validateForm()) return;

        const token = document.querySelector('input[name="token"]').value;
        const email = document.querySelector('input[name="email"]').value;

        if (!email) {
            alert('Email tidak ditemukan. Silakan gunakan link dari email reset.');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Updating...';

        fetch('/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                token: token,
                email: email,
                password: newPassword.value,
                password_confirmation: confirmPassword.value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successModal.classList.add("show");
            } else {
                alert(data.message || 'Gagal reset password. Coba lagi.');
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            console.error(err);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Save New Password';
        });
    });

    function redirectToLogin() {
        window.location.href = '/login';
    }

    closeModalBtn.addEventListener("click", redirectToLogin);
    modalLoginBtn.addEventListener("click", redirectToLogin);
    successModal.addEventListener("click", function(e) {
        if (e.target === successModal) redirectToLogin();
    });
});