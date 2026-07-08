/* =====================
   TOGGLE SWITCH — with initial state guard
===================== */
document.querySelectorAll('.toggle-input').forEach(toggle => {
  // Set initial state correctly
  const card = toggle.closest('.day-card');
  const slotsArea = card.querySelector('.day-slots');
  const isActive = toggle.checked;

  // Ensure initial state matches checkbox
  if (isActive) {
    card.classList.remove('day-card--inactive');
    card.classList.add('day-card--active');
    slotsArea.style.display = '';
  } else {
    card.classList.remove('day-card--active');
    card.classList.add('day-card--inactive');
    slotsArea.style.display = 'none';
  }

  // ONLY respond to USER clicks, not programmatic changes
  toggle.addEventListener('change', function(e) {
    // Skip if this is triggered by code, not user
    if (!e.isTrusted) return;

    const card = this.closest('.day-card');
    const slotsArea = card.querySelector('.day-slots');
    const unavLabel = card.querySelector('.unavailable-label');
    const isActive = this.checked;

    if (isActive) {
      card.classList.replace('day-card--inactive', 'day-card--active');
      slotsArea.style.display = '';

      const day = card.dataset.day;
      const existingSlots = slotsArea.querySelectorAll('.slot-row');
      if (!existingSlots.length) {
        const row = createSlotRow(day, 0);
        slotsArea.insertBefore(row, slotsArea.querySelector('.btn-add-slot'));
      }

      if (unavLabel) unavLabel.remove();
    } else {
      card.classList.replace('day-card--active', 'day-card--inactive');
      slotsArea.style.display = 'none';

      if (!card.querySelector('.unavailable-label')) {
        const label = document.createElement('span');
        label.className = 'unavailable-label';
        label.textContent = 'Unavailable';
        card.querySelector('.day-header').appendChild(label);
      }
    }
  });
});