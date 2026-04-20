<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Invoices</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-invoice.css') }}">
</head>
<body>
<div class="dashboard-page">

  <!-- SIDEBAR -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeUser') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>
    <div class="sidebar-line"></div>
    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-user') }}"      class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consultationUser') }}"    class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/daftarArtikel') }}"       class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
      <a href="{{ url('/reviewsUser') }}"         class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}"             class="menu-link active"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/accountUser') }}"         class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
        </button>

      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <svg viewBox="0 0 24 24" fill="none" width="20" height="20">
            <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
          </svg>
        </button>
        <a href="{{ url('/accountUser') }}" class="profile-chip">
          <div class="profile-info">
            <span class="profile-name">Sarah Green</span>
            <span class="profile-role">Agriculture Expert</span>
          </div>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- CONTENT -->
    <section class="content-wrap">

      <div class="page-header">
        <div>
          <h1>Invoices</h1>
          <p>Manage and track all consultation invoices</p>
        </div>
        <div class="page-header-actions">
          <button class="filter-btn" id="filterToggle" type="button">
            <i class="fa-solid fa-filter"></i> Filter
          </button>
        </div>
      </div>

      <!-- Filter panel -->
      <div class="filter-panel hidden" id="filterPanel">
        <div class="filter-row">
          <div class="filter-group">
            <label>Status</label>
            <select id="filterStatus">
              <option value="">All Status</option>
              <option value="Paid">Paid</option>
              <option value="Pending">Pending</option>
              <option value="Refund">Refund</option>
            </select>
          </div>
          <div class="filter-group" style="flex:1">
            <label>Search</label>
            <input type="text" id="filterSearch" placeholder="Expert name, consultation, invoice ID..."/>
          </div>
          <div class="filter-group">
            <label>&nbsp;</label>
            <button class="filter-reset-btn" id="filterReset" type="button">
              <i class="fa-solid fa-rotate-left"></i> Reset
            </button>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-row">
        <div class="stat-card">
          <div>
            <p class="stat-label">Total Outstanding</p>
            <h2 class="stat-value" id="statOutstanding">$1,360</h2>
            <span class="stat-sub positive">+12% from last month</span>
          </div>
          <div class="stat-icon-box red">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22"><path d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 003.54 21H20.46A2 2 0 0022.18 18L13.71 3.86A2 2 0 0010.29 3.86Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
        </div>
        <div class="stat-card">
          <div>
            <p class="stat-label">Paid This Month</p>
            <h2 class="stat-value" id="statPaid">$2,490</h2>
            <span class="stat-sub positive">+8% from last month</span>
          </div>
          <div class="stat-icon-box green">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22"><path d="M22 11.08V12A10 10 0 1112 2a10 10 0 0110 9.92" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </div>
        </div>
        <div class="stat-card">
          <div>
            <p class="stat-label">Pending Review</p>
            <h2 class="stat-value" id="statPending">3</h2>
            <span class="stat-sub urgent" id="statUrgent">3 urgent</span>
          </div>
          <div class="stat-icon-box yellow">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="table-card">
        <table class="invoice-table" id="invoiceTable">
          <thead>
            <tr>
              <th>Invoice ID</th>
              <th>Expert</th>
              <th>Consultation</th>
              <th>Amount</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="invoiceTableBody">
            <!-- filled by JS -->
          </tbody>
        </table>
        <div class="table-footer">
          <span id="showingText" class="showing-text">Showing 1 to 5 of 12 results</span>
          <div id="pagination" class="pagination"></div>
        </div>
      </div>

    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-brand-top">
            <div class="footer-logo-box"><img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="footer-logo"></div>
            <div><h3>Sproutly</h3><span>by AVI</span></div>
          </div>
          <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
        </div>
        <div class="footer-links">
          <h4>About Us</h4>
          <a href="#">Our Team</a><a href="#">Blog</a><a href="#">Privacy Policy</a>
        </div>
        <div class="footer-contact">
          <h4>Contact</h4>
          <p><i class="fa-solid fa-envelope"></i> sproutly@gmail.com</p>
          <p><i class="fa-solid fa-phone"></i> +62 851 5693 2186</p>
          <div class="social-icons">
            <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">&copy; 2025 Sproutly by AVI. All rights reserved.</div>
    </footer>

  </main>
</div>

<script>
// ── DATA ─────────────────────────────────────────────────────
var invoices = [
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
  { id:"#INV-012", expert:"Tom Walker",          role:"Agroforestry Specialist",  avatar:"https://randomuser.me/api/portraits/men/67.jpg",   consultation:"Cover Crop Strategy",             amount:340,  due:"Jan 25, 2025", status:"Paid"    }
];
var nextId = 13;
var currentPage = 1;
var PER_PAGE = 5;

function fmt(n){ return "$" + Number(n).toLocaleString(); }
function badgeCls(s){ return {Paid:"badge-paid",Pending:"badge-pending",Refund:"badge-refund"}[s]||"badge-pending"; }

function getFiltered(){
  var status = document.getElementById("filterStatus").value;
  var kw = document.getElementById("filterSearch").value.trim().toLowerCase();
  return invoices.filter(function(inv){
    var ms = !status || inv.status === status;
    var mk = !kw || inv.expert.toLowerCase().includes(kw) || inv.consultation.toLowerCase().includes(kw) || inv.id.toLowerCase().includes(kw);
    return ms && mk;
  });
}

function renderTable(){
  var filtered = getFiltered();
  var totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
  if(currentPage > totalPages) currentPage = 1;
  var start = (currentPage-1)*PER_PAGE;
  var items = filtered.slice(start, start+PER_PAGE);

  var tbody = document.getElementById("invoiceTableBody");
  if(items.length === 0){
    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:40px;color:#9aaa9e;font-size:14px;">No invoices found.</td></tr>';
  } else {
    tbody.innerHTML = items.map(function(inv){
      return '<tr>' +
        '<td><span class="inv-id">'+inv.id+'</span></td>' +
        '<td><div class="expert-cell">' +
          '<img src="'+inv.avatar+'" class="expert-avatar" alt="'+inv.expert+'" onerror="this.src=\'https://ui-avatars.com/api/?name='+encodeURIComponent(inv.expert)+'&background=76ead0&color=1a2636&size=80\'">' +
          '<div><div class="expert-cell-name">'+inv.expert+'</div><div class="expert-cell-role">'+inv.role+'</div></div>' +
        '</div></td>' +
        '<td>'+inv.consultation+'</td>' +
        '<td><strong>'+fmt(inv.amount)+'</strong></td>' +
        '<td style="color:#7a8e9a">'+inv.due+'</td>' +
        '<td><span class="badge '+badgeCls(inv.status)+'">'+inv.status+'</span></td>' +
        '<td><button class="action-btn" onclick="dlInvoice(\''+inv.id+'\')" title="Download">' +
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' +
        '</button></td>' +
      '</tr>';
    }).join("");
  }

  var total = filtered.length;
  var from = total===0 ? 0 : start+1;
  var to = Math.min(start+PER_PAGE, total);
  document.getElementById("showingText").textContent = "Showing "+from+" to "+to+" of "+total+" results";

  // Stats
  var paid    = filtered.filter(function(i){return i.status==="Paid";}).reduce(function(s,i){return s+i.amount;},0);
  var refund  = filtered.filter(function(i){return i.status==="Refund";}).reduce(function(s,i){return s+i.amount;},0);
  var pending = filtered.filter(function(i){return i.status==="Pending";}).length;
  document.getElementById("statPaid").textContent = fmt(paid);
  document.getElementById("statOutstanding").textContent = fmt(refund);
  document.getElementById("statPending").textContent = pending;
  document.getElementById("statUrgent").textContent = pending > 0 ? Math.min(pending,3)+" urgent" : "none";

  // Pagination
  var pg = document.getElementById("pagination");
  pg.innerHTML = "";
  var prev = document.createElement("button");
  prev.className="page-btn"; prev.textContent="Previous"; prev.disabled=(currentPage===1);
  prev.onclick=function(){currentPage--;renderTable();};
  pg.appendChild(prev);
  for(var i=1;i<=totalPages;i++){
    (function(p){
      var b=document.createElement("button");
      b.className="page-btn"+(p===currentPage?" active":"");
      b.textContent=p;
      b.onclick=function(){currentPage=p;renderTable();};
      pg.appendChild(b);
    })(i);
  }
  var nxt=document.createElement("button");
  nxt.className="page-btn"; nxt.textContent="Next"; nxt.disabled=(currentPage===totalPages);
  nxt.onclick=function(){currentPage++;renderTable();};
  pg.appendChild(nxt);
}

// ── Sidebar (exact dashboard-user pattern) ────────────────────
var menuToggle  = document.getElementById("menuToggle");
var sidebar     = document.getElementById("sidebar");
var mainContent = document.getElementById("mainContent");

function openSidebar(){
  if(window.innerWidth<=768){sidebar.classList.add("show");sidebar.classList.remove("closed");}
  else{sidebar.classList.remove("closed");mainContent.classList.add("shifted");mainContent.classList.remove("full");}
}
function closeSidebar(){
  sidebar.classList.add("closed");sidebar.classList.remove("show");
  mainContent.classList.remove("shifted");mainContent.classList.add("full");
}
function isSidebarOpen(){
  return window.innerWidth<=768?sidebar.classList.contains("show"):!sidebar.classList.contains("closed");
}
menuToggle.addEventListener("click",function(){isSidebarOpen()?closeSidebar():openSidebar();});
document.addEventListener("click",function(e){
  if(window.innerWidth<=768&&isSidebarOpen()&&!sidebar.contains(e.target)&&!menuToggle.contains(e.target))closeSidebar();
});
window.addEventListener("resize",function(){
  if(window.innerWidth>768)sidebar.classList.remove("show");
  else{mainContent.classList.remove("shifted");mainContent.classList.add("full");}
});

// ── Filter ────────────────────────────────────────────────────
document.getElementById("filterToggle").addEventListener("click",function(){
  document.getElementById("filterPanel").classList.toggle("hidden");
  this.classList.toggle("active");
});
document.getElementById("filterReset").addEventListener("click",function(){
  document.getElementById("filterStatus").value="";
  document.getElementById("filterSearch").value="";
  currentPage=1;renderTable();
});
document.getElementById("filterStatus").addEventListener("change",function(){currentPage=1;renderTable();});
document.getElementById("filterSearch").addEventListener("input",function(){currentPage=1;renderTable();});


// ── Toast notification ────────────────────────────────────────
function showToast(title, message) {
  var old = document.getElementById('sproutlyToast');
  if (old) old.remove();

  if (!document.getElementById('toastStyle')) {
    var s = document.createElement('style');
    s.id = 'toastStyle';
    s.textContent =
      '@keyframes toastIn{from{opacity:0;transform:translateY(24px) scale(0.94)}to{opacity:1;transform:translateY(0) scale(1)}}' +
      '@keyframes toastOut{from{opacity:1;transform:translateY(0) scale(1)}to{opacity:0;transform:translateY(24px) scale(0.94)}}';
    document.head.appendChild(s);
  }

  var toast = document.createElement('div');
  toast.id = 'sproutlyToast';
  toast.style.cssText =
    'position:fixed;bottom:28px;right:28px;background:#fff;' +
    'border:1px solid rgba(196,228,214,0.7);border-radius:18px;' +
    'box-shadow:0 16px 48px rgba(72,93,104,0.18);' +
    'padding:16px 20px;display:flex;align-items:flex-start;gap:14px;' +
    'min-width:320px;max-width:400px;z-index:9999;font-family:Inter,sans-serif;' +
    'animation:toastIn 0.32s cubic-bezier(.34,1.56,.64,1) both';

  toast.innerHTML =
    '<div style="flex-shrink:0;width:36px;height:36px;border-radius:50%;background:rgba(34,192,100,0.12);display:flex;align-items:center;justify-content:center">' +
      '<svg viewBox="0 0 24 24" fill="none" width="18" height="18"><path d="M22 11.08V12A10 10 0 1112 2a10 10 0 0110 9.92" stroke="#22a05a" stroke-width="2.2" stroke-linecap="round"/><path d="M22 4L12 14.01L9 11.01" stroke="#22a05a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
    '</div>' +
    '<div style="flex:1;min-width:0">' +
      '<div style="font-size:14px;font-weight:700;color:#1a2636;margin-bottom:3px">' + title + '</div>' +
      '<div style="font-size:13px;color:#607084;line-height:1.5">' + message + '</div>' +
    '</div>' +
    '<button onclick="this.parentElement.remove()" style="flex-shrink:0;border:none;background:rgba(240,245,242,0.9);border-radius:8px;width:28px;height:28px;cursor:pointer;color:#9aaa9e;font-size:14px;display:flex;align-items:center;justify-content:center">' +
      '&times;' +
    '</button>';

  document.body.appendChild(toast);

  setTimeout(function () {
    toast.style.animation = 'toastOut 0.25s ease forwards';
    setTimeout(function () { if (toast.parentElement) toast.remove(); }, 260);
  }, 3500);
}

function dlInvoice(id) {
  var inv = invoices.find(function (i) { return i.id === id; });
  if (!inv) return;
  showToast(
    'Invoice Downloaded',
    inv.id + ' — ' + inv.expert + ' has been downloaded to your device.'
  );
}

// ── Init ─────────────────────────────────────────────────────
renderTable();
</script>
</body>
</html>