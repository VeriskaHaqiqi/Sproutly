document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("passwordForm");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const submitBtn = document.getElementById("submitResetBtn");
    const successModal = document.getElementById("successModal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    // ... validasi password rules (sama seperti sebelumnya) ...

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        if (!validateForm()) return;

        const email = document.getElementById("resetEmail").value;

        if (!email) {
            alert('Email tidak ditemukan. Silakan ulangi dari halaman lupa password.');
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
            alert('Terjadi kesalahan.');
            console.error(err);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Save New Password';
        });
    });

    // Event close modal → redirect ke login
    function redirectLogin() {
        window.location.href = '/login';
    }
    closeModalBtn.addEventListener("click", redirectLogin);
    successModal.addEventListener("click", function(e) {
        if (e.target === successModal) redirectLogin();
    });
});