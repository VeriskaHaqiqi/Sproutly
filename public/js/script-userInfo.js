/**
 * script-infoUser.js
 * User Info Page - Plant Expert
 */

// ---- Navigation ----

/**
 * Kembali ke halaman roomChat (history back atau fallback ke route tertentu).
 * Sesuaikan fallback URL dengan route Laravel kamu.
 */
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/expert/chat'; // fallback route
    }
}

// ---- Copy to Clipboard ----

/**
 * Salin teks dari elemen berdasarkan ID, tampilkan toast konfirmasi.
 * @param {string} elementId - ID elemen yang teksnya akan disalin
 */
function copyText(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;

    const text = el.textContent.trim();

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text)
            .then(() => showToast())
            .catch(() => fallbackCopy(text));
    } else {
        fallbackCopy(text);
    }
}

/**
 * Fallback copy menggunakan textarea (untuk browser lama atau non-HTTPS).
 * @param {string} text
 */
function fallbackCopy(text) {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.select();
    try {
        document.execCommand('copy');
        showToast();
    } catch (err) {
        console.warn('Copy failed:', err);
    }
    document.body.removeChild(ta);
}

// ---- Toast Notification ----

let toastTimer = null;

/**
 * Tampilkan toast "Copied to clipboard!" selama 2 detik.
 */
function showToast() {
    const toast = document.getElementById('toast');
    if (!toast) return;

    toast.classList.add('show');

    if (toastTimer) clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}

// ---- Avatar Initials Generator ----

/**
 * Generate initials dari nama lengkap (maks 2 huruf).
 * @param {string} name
 * @returns {string}
 */
function getInitials(name) {
    if (!name) return '??';
    return name
        .split(' ')
        .slice(0, 2)
        .map(word => word[0].toUpperCase())
        .join('');
}

// ---- Init ----

document.addEventListener('DOMContentLoaded', function () {
    // Sinkronisasi initials avatar dengan nama client
    const nameEl    = document.getElementById('clientName');
    const initialsEl = document.getElementById('avatarInitials');

    if (nameEl && initialsEl) {
        initialsEl.textContent = getInitials(nameEl.textContent);
    }

    // Animasi entry cards
    const cards = document.querySelectorAll('.info-card');
    cards.forEach((card, i) => {
        card.style.opacity   = '0';
        card.style.transform = 'translateY(12px)';
        card.style.transition = `opacity 0.3s ease ${i * 0.08}s, transform 0.3s ease ${i * 0.08}s`;
        setTimeout(() => {
            card.style.opacity   = '1';
            card.style.transform = 'translateY(0)';
        }, 50 + i * 80);
    });
});