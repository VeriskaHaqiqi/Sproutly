// ============================================================
// script-ConsultationhistoryUser.js - Real Data from API
// ============================================================

var PER_PAGE = 5;
var currentPage = 1;
var allConsultations = [];

// ──────────────────────────────────────────────────────────────
// FETCH DATA FROM API
// ──────────────────────────────────────────────────────────────
function fetchHistoryData() {
    fetch('/history-user-data', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(data) {
        if (Array.isArray(data)) {
            allConsultations = data;
        } else {
            allConsultations = [];
        }
        renderTable();
    })
    .catch(function(err) {
        console.error('Failed to fetch history:', err);
        allConsultations = [];
        renderTable();
    });
}

// ──────────────────────────────────────────────────────────────
// FILTER
// ──────────────────────────────────────────────────────────────
function getFiltered() {
    var q = document.getElementById("searchInput").value.trim().toLowerCase();
    var st = document.getElementById("statusFilter").value;
    var py = document.getElementById("paymentFilter").value;
    var dt = document.getElementById("dateFilter").value;

    var dtStr = "";
    if (dt) {
        var d = new Date(dt + "T12:00:00");
        dtStr = d.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });
        dtStr = dtStr.replace(/\s+/g, " ").trim();
    }

    return allConsultations.filter(function(c) {
        var ms = !q || c.expert.toLowerCase().includes(q) || c.topic.toLowerCase().includes(q) || c.id.toLowerCase().includes(q);
        var mv = !st || c.status.toLowerCase() === st.toLowerCase();
        var mp = !py || c.payment.toLowerCase() === py.toLowerCase();
        var cDate = c.date.replace(/\s+/g, " ").trim();
        var md = !dtStr || cDate === dtStr;
        return ms && mv && mp && md;
    });
}

// ──────────────────────────────────────────────────────────────
// RENDER TABLE
// ──────────────────────────────────────────────────────────────
// ── RENDER TABLE ──
function renderTable() {
    var filtered = getFiltered();
    var totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
    if (currentPage > totalPages) currentPage = 1;
    var items = filtered.slice((currentPage - 1) * PER_PAGE, currentPage * PER_PAGE);

    var tbody = document.getElementById("tableBody");
    if (!tbody) return;

    if (items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:48px;color:#9aaa9e;font-size:14px;">No completed consultations found.</td></tr>';
    } else {
        tbody.innerHTML = items.map(function(c) {
            // HAPUS tombol Review di history, pindahkan ke halaman Reviews
            return '<tr>' +
                '<td class="td-id">' + c.id + '</td>' +
                '<td>' + c.expert + '</td>' +  // HANYA NAMA, TANPA AVATAR
                '<td>' + c.topic + '</td>' +
                '<td class="td-date">' + c.date + '</td>' +
                '<td><span class="status-badge status-completed">' + c.status + '</span></td>' +
                '<td><span class="pay-badge ' + (c.payment === 'Refunded' ? 'pay-refunded' : 'pay-paid') + '">' + c.payment + '</span></td>' +
                '<td>' +
                    '<button class="view-btn" onclick="openDetail(\'' + c.id + '\')">View</button>' +
                '</td>' +
            '</tr>';
        }).join("");
    }

    renderPagination(totalPages);
}

// ──────────────────────────────────────────────────────────────
// PAGINATION
// ──────────────────────────────────────────────────────────────
function renderPagination(totalPages) {
    var pg = document.getElementById("pagination");
    if (!pg) return;
    pg.innerHTML = "";

    var prev = document.createElement("button");
    prev.className = "pg-btn pg-arrow";
    prev.innerHTML = '‹';
    prev.disabled = currentPage === 1;
    prev.onclick = function() { currentPage--; renderTable(); };
    pg.appendChild(prev);

    for (var i = 1; i <= totalPages; i++) {
        (function(p) {
            var b = document.createElement("button");
            b.className = "pg-btn" + (p === currentPage ? " active" : "");
            b.textContent = p;
            b.onclick = function() { currentPage = p; renderTable(); };
            pg.appendChild(b);
        })(i);
    }

    var next = document.createElement("button");
    next.className = "pg-btn pg-arrow";
    next.innerHTML = '›';
    next.disabled = currentPage === totalPages;
    next.onclick = function() { currentPage++; renderTable(); };
    pg.appendChild(next);
}

// ──────────────────────────────────────────────────────────────
// DETAIL MODAL
// ──────────────────────────────────────────────────────────────
function openDetail(id) {
    var c = allConsultations.find(function(x) { return x.id === id; });
    if (!c) return;

    var modalBody = document.getElementById("modalBody");
    if (!modalBody) return;

    modalBody.innerHTML =
        '<div class="detail-expert-row">' +
            '<img src="' + c.avatar + '" class="detail-av" alt="' + c.expert + '" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(c.expert) + '&background=76ead0&color=1a2636\'">' +
            '<div>' +
                '<div class="detail-client-name">' + c.expert + '</div>' +
                '<div class="detail-expert-role">' + (c.role || 'Expert') + '</div>' +
            '</div>' +
        '</div>' +
        '<div class="detail-grid">' +
            '<div class="detail-item"><span class="detail-label">Consultation ID</span><span class="detail-value td-id">' + c.id + '</span></div>' +
            '<div class="detail-item"><span class="detail-label">Topic</span><span class="detail-value">' + c.topic + '</span></div>' +
            '<div class="detail-item"><span class="detail-label">Date</span><span class="detail-value">' + c.date + '</span></div>' +
            '<div class="detail-item"><span class="detail-label">Duration</span><span class="detail-value">' + (c.duration || '—') + '</span></div>' +
            '<div class="detail-item"><span class="detail-label">Status</span><span class="detail-value"><span class="status-badge status-completed">' + c.status + '</span></span></div>' +
            '<div class="detail-item"><span class="detail-label">Payment</span><span class="detail-value"><span class="pay-badge ' + (c.payment === 'Refunded' ? 'pay-refunded' : 'pay-paid') + '">' + c.payment + '</span></span></div>' +
            '<div class="detail-item"><span class="detail-label">Fee</span><span class="detail-value" style="font-weight:700">' + c.fee + '</span></div>' +
        '</div>' +
        '<div class="detail-notes">' +
            '<div class="detail-label" style="margin-bottom:8px">Session Notes</div>' +
            '<p>' + (c.notes || 'No notes available') + '</p>' +
        '</div>';

    var overlay = document.getElementById("modalOverlay");
    if (overlay) overlay.classList.add("show");
}

function closeModal() {
    var overlay = document.getElementById("modalOverlay");
    if (overlay) overlay.classList.remove("show");
}

// ──────────────────────────────────────────────────────────────
// EVENT LISTENERS
// ──────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    fetchHistoryData();

    var closeBtn = document.getElementById("modalClose");
    if (closeBtn) closeBtn.addEventListener("click", closeModal);

    var overlay = document.getElementById("modalOverlay");
    if (overlay) overlay.addEventListener("click", function(e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape") closeModal();
    });

    ["searchInput", "statusFilter", "paymentFilter", "dateFilter"].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", function() { currentPage = 1; renderTable(); });
            el.addEventListener("change", function() { currentPage = 1; renderTable(); });
        }
    });
});