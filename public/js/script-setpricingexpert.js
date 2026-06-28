document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const consultationFee = document.getElementById("consultationFee");
    const updateFeeBtn = document.getElementById("updateFeeBtn");
    const successMessage = document.getElementById("successMessage");

    // ── SIDEBAR ──
    function closeSidebarDesktop() {
        sidebar.classList.add("hidden");
        mainContent.classList.add("full");
    }

    function openSidebarDesktop() {
        sidebar.classList.remove("hidden");
        mainContent.classList.remove("full");
    }

    function closeSidebarMobile() {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    }

    function openSidebarMobile() {
        sidebar.classList.add("show");
        sidebarOverlay.classList.add("show");
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains("show")) {
                    closeSidebarMobile();
                } else {
                    openSidebarMobile();
                }
            } else {
                if (sidebar.classList.contains("hidden")) {
                    openSidebarDesktop();
                } else {
                    closeSidebarDesktop();
                }
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", function () {
            closeSidebarMobile();
        });
    }

    // ── FORMAT RUPIAH ──
    function formatRupiah(value) {
        const numberString = value.replace(/\D/g, "");
        if (!numberString) return "";
        return numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if (consultationFee) {
        consultationFee.addEventListener("input", function () {
            this.value = formatRupiah(this.value);
        });
    }

    // ── UPDATE FEE ──
    if (updateFeeBtn) {
        updateFeeBtn.addEventListener("click", function () {
            let rawValue = consultationFee.value.trim();
            
            if (rawValue === "") {
                alert("Please enter the consultation fee first.");
                return;
            }

            // Hapus semua karakter non-digit (koma, titik, dll)
            let cleanValue = rawValue.replace(/,/g, '').replace(/\./g, '');
            let numericValue = parseInt(cleanValue);

            if (isNaN(numericValue) || numericValue <= 0) {
                alert("Please enter a valid fee amount (e.g., 50000).");
                return;
            }

            console.log('📤 Sending fee:', numericValue);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Disable button sementara
            updateFeeBtn.disabled = true;
            updateFeeBtn.textContent = 'Updating...';

            fetch('/setpricingexpert', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    tarif: numericValue.toString()
                })
            })
            .then(response => {
                console.log('📥 Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('📥 Response data:', data);
                
                if (data.message) {
                    // Tampilkan success message
                    successMessage.textContent = '✅ ' + data.message;
                    successMessage.classList.add("show");
                    
                    // Update input dengan format baru
                    if (data.tarif) {
                        consultationFee.value = data.tarif;
                    }
                    
                    // Refresh total earnings setelah update
                    refreshEarnings();
                    
                    setTimeout(() => {
                        successMessage.classList.remove("show");
                    }, 3000);
                } else {
                    alert('❌ ' + (data.message || 'Failed to update fee'));
                }
            })
            .catch(error => {
                console.error('❌ Error:', error);
                alert('❌ Failed to update consultation fee. Please try again.');
            })
            .finally(() => {
                updateFeeBtn.disabled = false;
                updateFeeBtn.textContent = 'Update Fee';
            });
        });
    }

    // ── REFRESH EARNINGS ──
    function refreshEarnings() {
        fetch('/setpricingexpert', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.totalEarnings !== undefined) {
                const earningsBox = document.getElementById('earningsBox');
                if (earningsBox) {
                    earningsBox.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.totalEarnings);
                }
            }
        })
        .catch(error => {
            console.error('Error refreshing earnings:', error);
        });
    }
});