// ============================================================
// script-ConsultationhistoryExpert.js - Real Data from API
// ============================================================

var PER_PAGE = 5;
var currentPage = 1;
var allConsultations = [];

// ──────────────────────────────────────────────────────────────
// FETCH DATA FROM API
// ──────────────────────────────────────────────────────────────
function fetchHistoryData() {
    fetch('/history-expert-data', {
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
        var ms = !q || c.client.toLowerCase().includes(q) || c.topic.toLowerCase().includes(q) || c.id.toLowerCase().includes(q);
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
            return '<tr>' +
                '<td class="td-id">' + c.id + '</td>' +
                '<td><div class="expert-cell"><img src="' + c.avatar + '" class="expert-av" alt="' + c.client + '" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(c.client) + '&background=76ead0&color=1a2636\'"><span>' + c.client + '</span></div></td>' +
                '<td>' + c.topic + '</td>' +
                '<td class="td-date">' + c.date + '</td>' +
                '<td><span class="status-badge status-completed">' + c.status + '</span></td>' +
                '<td><span class="pay-badge ' + (c.payment === 'Refunded' ? 'pay-refunded' : 'pay-paid') + '">' + c.payment + '</span></td>' +
                '<td><button class="view-btn" onclick="openDetail(\'' + c.id + '\')">View Details</button></td>' +
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
    prev.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
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
    next.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
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
            '<img src="' + c.avatar + '" class="detail-av" alt="' + c.client + '" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(c.client) + '&background=76ead0&color=1a2636\'">' +
            '<div>' +
                '<div class="detail-client-name">' + c.client + '</div>' +
                '<div class="detail-expert-role">' + (c.role || 'Client') + '</div>' +
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

    var modal = document.getElementById("detailModal");
    if (modal) modal.classList.remove("hidden");
}

function closeModal() {
    var modal = document.getElementById("detailModal");
    if (modal) modal.classList.add("hidden");
}

// ──────────────────────────────────────────────────────────────
// SIDEBAR TOGGLE (untuk mobile)
// ──────────────────────────────────────────────────────────────
var sidebar = document.getElementById("sidebar");
var mainContent = document.getElementById("mainContent");
var toggler = document.getElementById("sidebarToggle");

function openSB() {
    if (window.innerWidth <= 768) {
        sidebar.classList.add("show");
        sidebar.classList.remove("closed");
    } else {
        sidebar.classList.remove("closed");
        mainContent.classList.add("shifted");
        mainContent.classList.remove("full");
    }
}

function closeSB() {
    sidebar.classList.add("closed");
    sidebar.classList.remove("show");
    mainContent.classList.remove("shifted");
    mainContent.classList.add("full");
}

function isSBOpen() {
    return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed");
}

if (toggler) {
    toggler.addEventListener("click", function() {
        isSBOpen() ? closeSB() : openSB();
    });
}

document.querySelectorAll(".menu-link").forEach(function(l) {
    l.addEventListener("click", closeSB);
});

document.addEventListener("click", function(e) {
    if (window.innerWidth <= 768 && isSBOpen() && !sidebar.contains(e.target) && !toggler.contains(e.target)) {
        closeSB();
    }
});

window.addEventListener("resize", function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove("show");
    } else {
        mainContent.classList.remove("shifted");
        mainContent.classList.add("full");
    }
});

// ──────────────────────────────────────────────────────────────
// EVENT LISTENERS
// ──────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    fetchHistoryData();

    var closeBtn = document.getElementById("modalClose");
    if (closeBtn) closeBtn.addEventListener("click", closeModal);

    var modal = document.getElementById("detailModal");
    if (modal) modal.addEventListener("click", function(e) {
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