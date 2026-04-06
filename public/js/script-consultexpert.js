/* =============================================
   script-consultexpert.js
   Sproutly - Consultation History Expert
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

    /* ============ DATA ============ */
    const consultations = [
        {
            id: '#CS001',
            client: 'Amanda Lee',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=AmandaLee&backgroundColor=ffd5dc',
            topic: 'Crop Disease Analysis',
            date: 'Mar 15, 2026',
            dateVal: '2026-03-15',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$120.00',
            note: 'Client reported yellowing leaves in tomato plants. Diagnosis: early blight. Recommended organic copper-based fungicide and improved air circulation.'
        },
        {
            id: '#CS002',
            client: 'Daniel Kim',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=DanielKim&backgroundColor=c0aede',
            topic: 'Soil Nutrition Assessment',
            date: 'Mar 12, 2026',
            dateVal: '2026-03-12',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$95.00',
            note: 'Soil lab results show nitrogen and potassium deficiency. Follow-up session scheduled to evaluate fertilizer response after 2 weeks.'
        },
        {
            id: '#CS003',
            client: 'Olivia Brown',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=OliviaBrown&backgroundColor=b6e3f4',
            topic: 'Pest Control Strategy',
            date: 'Mar 10, 2026',
            dateVal: '2026-03-10',
            status: 'Cancelled',
            payment: 'Refunded',
            paymentMethod: 'E-Wallet',
            total: '$80.00',
            note: 'Client cancelled due to personal scheduling conflict. Full refund processed. Client may reschedule next month.'
        },
        {
            id: '#CS004',
            client: 'Ethan Carter',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=EthanCarter&backgroundColor=d1f4d1',
            topic: 'Irrigation Planning',
            date: 'Mar 8, 2026',
            dateVal: '2026-03-08',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$150.00',
            note: 'Designed drip irrigation layout for 1.5-hectare vegetable farm. Estimated 30% water savings. Client very satisfied with the plan.'
        },
        {
            id: '#CS005',
            client: 'Sophia Miller',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=SophiaMiller&backgroundColor=ffecd2',
            topic: 'Organic Farming Transition',
            date: 'Mar 5, 2026',
            dateVal: '2026-03-05',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$200.00',
            note: 'Month 2 of 6-month organic certification transition. Soil biome tests show improvement. Reducing synthetic input on schedule.'
        },
        {
            id: '#CS006',
            client: 'Ryan Patel',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=RyanPatel&backgroundColor=c7f2f2',
            topic: 'Greenhouse Temperature Control',
            date: 'Feb 28, 2026',
            dateVal: '2026-02-28',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$175.00',
            note: 'Optimized passive ventilation and shading schedule for tomato greenhouse. Yield increase of 20% projected this season.'
        },
        {
            id: '#CS007',
            client: 'Chloe Wang',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=ChloeWang&backgroundColor=f9d9f9',
            topic: 'Seed Variety Selection',
            date: 'Feb 22, 2026',
            dateVal: '2026-02-22',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'E-Wallet',
            total: '$70.00',
            note: 'Recommended three high-yield, disease-resistant varieties for local clay-loam soil conditions. Planting schedule shared.'
        },
        {
            id: '#CS008',
            client: 'Marcus Reed',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=MarcusReed&backgroundColor=d4f1c7',
            topic: 'Harvest & Post-Harvest Planning',
            date: 'Feb 18, 2026',
            dateVal: '2026-02-18',
            status: 'Cancelled',
            payment: 'Refunded',
            paymentMethod: 'Credit Card',
            total: '$90.00',
            note: 'Cancelled due to unexpected flooding on client farm. Refund issued. Consultation to resume after field recovery.'
        },
        {
            id: '#CS009',
            client: 'Layla Hassan',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=LaylaHassan&backgroundColor=ffe0b2',
            topic: 'Composting & Soil Amendment',
            date: 'Feb 14, 2026',
            dateVal: '2026-02-14',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$60.00',
            note: 'Introduced vermicomposting system. Client trained on bokashi fermentation for kitchen waste integration into farm compost cycle.'
        },
        {
            id: '#CS010',
            client: 'Nathan Brooks',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=NathanBrooks&backgroundColor=cfd8dc',
            topic: 'Rainwater Harvesting Design',
            date: 'Feb 9, 2026',
            dateVal: '2026-02-09',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$130.00',
            note: 'Designed 50,000L rainwater catchment system for dry-season irrigation. ROI estimated within 2 growing seasons.'
        },
        {
            id: '#CS011',
            client: 'Isabelle Dupont',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=IsabelleDupont&backgroundColor=ffe0cc',
            topic: 'Micronutrient Management',
            date: 'Feb 4, 2026',
            dateVal: '2026-02-04',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'E-Wallet',
            total: '$85.00',
            note: 'Session 2 of 3. Addressing zinc and iron deficiency in leafy greens. Foliar spray schedule established and being monitored.'
        },
        {
            id: '#CS012',
            client: 'Samuel Osei',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=SamuelOsei&backgroundColor=e0f0e0',
            topic: 'Cover Crop Rotation Plan',
            date: 'Jan 27, 2026',
            dateVal: '2026-01-27',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$110.00',
            note: 'Designed 3-season cover crop rotation using legumes and brassicas to restore depleted soil and reduce erosion on sloped fields.'
        }
    ];

    const ROWS_PER_PAGE = 5;
    let currentPage = 1;
    let filteredData = [...consultations];

    /* ============ SIDEBAR ============ */
    const hamburger = document.getElementById('hamburgerBtn');
    const sidebar   = document.getElementById('sidebar');
    const overlay   = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        hamburger.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    if (overlay) overlay.addEventListener('click', closeSidebar);

    /* ============ FILTERS ============ */
    const searchInput  = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const paymentFilter= document.getElementById('paymentFilter');
    const dateFilter   = document.getElementById('dateFilter');

    function applyFilters() {
        const s = searchInput  ? searchInput.value.toLowerCase().trim()  : '';
        const st= statusFilter ? statusFilter.value  : '';
        const pf= paymentFilter? paymentFilter.value : '';
        const df= dateFilter   ? dateFilter.value    : '';

        filteredData = consultations.filter(function (r) {
            const matchSearch  = !s  || r.client.toLowerCase().includes(s) || r.topic.toLowerCase().includes(s) || r.id.toLowerCase().includes(s);
            const matchStatus  = !st || r.status  === st;
            const matchPayment = !pf || r.payment === pf;
            const matchDate    = !df || r.dateVal === df;
            return matchSearch && matchStatus && matchPayment && matchDate;
        });

        currentPage = 1;
        renderTable();
        renderPagination();
    }

    if (searchInput)   searchInput.addEventListener('input',  applyFilters);
    if (statusFilter)  statusFilter.addEventListener('change', applyFilters);
    if (paymentFilter) paymentFilter.addEventListener('change',applyFilters);
    if (dateFilter)    dateFilter.addEventListener('change',   applyFilters);

    /* ============ BADGES ============ */
    function statusBadge(s) {
        var cls = { Completed: 'badge-completed', Ongoing: 'badge-ongoing', Cancelled: 'badge-cancelled' };
        return '<span class="badge ' + (cls[s] || '') + '">' + s + '</span>';
    }
    function paymentBadge(p) {
        var cls = { Paid: 'badge-paid', Refunded: 'badge-refunded' };
        return '<span class="badge ' + (cls[p] || '') + '">' + p + '</span>';
    }

    /* ============ TABLE ============ */
    function renderTable() {
        var tbody = document.getElementById('tableBody');
        if (!tbody) return;

        var start    = (currentPage - 1) * ROWS_PER_PAGE;
        var pageData = filteredData.slice(start, start + ROWS_PER_PAGE);

        if (pageData.length === 0) {
            tbody.innerHTML = '<tr class="empty-row"><td colspan="7">No consultations found.</td></tr>';
            return;
        }

        tbody.innerHTML = pageData.map(function (r) {
            var fallback = 'https://api.dicebear.com/7.x/initials/svg?seed=' + encodeURIComponent(r.client);
            return '<tr>' +
                '<td><span class="id-cell">' + r.id + '</span></td>' +
                '<td>' +
                    '<div class="client-cell">' +
                        '<img src="' + r.avatar + '" alt="' + r.client + '" class="client-avatar" onerror="this.src=\'' + fallback + '\'">' +
                        '<span class="client-name">' + r.client + '</span>' +
                    '</div>' +
                '</td>' +
                '<td>' + r.topic + '</td>' +
                '<td><span class="date-cell">' + r.date + '</span></td>' +
                '<td>' + statusBadge(r.status)  + '</td>' +
                '<td>' + paymentBadge(r.payment) + '</td>' +
                '<td><button class="btn-view-details" onclick="openModal(\'' + r.id + '\')">View Details</button></td>' +
            '</tr>';
        }).join('');
    }

    /* ============ PAGINATION ============ */
    function renderPagination() {
        var pag = document.getElementById('pagination');
        if (!pag) return;

        var total = Math.ceil(filteredData.length / ROWS_PER_PAGE);
        if (total <= 1) { pag.innerHTML = ''; return; }

        var html = '';
        html += '<button class="page-btn" ' + (currentPage === 1 ? 'disabled' : '') + ' onclick="goPage(' + (currentPage - 1) + ')">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>' +
            '</button>';

        for (var i = 1; i <= total; i++) {
            html += '<button class="page-btn' + (i === currentPage ? ' active' : '') + '" onclick="goPage(' + i + ')">' + i + '</button>';
        }

        html += '<button class="page-btn" ' + (currentPage === total ? 'disabled' : '') + ' onclick="goPage(' + (currentPage + 1) + ')">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>' +
            '</button>';

        pag.innerHTML = html;
    }

    window.goPage = function (p) {
        var total = Math.ceil(filteredData.length / ROWS_PER_PAGE);
        if (p < 1 || p > total) return;
        currentPage = p;
        renderTable();
        renderPagination();
    };

    /* ============ MODAL ============ */
    var modalOverlay = document.getElementById('modalOverlay');
    var modalClose   = document.getElementById('modalClose');

    window.openModal = function (id) {
        var r = consultations.find(function (c) { return c.id === id; });
        if (!r || !modalOverlay) return;

        var body = document.getElementById('modalBody');
        if (!body) return;

        var fallback = 'https://api.dicebear.com/7.x/initials/svg?seed=' + encodeURIComponent(r.client);

        body.innerHTML =
            '<div class="modal-client-row">' +
                '<img src="' + r.avatar + '" alt="' + r.client + '" class="modal-client-avatar" onerror="this.src=\'' + fallback + '\'">' +
                '<div>' +
                    '<div class="modal-client-name">' + r.client + '</div>' +
                    '<div class="modal-client-topic">' + r.topic + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="modal-fields">' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Consultation ID</span>' +
                    '<span class="modal-field-value">' + r.id + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Date</span>' +
                    '<span class="modal-field-value">' + r.date + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Status</span>' +
                    '<span class="modal-field-value">' + statusBadge(r.status) + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Payment Status</span>' +
                    '<span class="modal-field-value">' + paymentBadge(r.payment) + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Payment Method</span>' +
                    '<span class="modal-field-value">' + r.paymentMethod + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Total Payment</span>' +
                    '<span class="modal-field-value" style="font-weight:700;">' + r.total + '</span>' +
                '</div>' +
            '</div>' +
            '<div class="modal-note"><p>' + r.note + '</p></div>';

        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    function closeModal() {
        if (modalOverlay) modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (modalOverlay) modalOverlay.addEventListener('click', function (e) {
        if (e.target === modalOverlay) closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeModal(); closeSidebar(); }
    });

    /* ============ INIT ============ */
    renderTable();
    renderPagination();

});