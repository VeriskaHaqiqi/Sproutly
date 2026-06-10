// ── Sidebar (exact copy dari script-dashboard-user.js) ────────
const menuToggle  = document.getElementById("menuToggle");
const sidebar     = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");

function openSidebar() {
  if (window.innerWidth <= 768) { sidebar.classList.add("show"); sidebar.classList.remove("closed"); }
  else { sidebar.classList.remove("closed"); mainContent.classList.add("shifted"); mainContent.classList.remove("full"); }
}
function closeSidebar() {
  sidebar.classList.add("closed"); sidebar.classList.remove("show");
  mainContent.classList.remove("shifted"); mainContent.classList.add("full");
}
function isSidebarOpen() {
  return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed");
}
menuToggle.addEventListener("click", () => isSidebarOpen() ? closeSidebar() : openSidebar());
document.querySelectorAll(".menu-link").forEach(l => l.addEventListener("click", () => closeSidebar()));
document.addEventListener("click", (e) => {
  if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
});
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) sidebar.classList.remove("show");
  else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
});

// ── Invoice data ──────────────────────────────────────────────
let invoices = [
  { id:"#INV-001", expert:"Dr. Sarah Johnson",  role:"Crop Specialist",          avatar:"https://randomuser.me/api/portraits/women/44.jpg",  consultation:"Tomato Disease Analysis",         amount:450,  due:"Dec 15, 2024", status:"Paid"    },
  { id:"#INV-002", expert:"Michael Chen",        role:"Soil Expert",              avatar:"https://randomuser.me/api/portraits/men/32.jpg",    consultation:"Soil pH Assessment",              amount:320,  due:"Dec 20, 2024", status:"Paid"    },
  { id:"#INV-003", expert:"Emily Rodriguez",     role:"Irrigation Consultant",    avatar:"https://randomuser.me/api/portraits/women/65.jpg",  consultation:"Water Management Plan",           amount:680,  due:"Dec 10, 2024", status:"Refund"  },
  { id:"#INV-004", expert:"David Park",          role:"Pest Control Expert",      avatar:"https://randomuser.me/api/portraits/men/55.jpg",    consultation:"Integrated Pest Management",      amount:520,  due:"Dec 25, 2024", status:"Paid"    },
  { id:"#INV-005", expert:"Lisa Thompson",       role:"Organic Farming Expert",   avatar:"https://randomuser.me/api/portraits/women/28.jpg",  consultation:"Organic Certification Guidance",  amount:750,  due:"Jan 5, 2025",  status:"Refund"  },
  { id:"#INV-006", expert:"James Wilson",        role:"Climate Agronomist",       avatar:"https://randomuser.me/api/portraits/men/11.jpg",    consultation:"Climate-Smart Practices",         amount:410,  due:"Jan 10, 2025", status:"Paid"    },
  { id:"#INV-007", expert:"Alicia Warren",       role:"Urban Farming Specialist", avatar:"https://randomuser.me/api/portraits/women/51.jpg",  consultation:"Hydroponic System Setup",         amount:890,  due:"Jan 12, 2025", status:"Pending" },
  { id:"#INV-008", expert:"Robert Martinez",     role:"Soil Fertility Agronomist",avatar:"https://randomuser.me/api/portraits/men/22.jpg",   consultation:"Nutrient Management Plan",        amount:370,  due:"Jan 15, 2025", status:"Paid"    },
  { id:"#INV-009", expert:"Olivia Green",        role:"Water Resource Consultant",avatar:"https://randomuser.me/api/portraits/women/54.jpg", consultation:"Rainwater Harvesting Plan",       amount:460,  due:"Jan 18, 2025", status:"Pending" },
  { id:"#INV-010", expert:"Carlos Mendez",       role:"Irrigation Engineer",      avatar:"https://randomuser.me/api/portraits/men/45.jpg",   consultation:"Drip Irrigation Design",          amount:610,  due:"Jan 20, 2025", status:"Paid"    },
  { id:"#INV-011", expert:"Sophie Laurent",      role:"Plant Nutrition Expert",   avatar:"https://randomuser.me/api/portraits/women/33.jpg", consultation:"Micronutrient Assessment",        amount:280,  due:"Jan 22, 2025", status:"Pending" },
  { id:"#INV-012", expert:"Tom Walker",          role:"Agroforestry Specialist",  avatar:"https://randomuser.me/api/portraits/men/67.jpg",   consultation:"Cover Crop Strategy",             amount:340,  due:"Jan 25, 2025", status:"Paid"    },
];

const PER_PAGE = 5;
let currentPage = 1;

function getFiltered() {
  const status = document.getElementById("filterStatus").value;
  const search = document.getElementById("filterSearch").value.trim().toLowerCase();
  const global = document.getElementById("globalSearch").value.trim().toLowerCase();
  const kw = search || global;
  return invoices.filter(inv => {
    const matchStatus = !status || inv.status === status;
    const matchSearch = !kw ||
      inv.expert.toLowerCase().includes(kw) ||
      inv.consultation.toLowerCase().includes(kw) ||
      inv.id.toLowerCase().includes(kw) ||
      inv.role.toLowerCase().includes(kw);
    return matchStatus && matchSearch;
  });
}

function badgeClass(s) { return { Paid:"badge-paid", Pending:"badge-pending", Refund:"badge-refund" }[s] || "badge-pending"; }

function fmt(n) { return "$" + Number(n).toLocaleString(); }

function renderTable() {
  const filtered   = getFiltered();
  const totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
  if (currentPage > totalPages) currentPage = 1;
  const start = (currentPage - 1) * PER_PAGE;
  const items = filtered.slice(start, start + PER_PAGE);

  const tbody = document.getElementById("invoiceTableBody");
  if (items.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:40px;color:#9aaa9e;font-size:14px;">No invoices found.</td></tr>`;
  } else {
    tbody.innerHTML = items.map(inv => `
      <tr>
        <td><span class="inv-id">${inv.id}</span></td>
        <td>
          <div class="expert-cell">
            <img src="${inv.avatar}" alt="${inv.expert}" class="expert-avatar"
              onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(inv.expert)}&background=76ead0&color=1a2636&size=80'">
            <div>
              <div class="expert-cell-name">${inv.expert}</div>
              <div class="expert-cell-role">${inv.role}</div>
            </div>
          </div>
        </td>
        <td>${inv.consultation}</td>
        <td><span class="amount-cell">${fmt(inv.amount)}</span></td>
        <td><span class="date-cell">${inv.due}</span></td>
        <td><span class="badge ${badgeClass(inv.status)}">${inv.status}</span></td>
        <td>
          <button class="action-btn" title="Download invoice" onclick="downloadInvoice('${inv.id}')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
              <polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
          </button>
        </td>
      </tr>`).join("");
  }

  // Showing text
  const total = filtered.length;
  const from  = total === 0 ? 0 : start + 1;
  const to    = Math.min(start + PER_PAGE, total);
  document.getElementById("showingText").textContent = `Showing ${from} to ${to} of ${total} results`;

  renderPagination(totalPages);
  updateStats(filtered);
}

function renderPagination(totalPages) {
  const wrap = document.getElementById("pagination");
  wrap.innerHTML = "";

  const prev = document.createElement("button");
  prev.className = "page-btn"; prev.textContent = "Previous";
  prev.disabled = currentPage === 1;
  prev.addEventListener("click", () => { currentPage--; renderTable(); });
  wrap.appendChild(prev);

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.className = "page-btn" + (i === currentPage ? " active" : "");
    btn.textContent = i;
    btn.addEventListener("click", () => { currentPage = i; renderTable(); });
    wrap.appendChild(btn);
  }

  const next = document.createElement("button");
  next.className = "page-btn"; next.textContent = "Next";
  next.disabled = currentPage === totalPages;
  next.addEventListener("click", () => { currentPage++; renderTable(); });
  wrap.appendChild(next);
}

function updateStats(filtered) {
  const paid    = filtered.filter(i => i.status === "Paid").reduce((s, i) => s + i.amount, 0);
  const pending = filtered.filter(i => i.status === "Pending").length;
  const refund  = filtered.filter(i => i.status === "Refund").reduce((s, i) => s + i.amount, 0);
  document.getElementById("statPaid").textContent     = fmt(paid);
  document.getElementById("statPending").textContent  = pending;
  document.getElementById("statOutstanding").textContent = fmt(refund);
  document.getElementById("statUrgent").textContent   = pending > 0 ? `${Math.min(pending, 3)} urgent` : "none";
}

// ── Filter panel ─────────────────────────────────────────────
document.getElementById("filterToggle").addEventListener("click", () => {
  const panel = document.getElementById("filterPanel");
  const btn   = document.getElementById("filterToggle");
  panel.classList.toggle("hidden");
  btn.classList.toggle("active");
});

document.getElementById("filterReset").addEventListener("click", () => {
  document.getElementById("filterStatus").value = "";
  document.getElementById("filterSearch").value = "";
  currentPage = 1; renderTable();
});

document.getElementById("filterStatus").addEventListener("change", () => { currentPage = 1; renderTable(); });
document.getElementById("filterSearch").addEventListener("input",  () => { currentPage = 1; renderTable(); });
document.getElementById("globalSearch").addEventListener("input",  () => { currentPage = 1; renderTable(); });

// ── New Invoice Modal ─────────────────────────────────────────
let nextId = 13;
const modalOverlay = document.getElementById("modalOverlay");

document.getElementById("newInvoiceBtn").addEventListener("click", () => {
  modalOverlay.classList.remove("hidden");
});
function closeModal() { modalOverlay.classList.add("hidden"); }
document.getElementById("modalClose").addEventListener("click",  closeModal);
document.getElementById("modalCancel").addEventListener("click", closeModal);
modalOverlay.addEventListener("click", (e) => { if (e.target === modalOverlay) closeModal(); });

document.getElementById("modalSave").addEventListener("click", () => {
  const expert = document.getElementById("newExpert").value.trim();
  const role   = document.getElementById("newRole").value.trim();
  const consult= document.getElementById("newConsultation").value.trim();
  const amount = parseFloat(document.getElementById("newAmount").value);
  const due    = document.getElementById("newDue").value;
  const status = document.getElementById("newStatus").value;

  if (!expert || !consult || !amount || !due) {
    alert("Please fill in all required fields.");
    return;
  }

  // Format date
  const d = new Date(due);
  const dueFormatted = d.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });

  const newInv = {
    id: `#INV-${String(nextId).padStart(3, "0")}`,
    expert, role: role || "Expert",
    avatar: `https://ui-avatars.com/api/?name=${encodeURIComponent(expert)}&background=76ead0&color=1a2636&size=80`,
    consultation: consult,
    amount, due: dueFormatted, status
  };

  invoices.unshift(newInv);
  nextId++;
  currentPage = 1;
  renderTable();
  closeModal();

  // Reset form
  ["newExpert","newRole","newConsultation","newAmount","newDue"].forEach(id => document.getElementById(id).value = "");
  document.getElementById("newStatus").value = "Pending";
});

// ── Download (simulate) ───────────────────────────────────────
function downloadInvoice(id) {
  const inv = invoices.find(i => i.id === id);
  if (!inv) return;
  alert(`Downloading invoice ${inv.id}\n${inv.expert} — ${inv.consultation}\nAmount: $${inv.amount}`);
}

// ── Init ─────────────────────────────────────────────────────
renderTable();