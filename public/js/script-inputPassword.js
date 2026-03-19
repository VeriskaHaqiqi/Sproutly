const form = document.getElementById("resetPasswordForm");
const newPassword = document.getElementById("newPassword");
const confirmPassword = document.getElementById("confirmPassword");

const ruleLength = document.getElementById("rule-length");
const ruleCase = document.getElementById("rule-case");
const ruleNumber = document.getElementById("rule-number");
const ruleMatch = document.getElementById("rule-match");

const successModal = document.getElementById("successModal");
const closeModalBtn = document.getElementById("closeModalBtn");

const toggleButtons = document.querySelectorAll(".toggle-password");

function setRuleState(ruleElement, isValid) {
    const dot = ruleElement.querySelector(".dot");

    if (isValid) {
        ruleElement.classList.add("valid");
        ruleElement.classList.remove("invalid");
        dot.textContent = "✔";
    } else {
        ruleElement.classList.remove("valid");
        ruleElement.classList.add("invalid");
        dot.textContent = "●";
    }
}

function validatePasswordRules() {
    const password = newPassword.value.trim();
    const confirm = confirmPassword.value.trim();

    const hasMinLength = password.length >= 8;
    const hasUpperLower = /[a-z]/.test(password) && /[A-Z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const isMatch = password !== "" && confirm !== "" && password === confirm;

    setRuleState(ruleLength, hasMinLength);
    setRuleState(ruleCase, hasUpperLower);
    setRuleState(ruleNumber, hasNumber);
    setRuleState(ruleMatch, isMatch);

    return hasMinLength && hasUpperLower && hasNumber && isMatch;
}

newPassword.addEventListener("input", validatePasswordRules);
confirmPassword.addEventListener("input", validatePasswordRules);

toggleButtons.forEach((button) => {
    button.addEventListener("click", function () {
        const targetId = this.getAttribute("data-target");
        const targetInput = document.getElementById(targetId);

        if (targetInput.type === "password") {
            targetInput.type = "text";
        } else {
            targetInput.type = "password";
        }
    });
});

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const isValid = validatePasswordRules();

    if (!isValid) {
        return;
    }

    successModal.classList.add("show");
    document.body.style.overflow = "hidden";
});

closeModalBtn.addEventListener("click", function () {
    successModal.classList.remove("show");
    document.body.style.overflow = "";
});

successModal.addEventListener("click", function (e) {
    if (e.target === successModal) {
        successModal.classList.remove("show");
        document.body.style.overflow = "";
    }
});