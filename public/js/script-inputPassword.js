document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("resetPasswordForm");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");

    const ruleLength = document.getElementById("rule-length");
    const ruleCase = document.getElementById("rule-case");
    const ruleNumber = document.getElementById("rule-number");

    const successModal = document.getElementById("successModal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    function updateRules() {
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

    newPassword.addEventListener("input", updateRules);

    document.querySelectorAll(".toggle-password").forEach((button) => {
        button.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const input = document.getElementById(targetId);

            if (input.type === "password") {
                input.type = "text";
                this.innerHTML = "<span>🙈</span>";
            } else {
                input.type = "password";
                this.innerHTML = "<span>👁</span>";
            }
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const password = newPassword.value.trim();
        const confirm = confirmPassword.value.trim();

        const validLength = password.length >= 8;
        const validCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
        const validNumber = /\d/.test(password);

        if (!password || !confirm) {
            alert("Please fill in both password fields.");
            return;
        }

        if (!validLength || !validCase || !validNumber) {
            alert("Password does not meet the required criteria.");
            return;
        }

        if (password !== confirm) {
            alert("Confirm password does not match.");
            return;
        }

        successModal.classList.add("show");
    });

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