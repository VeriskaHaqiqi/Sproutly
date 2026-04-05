/**
 * home.js — Sproutly Home Page
 * Handles: Sidebar toggle, Schedule add/delete with localStorage
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ========================
       SIDEBAR TOGGLE
    ======================== */
    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const hamburgerBtn   = document.getElementById('hamburgerBtn');
 
    function openSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('active');
        hamburgerBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
 
    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
        hamburgerBtn.classList.remove('active');
        document.body.style.overflow = '';
    }
 
    function toggleSidebar() {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    }
 
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', toggleSidebar);
    }
 
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
 
    // Tutup sidebar dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });
 
    /* ========================
       SIDEBAR MENU ACTIVE STATE
    ======================== */
    const menuItems = document.querySelectorAll('.menu-item');
 
    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            menuItems.forEach(function (i) { i.classList.remove('active'); });
            item.classList.add('active');
 
            // Tutup sidebar otomatis di layar kecil (mobile)
            if (window.innerWidth < 900) {
                setTimeout(closeSidebar, 200);
            }
        });
    });

    /* ========================
       SCHEDULE MANAGEMENT
    ======================== */
    const btnAddSchedule    = document.getElementById('btnAddSchedule');
    const btnCancelSchedule = document.getElementById('btnCancelSchedule');
    const btnSaveSchedule   = document.getElementById('btnSaveSchedule');
    const scheduleFormWrapper = document.getElementById('scheduleFormWrapper');
    const scheduleList      = document.getElementById('scheduleList');
    const scheduleEmpty     = document.getElementById('scheduleEmpty');

    const inputTitle    = document.getElementById('scheduleTitle');
    const inputPlant    = document.getElementById('schedulePlant');
    const inputDateTime = document.getElementById('scheduleDateTime');
    const inputNote     = document.getElementById('scheduleNote');

    // Load schedules from localStorage
    let schedules = JSON.parse(localStorage.getItem('sproutly_schedules') || '[]');

    function saveToStorage() {
        localStorage.setItem('sproutly_schedules', JSON.stringify(schedules));
    }

    function formatDateTime(datetimeStr) {
        if (!datetimeStr) return '';
        const d = new Date(datetimeStr);
        const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const dayName = days[d.getDay()];
        const date    = d.getDate();
        const month   = months[d.getMonth()];
        const year    = d.getFullYear();
        const hours   = String(d.getHours()).padStart(2, '0');
        const minutes = String(d.getMinutes()).padStart(2, '0');
        return `${dayName}, ${date} ${month} ${year} • ${hours}:${minutes}`;
    }

    function renderSchedules() {
        scheduleList.innerHTML = '';

        if (schedules.length === 0) {
            scheduleEmpty.classList.add('visible');
            return;
        }

        scheduleEmpty.classList.remove('visible');

        // Sort by datetime ascending
        const sorted = [...schedules].sort((a, b) => new Date(a.datetime) - new Date(b.datetime));

        sorted.forEach(function (item) {
            const el = document.createElement('div');
            el.className = 'schedule-item';
            el.dataset.id = item.id;

            el.innerHTML = `
                <div class="schedule-dot"></div>
                <div class="schedule-item-body">
                    <div class="schedule-item-title">${escapeHtml(item.title)}</div>
                    <div class="schedule-item-meta">
                        ${item.plant ? `<span>🌱 ${escapeHtml(item.plant)}</span>` : ''}
                        ${item.datetime ? `<span>🕐 ${formatDateTime(item.datetime)}</span>` : ''}
                    </div>
                    ${item.note ? `<div class="schedule-item-note">${escapeHtml(item.note)}</div>` : ''}
                </div>
                <button class="btn-delete-schedule" data-id="${item.id}" title="Hapus jadwal">
                    ×
                </button>
            `;

            scheduleList.appendChild(el);
        });

        // Attach delete handlers
        scheduleList.querySelectorAll('.btn-delete-schedule').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = btn.dataset.id;
                deleteSchedule(id);
            });
        });
    }

    function deleteSchedule(id) {
        schedules = schedules.filter(function (s) { return s.id !== id; });
        saveToStorage();
        renderSchedules();
    }

    function openForm() {
        scheduleFormWrapper.classList.add('open');
        inputTitle.focus();
        btnAddSchedule.style.display = 'none';
    }

    function closeForm() {
        scheduleFormWrapper.classList.remove('open');
        btnAddSchedule.style.display = '';
        clearForm();
    }

    function clearForm() {
        inputTitle.value    = '';
        inputPlant.value    = '';
        inputDateTime.value = '';
        inputNote.value     = '';
    }

    btnAddSchedule.addEventListener('click', openForm);

    btnCancelSchedule.addEventListener('click', closeForm);

    btnSaveSchedule.addEventListener('click', function () {
        const title    = inputTitle.value.trim();
        const plant    = inputPlant.value.trim();
        const datetime = inputDateTime.value;
        const note     = inputNote.value.trim();

        if (!title) {
            inputTitle.focus();
            inputTitle.style.borderColor = '#e05050';
            setTimeout(function () {
                inputTitle.style.borderColor = '';
            }, 1500);
            return;
        }

        const newSchedule = {
            id:       Date.now().toString(),
            title:    title,
            plant:    plant,
            datetime: datetime,
            note:     note
        };

        schedules.push(newSchedule);
        saveToStorage();
        renderSchedules();
        closeForm();
    });

    // Enter key in inputs triggers save
    [inputTitle, inputPlant, inputNote].forEach(function (input) {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                btnSaveSchedule.click();
            }
        });
    });

    // Helper: escape HTML to prevent XSS
    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    // Initial render
    renderSchedules();

});