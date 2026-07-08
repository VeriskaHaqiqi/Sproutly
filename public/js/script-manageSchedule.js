'use strict';

/* =====================
   SIDEBAR TOGGLE
===================== */
(function () {
  const sidebar       = document.getElementById("sidebar");
  const mainContent   = document.getElementById("mainContent");
  const sidebarToggle = document.getElementById("sidebarToggle") || document.getElementById("menuToggle");

  if (!sidebar || !mainContent || !sidebarToggle) return;

  function openSidebar() {
    if (window.innerWidth <= 768) {
      sidebar.classList.add("show");
      sidebar.classList.remove("closed");
    } else {
      sidebar.classList.remove("closed");
      mainContent.classList.add("shifted");
      mainContent.classList.remove("full");
    }
  }

  function closeSidebar() {
    sidebar.classList.add("closed");
    sidebar.classList.remove("show");
    mainContent.classList.remove("shifted");
    mainContent.classList.add("full");
  }

  function isSidebarOpen() {
    return window.innerWidth <= 768
      ? sidebar.classList.contains("show")
      : !sidebar.classList.contains("closed");
  }

  sidebarToggle.addEventListener("click", function () {
    isSidebarOpen() ? closeSidebar() : openSidebar();
  });

  document.querySelectorAll(".menu-link").forEach(function (link) {
    link.addEventListener("click", closeSidebar);
  });

  document.addEventListener("click", function (e) {
    if (window.innerWidth <= 768 && isSidebarOpen() &&
        !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
      closeSidebar();
    }
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
      sidebar.classList.remove("show");
    } else {
      mainContent.classList.remove("shifted");
      mainContent.classList.add("full");
    }
  });

  sidebar.classList.add("closed");
  mainContent.classList.add("full");
})();


/* =====================
   SLOT HELPERS
===================== */
function nextSlotIndex(container) {
  const rows = container.querySelectorAll('.slot-row');
  if (!rows.length) return 0;
  let max = 0;
  rows.forEach(function (row) {
    const idx = parseInt(row.dataset.slot, 10);
    if (idx > max) max = idx;
  });
  return max + 1;
}

function createSlotRow(day, idx, startVal, endVal) {
  startVal = startVal || '09:00';
  endVal = endVal || '17:00';
  const row = document.createElement('div');
  row.className = 'slot-row';
  row.dataset.slot = idx;

  const pill = document.createElement('div');
  pill.className = 'slot-pill';

  const startInput = document.createElement('input');
  startInput.type = 'time';
  startInput.name = `days[${day}][slots][${idx}][start]`;
  startInput.value = startVal;
  startInput.className = 'time-input';

  const sep = document.createElement('span');
  sep.className = 'slot-sep';
  sep.textContent = '–';

  const endInput = document.createElement('input');
  endInput.type = 'time';
  endInput.name = `days[${day}][slots][${idx}][end]`;
  endInput.value = endVal;
  endInput.className = 'time-input';

  const editBtn = document.createElement('button');
  editBtn.type = 'button';
  editBtn.className = 'slot-edit-btn';
  editBtn.title = 'Edit';
  editBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>';
  editBtn.addEventListener('click', function () {
    startInput.focus();
  });

  const removeBtn = document.createElement('button');
  removeBtn.type = 'button';
  removeBtn.className = 'slot-remove-btn';
  removeBtn.title = 'Remove';
  removeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
  removeBtn.addEventListener('click', function () {
    const r = this.closest('.slot-row');
    if (r) r.remove();
  });

  pill.append(startInput, sep, endInput, editBtn, removeBtn);
  row.appendChild(pill);
  return row;
}

/* =====================
   ADD SLOT
===================== */
document.getElementById('daysList').addEventListener('click', function (e) {
  const addBtn = e.target.closest('.btn-add-slot');
  if (!addBtn) return;
  const day = addBtn.dataset.day;
  if (!day) return;
  const container = document.getElementById('slots-' + day);
  if (!container) return;
  const idx = nextSlotIndex(container);
  const row = createSlotRow(day, idx);
  container.insertBefore(row, addBtn);
});


/* =====================
   TOGGLE SWITCH
===================== */
document.querySelectorAll('.toggle-input').forEach(function (toggle) {
  const card = toggle.closest('.day-card');
  const slotsArea = card.querySelector('.day-slots');
  const isActive = toggle.checked;

  // Set initial state
  if (isActive) {
    card.classList.remove('day-card--inactive');
    card.classList.add('day-card--active');
    slotsArea.style.display = '';
  } else {
    card.classList.remove('day-card--active');
    card.classList.add('day-card--inactive');
    slotsArea.style.display = 'none';
  }

  toggle.addEventListener('change', function () {
    const card2 = this.closest('.day-card');
    const slotsArea2 = card2.querySelector('.day-slots');
    const unavLabel = card2.querySelector('.unavailable-label');
    const isActive2 = this.checked;

    if (isActive2) {
      card2.classList.replace('day-card--inactive', 'day-card--active');
      slotsArea2.style.display = '';
      const day = card2.dataset.day;
      const existing = slotsArea2.querySelectorAll('.slot-row');
      if (!existing.length) {
        const row = createSlotRow(day, 0);
        slotsArea2.insertBefore(row, slotsArea2.querySelector('.btn-add-slot'));
      }
      if (unavLabel) unavLabel.remove();
    } else {
      card2.classList.replace('day-card--active', 'day-card--inactive');
      slotsArea2.style.display = 'none';
      if (!card2.querySelector('.unavailable-label')) {
        const label = document.createElement('span');
        label.className = 'unavailable-label';
        label.textContent = 'Unavailable';
        card2.querySelector('.day-header').appendChild(label);
      }
    }
  });
});


/* =====================
   FORM SUBMIT
===================== */
var scheduleForm = document.getElementById('scheduleForm');
if (scheduleForm) {
  scheduleForm.addEventListener('submit', function (e) {
    // Validasi: pastikan end time > start time
    var valid = true;
    document.querySelectorAll('.day-card--active .slot-row').forEach(function (row) {
      var inputs = row.querySelectorAll('.time-input');
      if (inputs.length === 2) {
        var start = inputs[0].value;
        var end = inputs[1].value;
        if (start && end && start >= end) {
          valid = false;
          row.querySelector('.slot-pill').style.borderColor = '#e05c5c';
          row.querySelector('.slot-pill').style.boxShadow = '0 0 0 3px rgba(224,92,92,.15)';
        } else {
          row.querySelector('.slot-pill').style.borderColor = '';
          row.querySelector('.slot-pill').style.boxShadow = '';
        }
      }
    });

    if (!valid) {
      e.preventDefault();
      alert('End time must be after start time for all slots.');
      return;
    }

    // Jika valid, form akan submit secara normal
    // Tampilkan toast atau loading jika perlu
  });
}