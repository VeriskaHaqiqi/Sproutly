// ── Data ─────────────────────────────────────────────────────
var consultations = [
  { id:"#CS001", expert:"Michael Chen",      role:"Organic Farmer",        avatar:"https://randomuser.me/api/portraits/men/32.jpg",    topic:"Crop Disease Analysis",       date:"Mar 15, 2026", status:"Completed", payment:"Paid",     fee:"$450", duration:"60 min", notes:"Client reported early signs of fungal infection in tomato plants. Recommended organic fungicide treatment and improved drainage schedule." },
  { id:"#CS002", expert:"Emma Rodriguez",    role:"Smallholder Farmer",    avatar:"https://randomuser.me/api/portraits/women/65.jpg",  topic:"Soil Nutrition Assessment",   date:"Mar 12, 2026", status:"Ongoing",   payment:"Paid",     fee:"$320", duration:"45 min", notes:"Soil samples show nitrogen deficiency. Follow-up session scheduled to review progress of fertilizer plan." },
  { id:"#CS003", expert:"David Thompson",    role:"Home Gardener",         avatar:"https://randomuser.me/api/portraits/men/55.jpg",    topic:"Pest Control Strategy",       date:"Mar 10, 2026", status:"Cancelled", payment:"Refunded", fee:"$280", duration:"—",      notes:"Consultation cancelled due to scheduling conflict on client side. Full refund processed within 3 business days." },
  { id:"#CS004", expert:"Sarah Mitchell",    role:"Vegetable Farmer",      avatar:"https://randomuser.me/api/portraits/women/44.jpg",  topic:"Irrigation Planning",         date:"Mar 8, 2026",  status:"Completed", payment:"Paid",     fee:"$520", duration:"75 min", notes:"Designed a drip irrigation system for client's 2-hectare vegetable farm. Estimated 30% water savings after implementation." },
  { id:"#CS005", expert:"James Okafor",      role:"Commercial Grower",     avatar:"https://randomuser.me/api/portraits/men/11.jpg",    topic:"Organic Farming Transition",  date:"Mar 5, 2026",  status:"Ongoing",   payment:"Paid",     fee:"$680", duration:"90 min", notes:"Month 2 of 6-month organic transition program. Soil biome improving steadily. Next review scheduled in 3 weeks." },
  { id:"#CS006", expert:"Alicia Warren",     role:"Greenhouse Operator",   avatar:"https://randomuser.me/api/portraits/women/51.jpg",  topic:"Greenhouse Optimization",     date:"Feb 28, 2026", status:"Completed", payment:"Paid",     fee:"$390", duration:"55 min", notes:"Optimized temperature and humidity controls for client's greenhouse. Year-round tomato yield projected to increase by 25%." },
  { id:"#CS007", expert:"Robert Park",       role:"Urban Farmer",          avatar:"https://randomuser.me/api/portraits/men/45.jpg",    topic:"Composting Techniques",       date:"Feb 22, 2026", status:"Completed", payment:"Paid",     fee:"$240", duration:"40 min", notes:"Introduced vermicomposting and bokashi systems to help client reduce kitchen waste and enrich soil organically." },
  { id:"#CS008", expert:"Olivia Nguyen",     role:"Rice Farmer",           avatar:"https://randomuser.me/api/portraits/women/54.jpg",  topic:"Water Management",            date:"Feb 18, 2026", status:"Cancelled", payment:"Refunded", fee:"$310", duration:"—",      notes:"Session cancelled due to weather events affecting client's field. Refunded in full. Client to reschedule next dry season." },
  { id:"#CS009", expert:"Carlos Mendez",     role:"Fruit Orchard Owner",   avatar:"https://randomuser.me/api/portraits/men/22.jpg",    topic:"Plant Nutrition Basics",      date:"Feb 14, 2026", status:"Ongoing",   payment:"Paid",     fee:"$290", duration:"50 min", notes:"Three-session program on macro and micronutrient management for orchard crops. Session 1 of 3 completed successfully." },
  { id:"#CS010", expert:"Nina Hartmann",     role:"Permaculture Designer", avatar:"https://randomuser.me/api/portraits/women/33.jpg",  topic:"Cover Cropping Strategy",     date:"Feb 10, 2026", status:"Completed", payment:"Paid",     fee:"$420", duration:"65 min", notes:"Designed seasonal cover crop rotation to improve soil health and reduce erosion on client's sloping farmland." },
  { id:"#CS011", expert:"Tom Walker",        role:"Backyard Grower",       avatar:"https://randomuser.me/api/portraits/men/67.jpg",    topic:"Seed Selection Guide",        date:"Feb 5, 2026",  status:"Completed", payment:"Paid",     fee:"$180", duration:"30 min", notes:"Recommended high-yield disease-resistant seed varieties suited to client's local soil and climate conditions." },
  { id:"#CS012", expert:"Lisa Fernandez",    role:"Community Garden Lead", avatar:"https://randomuser.me/api/portraits/women/28.jpg",  topic:"Harvest Planning",            date:"Feb 1, 2026",  status:"Cancelled", payment:"Refunded", fee:"$260", duration:"—",      notes:"Cancelled due to emergency on client's side. Refunded in full. Client requested rescheduling when available." },
];

var PER_PAGE = 5;
var currentPage = 1;

function statusClass(s){ return {Completed:"status-completed", Ongoing:"status-ongoing", Cancelled:"status-cancelled"}[s]||""; }
function payClass(p){ return p==="Refunded"?"pay-refunded":"pay-paid"; }

function getFiltered(){
  var q  = document.getElementById("searchInput").value.trim().toLowerCase();
  var st = document.getElementById("statusFilter").value;
  var py = document.getElementById("paymentFilter").value;
  var dt = document.getElementById("dateFilter").value;

  // Build a readable date string from the date input for comparison
  // dt is "YYYY-MM-DD", c.date is like "Mar 15, 2026"
  var dtStr = "";
  if (dt) {
    // Add T12:00:00 to avoid timezone shifting the day
    var d = new Date(dt + "T12:00:00");
    dtStr = d.toLocaleDateString("en-US", { month:"short", day:"numeric", year:"numeric" });
    // "Mar 15, 2026" — normalize spaces
    dtStr = dtStr.replace(/\s+/g, " ").trim();
  }

  return consultations.filter(function(c){
    var ms = !q  || c.expert.toLowerCase().includes(q) || c.topic.toLowerCase().includes(q) || c.id.toLowerCase().includes(q);
    var mv = !st || c.status  === st;
    var mp = !py || c.payment === py;
    // Normalize c.date for comparison too
    var cDate = c.date.replace(/\s+/g, " ").trim();
    var md = !dtStr || cDate === dtStr;
    return ms && mv && mp && md;
  });
}

function renderTable(){
  var filtered   = getFiltered();
  var totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
  if(currentPage > totalPages) currentPage = 1;
  var items = filtered.slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);

  var tbody = document.getElementById("tableBody");
  if(items.length === 0){
    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:48px;color:#9aaa9e;font-size:14px;">No consultations found.</td></tr>';
  } else {
    tbody.innerHTML = items.map(function(c){
      return '<tr>' +
        '<td class="td-id">'+c.id+'</td>' +
        '<td><div class="expert-cell"><img src="'+c.avatar+'" class="expert-av" alt="'+c.expert+'" onerror="this.src=\'https://ui-avatars.com/api/?name='+encodeURIComponent(c.expert)+'&background=76ead0&color=1a2636\'"><span>'+c.expert+'</span></div></td>' +
        '<td>'+c.topic+'</td>' +
        '<td class="td-date">'+c.date+'</td>' +
        '<td><span class="status-badge '+statusClass(c.status)+'">'+c.status+'</span></td>' +
        '<td><span class="pay-badge '+payClass(c.payment)+'">'+c.payment+'</span></td>' +
        '<td><button class="view-btn" onclick="openDetail(\''+c.id+'\')">View Details</button></td>' +
      '</tr>';
    }).join("");
  }

  renderPagination(totalPages);
}

function renderPagination(totalPages){
  var pg = document.getElementById("pagination");
  pg.innerHTML = "";

  var prev = document.createElement("button");
  prev.className = "pg-btn pg-arrow"; prev.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
  prev.disabled = currentPage === 1;
  prev.onclick = function(){ currentPage--; renderTable(); };
  pg.appendChild(prev);

  for(var i=1;i<=totalPages;i++){
    (function(p){
      var b = document.createElement("button");
      b.className = "pg-btn" + (p===currentPage?" active":"");
      b.textContent = p;
      b.onclick = function(){ currentPage=p; renderTable(); };
      pg.appendChild(b);
    })(i);
  }

  var next = document.createElement("button");
  next.className = "pg-btn pg-arrow"; next.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
  next.disabled = currentPage === totalPages;
  next.onclick = function(){ currentPage++; renderTable(); };
  pg.appendChild(next);
}

function openDetail(id){
  var c = consultations.find(function(x){ return x.id===id; });
  if(!c) return;

  var statusCls = statusClass(c.status);
  var payCls    = payClass(c.payment);

  document.getElementById("modalBody").innerHTML =
    '<div class="detail-expert-row">'  +
      '<img src="'+c.avatar+'" class="detail-av" alt="'+c.expert+'" onerror="this.src=\'https://ui-avatars.com/api/?name='+encodeURIComponent(c.expert)+'&background=76ead0&color=1a2636\'">' +
      '<div>' +
        '<div class="detail-client-name">'+c.expert+'</div>' +
        '<div class="detail-expert-role">'+c.role+'</div>' +
      '</div>' +
    '</div>' +
    '<div class="detail-grid">' +
      '<div class="detail-item"><span class="detail-label">Consultation ID</span><span class="detail-value td-id">'+c.id+'</span></div>' +
      '<div class="detail-item"><span class="detail-label">Topic</span><span class="detail-value">'+c.topic+'</span></div>' +
      '<div class="detail-item"><span class="detail-label">Date</span><span class="detail-value">'+c.date+'</span></div>' +
      '<div class="detail-item"><span class="detail-label">Duration</span><span class="detail-value">'+c.duration+'</span></div>' +
      '<div class="detail-item"><span class="detail-label">Status</span><span class="detail-value"><span class="status-badge '+statusCls+'">'+c.status+'</span></span></div>' +
      '<div class="detail-item"><span class="detail-label">Payment</span><span class="detail-value"><span class="pay-badge '+payCls+'">'+c.payment+'</span></span></div>' +
      '<div class="detail-item"><span class="detail-label">Fee</span><span class="detail-value" style="font-weight:700">'+c.fee+'</span></div>' +
    '</div>' +
    '<div class="detail-notes">' +
      '<div class="detail-label" style="margin-bottom:8px">Session Notes</div>' +
      '<p>'+c.notes+'</p>' +
    '</div>';

  document.getElementById("detailModal").classList.remove("hidden");
}

function closeModal(){
  document.getElementById("detailModal").classList.add("hidden");
}

document.getElementById("modalClose").addEventListener("click", closeModal);
document.getElementById("detailModal").addEventListener("click", function(e){ if(e.target===this) closeModal(); });
document.addEventListener("keydown", function(e){ if(e.key==="Escape") closeModal(); });

["searchInput","statusFilter","paymentFilter","dateFilter"].forEach(function(id){
  document.getElementById(id).addEventListener("input",  function(){ currentPage=1; renderTable(); });
  document.getElementById(id).addEventListener("change", function(){ currentPage=1; renderTable(); });
});

// ── Sidebar ───────────────────────────────────────────────────
var sidebar     = document.getElementById("sidebar");
var mainContent = document.getElementById("mainContent");
var toggler     = document.getElementById("sidebarToggle");

function openSB(){ if(window.innerWidth<=768){sidebar.classList.add("show");sidebar.classList.remove("closed");}else{sidebar.classList.remove("closed");mainContent.classList.add("shifted");mainContent.classList.remove("full");} }
function closeSB(){ sidebar.classList.add("closed");sidebar.classList.remove("show");mainContent.classList.remove("shifted");mainContent.classList.add("full"); }
function isSBOpen(){ return window.innerWidth<=768?sidebar.classList.contains("show"):!sidebar.classList.contains("closed"); }

toggler.addEventListener("click", function(){ isSBOpen()?closeSB():openSB(); });
document.querySelectorAll(".menu-link").forEach(function(l){ l.addEventListener("click", closeSB); });
document.addEventListener("click", function(e){ if(window.innerWidth<=768&&isSBOpen()&&!sidebar.contains(e.target)&&!toggler.contains(e.target)) closeSB(); });
window.addEventListener("resize", function(){ if(window.innerWidth>768) sidebar.classList.remove("show"); else{mainContent.classList.remove("shifted");mainContent.classList.add("full");} });

renderTable();