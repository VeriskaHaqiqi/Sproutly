document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("resetPasswordForm");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");

    const ruleLength = document.getElementById("rule-length");
    const ruleCase = document.getElementById("rule-case");
    const ruleNumber = document.getElementById("rule-number");

    function validatePassword() {
        const value = newPassword.value;

        if (value.length >= 8) {
            ruleLength.classList.add("valid");
        } else {
            ruleLength.classList.remove("valid");
        }

        if (/[a-z]/.test(value) && /[A-Z]/.test(value)) {
            ruleCase.classList.add("valid");
        } else {
            ruleCase.classList.remove("valid");
        }

        if (/\d/.test(value)) {
            ruleNumber.classList.add("valid");
        } else {
            ruleNumber.classList.remove("valid");
        }
    }

    newPassword.addEventListener("input", validatePassword);

    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const input = document.getElementById(targetId);

            if (input.type === "password") {
                input.type = "text";
                this.textContent = "🙈";
            } else {
                input.type = "password";
                this.textContent = "👁";
            }
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const password = newPassword.value.trim();
        const confirm = confirmPassword.value.trim();

        const isValidLength = password.length >= 8;
        const hasCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
        const hasNumber = /\d/.test(password);

        if (!password || !confirm) {
            alert("Please fill in all password fields.");
            return;
        }

        if (!isValidLength || !hasCase || !hasNumber) {
            alert("Password does not meet the required criteria.");
            return;
        }

        if (password !== confirm) {
            alert("Confirm password does not match.");
            return;
        }

        alert("Your password has been successfully updated.");
        form.reset();
        validatePassword();
    });
});