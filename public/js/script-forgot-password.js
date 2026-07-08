document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("forgotPasswordForm");
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("emailError");
    const successModal = document.getElementById("successModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const resetBtn = document.getElementById("resetBtn");

    let redirectEmail = '';

    function validateEmail(value) {
        if (!value.trim()) return "This field is required.";
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!pattern.test(value)) return "Please enter a valid email address.";
        return "";
    }

    function showError(message) {
        if (message) {
            emailInput.classList.add("error");
            emailError.textContent = message;
            emailError.classList.add("show");
        } else {
            emailInput.classList.remove("error");
            emailError.classList.remove("show");
        }
    }

    function openModal() {
        successModal.classList.add("show");
        successModal.setAttribute("aria-hidden", "false");
    }

    function closeModal() {
        successModal.classList.remove("show");
        successModal.setAttribute("aria-hidden", "true");
        // Redirect ke halaman inputPassword dengan email sebagai query
        if (redirectEmail) {
            window.location.href = '/inputPassword?email=' + encodeURIComponent(redirectEmail);
        } else {
            window.location.href = '/login';
        }
    }

    emailInput.addEventListener("blur", function() {
        showError(validateEmail(this.value));
    });

    emailInput.addEventListener("input", function() {
        if (emailError.classList.contains("show")) {
            showError(validateEmail(this.value));
        }
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const error = validateEmail(emailInput.value);
        showError(error);
        if (error) return;

        redirectEmail = emailInput.value.trim();

        resetBtn.disabled = true;
        resetBtn.innerHTML = 'Sending...';

        fetch('/forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email: redirectEmail })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                openModal(); // tampilkan modal sukses
            } else {
                alert(data.message || 'Gagal mengirim reset link. Coba lagi.');
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            console.error(err);
        })
        .finally(() => {
            resetBtn.disabled = false;
            resetBtn.innerHTML = '<span>Send Reset Link</span><svg class="send-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M16 2L8 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M16 2L11 16L8 10L2 7L16 2Z" fill="currentColor"/></svg>';
        });
    });

    closeModalBtn.addEventListener("click", closeModal);
    successModal.addEventListener("click", function(e) {
        if (e.target === successModal) closeModal();
    });
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && successModal.classList.contains("show")) {
            closeModal();
        }
    });
});