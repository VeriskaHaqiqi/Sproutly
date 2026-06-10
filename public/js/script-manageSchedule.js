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
      sidebar.classList.add("show"); sidebar.classList.remove("closed");
    } else {
      sidebar.classList.remove("closed");
      mainContent.classList.add("shifted"); mainContent.classList.remove("full");
    }
    document.body.classList.add("sidebar-open");
  }

  function closeSidebar() {
    sidebar.classList.add("closed"); sidebar.classList.remove("show");
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
    document.body.classList.remove("sidebar-open");
  }

  function isSidebarOpen() {
    return window.innerWidth <= 768
      ? sidebar.classList.contains("show")
      : !sidebar.classList.contains("closed");
  }

  sidebarToggle.addEventListener("click", () => isSidebarOpen() ? closeSidebar() : openSidebar());

  document.querySelectorAll(".menu-link").forEach((link) => {
    link.addEventListener("click", () => closeSidebar());
  });

  document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768 && isSidebarOpen() &&
        !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
      closeSidebar();
    }
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) sidebar.classList.remove("show");
    else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
  });

  sidebar.classList.add("closed");
})();


/* =====================
   HELPERS
===================== */

/** Return current highest slot index in a container */
function nextSlotIndex(slotsContainer) {
  const rows = slotsContainer.querySelectorAll('.slot-row');
  if (!rows.length) return 0;
  return Math.max(...[...rows].map(r => parseInt(r.dataset.slot, 10))) + 1;
}

/** Build SVG string for buttons */
const ICON_EDIT   = `<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>`;
const ICON_REMOVE = `<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>`;

/** Create a brand-new slot row element */
function createSlotRow(day, idx, startVal = '09:00', endVal = '17:00') {
  const row = document.createElement('div');
  row.className   = 'slot-row';
  row.dataset.slot = idx;

  const pill = document.createElement('div');
  pill.className = 'slot-pill';

  // Start time
  const startInput = document.createElement('input');
  startInput.type  = 'time';
  startInput.name  = `days[${day}][slots][${idx}][start]`;
  startInput.value = startVal;
  startInput.className = 'time-input';

  // Separator
  const sep = document.createElement('span');
  sep.className   = 'slot-sep';
  sep.textContent = '–';

  // End time
  const endInput = document.createElement('input');
  endInput.type  = 'time';
  endInput.name  = `days[${day}][slots][${idx}][end]`;
  endInput.value = endVal;
  endInput.className = 'time-input';

  // Edit btn (toggles time-input visibility - just focuses start)
  const editBtn = document.createElement('button');
  editBtn.type      = 'button';
  editBtn.className = 'slot-edit-btn';
  editBtn.title     = 'Edit';
  editBtn.innerHTML = ICON_EDIT;
  editBtn.addEventListener('click', () => startInput.focus());

  // Remove btn
  const removeBtn = document.createElement('button');
  removeBtn.type      = 'button';
  removeBtn.className = 'slot-remove-btn';
  removeBtn.title     = 'Remove';
  removeBtn.innerHTML = ICON_REMOVE;
  removeBtn.addEventListener('click', () => removeSlot(row));

  pill.append(startInput, sep, endInput, editBtn, removeBtn);
  row.appendChild(pill);
  return row;
}

/** Remove a slot row with animation */
function removeSlot(row) {
  row.style.transition = 'opacity .2s ease, transform .2s ease';
  row.style.opacity    = '0';
  row.style.transform  = 'scale(.92)';
  setTimeout(() => row.remove(), 220);
}

/* =====================
   ADD SLOT BUTTON HANDLER
===================== */
function handleAddSlot(day) {
  const container = document.getElementById(`slots-${day}`);
  if (!container) return;

  const addBtn = container.querySelector('.btn-add-slot');
  const idx    = nextSlotIndex(container);
  const row    = createSlotRow(day, idx);

  // Insert before the Add button
  container.insertBefore(row, addBtn);
}

/* =====================
   BIND EXISTING SLOT BUTTONS
   (for server-rendered rows on page load)
===================== */
function bindExistingSlots() {
  document.querySelectorAll('.slot-edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const startInput = btn.closest('.slot-pill').querySelector('.time-input');
      if (startInput) startInput.focus();
    });
  });

  document.querySelectorAll('.slot-remove-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const row = btn.closest('.slot-row');
      if (row) removeSlot(row);
    });
  });
}

/* =====================
   ADD SLOT BUTTONS (event delegation on days-list)
===================== */
document.getElementById('daysList').addEventListener('click', e => {
  const addBtn = e.target.closest('.btn-add-slot');
  if (addBtn) {
    const day = addBtn.dataset.day;
    if (day) handleAddSlot(day);
  }
});

/* =====================
   TOGGLE SWITCH — show/hide slots & unavailable label
===================== */
document.querySelectorAll('.toggle-input').forEach(toggle => {
  toggle.addEventListener('change', () => {
    const card       = toggle.closest('.day-card');
    const slotsArea  = card.querySelector('.day-slots');
    const unavLabel  = card.querySelector('.unavailable-label');
    const isActive   = toggle.checked;

    if (isActive) {
      // Activate card
      card.classList.replace('day-card--inactive', 'day-card--active');
      slotsArea.style.display = '';

      // If no slots yet, add a default one
      const day = card.dataset.day;
      const existingSlots = slotsArea.querySelectorAll('.slot-row');
      if (!existingSlots.length) {
        const row = createSlotRow(day, 0);
        slotsArea.insertBefore(row, slotsArea.querySelector('.btn-add-slot'));
      }

      if (unavLabel) unavLabel.remove();

    } else {
      // Deactivate card
      card.classList.replace('day-card--active', 'day-card--inactive');
      slotsArea.style.display = 'none';

      // Add "Unavailable" label if not present
      if (!card.querySelector('.unavailable-label')) {
        const label = document.createElement('span');
        label.className   = 'unavailable-label';
        label.textContent = 'Unavailable';
        card.querySelector('.day-header').appendChild(label);
      }
    }
  });
});

/* =====================
   INIT on load
===================== */
bindExistingSlots();

/* =====================
   FORM SUBMIT — validation
===================== */
const scheduleForm = document.getElementById('scheduleForm');
if (scheduleForm) {
  scheduleForm.addEventListener('submit', e => {
    let valid = true;

    document.querySelectorAll('.day-card--active').forEach(card => {
      const slots = card.querySelectorAll('.slot-row');
      slots.forEach(slot => {
        const [start, end] = slot.querySelectorAll('.time-input');
        if (start && end && start.value && end.value) {
          if (start.value >= end.value) {
            // Highlight error
            slot.querySelector('.slot-pill').style.borderColor = '#e05c5c';
            slot.querySelector('.slot-pill').style.boxShadow   = '0 0 0 3px rgba(224,92,92,.15)';
            valid = false;
          }
        }
      });
    });

    if (!valid) {
      e.preventDefault();
      showToast('End time must be after start time for all slots.', 'error');
      document.querySelector('.slot-pill[style]')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else {
      showToast('Schedule saved successfully!', 'success');
    }
  });

  // Clear pill error state on time change
  scheduleForm.addEventListener('change', e => {
    if (e.target.classList.contains('time-input')) {
      const pill = e.target.closest('.slot-pill');
      if (pill) { pill.style.borderColor = ''; pill.style.boxShadow = ''; }
    }
  });
}

/* =====================
   TOAST NOTIFICATION
===================== */
function showToast(message, type = 'info') {
  const existing = document.getElementById('sp-toast');
  if (existing) existing.remove();

  const toast = document.createElement('div');
  toast.id = 'sp-toast';
  toast.textContent = message;
  const isSucess = type === 'success';
  const isError  = type === 'error';
  Object.assign(toast.style, {
    position:     'fixed',
    bottom:       '30px',
    left:         '50%',
    transform:    'translateX(-50%)',
    background:   isError ? '#e05c5c' : isSucess ? '#76ead0' : '#76d7ea',
    color:        isError ? '#fff' : '#1a2e1a',
    padding:      '12px 28px',
    borderRadius: '50px',
    fontFamily:   'Inter, sans-serif',
    fontSize:     '0.875rem',
    fontWeight:   '600',
    boxShadow:    '0 4px 22px rgba(0,0,0,0.14)',
    zIndex:       '9999',
    opacity:      '0',
    transition:   'opacity .28s ease',
    whiteSpace:   'nowrap',
    pointerEvents:'none',
  });

  document.body.appendChild(toast);
  requestAnimationFrame(() => { toast.style.opacity = '1'; });
  setTimeout(() => {
    toast.style.opacity = '0';
    setTimeout(() => toast.remove(), 320);
  }, 3200);
}