/* =============================================
   script-ConsultationhistoryUser.js
   Sproutly - Consultation History User
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

    /* ============ CONSULTATION DATA ============ */
    const consultations = [
        {
            id: '#CS001',
            expert: 'Sarah Johnson',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=SarahJohnson&backgroundColor=b6e3f4',
            topic: 'Crop Disease Analysis',
            date: 'Mar 15, 2026',
            dateVal: '2026-03-15',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$120.00',
            note: 'Identified early signs of fungal infection in tomato plants. Recommended organic fungicide treatment and improved drainage.'
        },
        {
            id: '#CS002',
            expert: 'Michael Chen',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=MichaelChen&backgroundColor=c0aede',
            topic: 'Soil Nutrition Assessment',
            date: 'Mar 12, 2026',
            dateVal: '2026-03-12',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$95.00',
            note: 'Soil samples show nitrogen deficiency. Follow-up session scheduled to review fertilizer plan progress.'
        },
        {
            id: '#CS003',
            expert: 'Emily Rodriguez',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=EmilyRodriguez&backgroundColor=ffd5dc',
            topic: 'Pest Control Strategy',
            date: 'Mar 10, 2026',
            dateVal: '2026-03-10',
            status: 'Cancelled',
            payment: 'Refunded',
            paymentMethod: 'E-Wallet',
            total: '$80.00',
            note: 'Consultation cancelled due to scheduling conflict. Full refund processed within 3 business days.'
        },
        {
            id: '#CS004',
            expert: 'James Wilson',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=JamesWilson&backgroundColor=d1f4d1',
            topic: 'Irrigation Planning',
            date: 'Mar 8, 2026',
            dateVal: '2026-03-08',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$150.00',
            note: 'Designed a drip irrigation system for 2-hectare vegetable farm. Estimated 30% water savings after implementation.'
        },
        {
            id: '#CS005',
            expert: 'Lisa Thompson',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=LisaThompson&backgroundColor=ffecd2',
            topic: 'Organic Farming Transition',
            date: 'Mar 5, 2026',
            dateVal: '2026-03-05',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$200.00',
            note: 'Month 2 of 6-month organic transition program. Soil biome improving steadily. Next review in 3 weeks.'
        },
        {
            id: '#CS006',
            expert: 'David Park',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=DavidPark&backgroundColor=c7f2f2',
            topic: 'Greenhouse Optimization',
            date: 'Feb 28, 2026',
            dateVal: '2026-02-28',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$175.00',
            note: 'Optimized greenhouse temperature and humidity controls for year-round tomato production. Yield projected to increase by 25%.'
        },
        {
            id: '#CS007',
            expert: 'Maria Santos',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=MariaSantos&backgroundColor=f9d9f9',
            topic: 'Seed Selection Guide',
            date: 'Feb 24, 2026',
            dateVal: '2026-02-24',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'E-Wallet',
            total: '$70.00',
            note: 'Recommended high-yield, disease-resistant seed varieties suited to local soil and climate conditions.'
        },
        {
            id: '#CS008',
            expert: 'Robert Kim',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=RobertKim&backgroundColor=d4f1c7',
            topic: 'Harvest Planning',
            date: 'Feb 20, 2026',
            dateVal: '2026-02-20',
            status: 'Cancelled',
            payment: 'Refunded',
            paymentMethod: 'Credit Card',
            total: '$90.00',
            note: 'Cancelled due to weather events. Refunded in full. Rescheduling recommended for next dry season.'
        },
        {
            id: '#CS009',
            expert: 'Anna Novak',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=AnnaNovak&backgroundColor=ffe0b2',
            topic: 'Composting Techniques',
            date: 'Feb 15, 2026',
            dateVal: '2026-02-15',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$60.00',
            note: 'Introduced vermicomposting and bokashi systems to reduce waste and enrich soil organically.'
        },
        {
            id: '#CS010',
            expert: 'Carlos Mendez',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=CarlosMendez&backgroundColor=cfd8dc',
            topic: 'Water Management',
            date: 'Feb 10, 2026',
            dateVal: '2026-02-10',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Credit Card',
            total: '$130.00',
            note: 'Developed rainwater harvesting plan for small farm. Expected to reduce municipal water usage by 40%.'
        },
        {
            id: '#CS011',
            expert: 'Sophie Laurent',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=SophieLaurent&backgroundColor=ffe0cc',
            topic: 'Plant Nutrition Basics',
            date: 'Feb 5, 2026',
            dateVal: '2026-02-05',
            status: 'Ongoing',
            payment: 'Paid',
            paymentMethod: 'E-Wallet',
            total: '$85.00',
            note: 'Three-session program on macro and micronutrient management. Session 1 of 3 completed.'
        },
        {
            id: '#CS012',
            expert: 'Tom Walker',
            avatar: 'https://api.dicebear.com/7.x/personas/svg?seed=TomWalker&backgroundColor=e0f0e0',
            topic: 'Cover Cropping Strategy',
            date: 'Jan 28, 2026',
            dateVal: '2026-01-28',
            status: 'Completed',
            payment: 'Paid',
            paymentMethod: 'Bank Transfer',
            total: '$110.00',
            note: 'Designed seasonal cover crop rotation to improve soil health and reduce erosion on sloping farmland.'
        }
    ];

    const ROWS_PER_PAGE = 5;
    let currentPage = 1;
    let filteredData = [...consultations];

    /* ============ SIDEBAR TOGGLE ============ */
    const hamburger = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

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

    if (hamburger) {
        hamburger.addEventListener('click', function () {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    /* ============ FILTER LOGIC ============ */
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const paymentFilter = document.getElementById('paymentFilter');
    const dateFilter = document.getElementById('dateFilter');

    function applyFilters() {
        const searchVal = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const statusVal = statusFilter ? statusFilter.value : '';
        const paymentVal = paymentFilter ? paymentFilter.value : '';
        const dateVal = dateFilter ? dateFilter.value : '';

        filteredData = consultations.filter(function (row) {
            const matchSearch = !searchVal || row.expert.toLowerCase().includes(searchVal) || row.topic.toLowerCase().includes(searchVal) || row.id.toLowerCase().includes(searchVal);
            const matchStatus = !statusVal || row.status === statusVal;
            const matchPayment = !paymentVal || row.payment === paymentVal;
            const matchDate = !dateVal || row.dateVal === dateVal;
            return matchSearch && matchStatus && matchPayment && matchDate;
        });

        currentPage = 1;
        renderTable();
        renderPagination();
    }

    if (searchInput) searchInput.addEventListener('input', applyFilters);
    if (statusFilter) statusFilter.addEventListener('change', applyFilters);
    if (paymentFilter) paymentFilter.addEventListener('change', applyFilters);
    if (dateFilter) dateFilter.addEventListener('change', applyFilters);

    /* ============ TABLE RENDERING ============ */
    function getStatusBadge(status) {
        const map = {
            'Completed': 'badge-completed',
            'Ongoing': 'badge-ongoing',
            'Cancelled': 'badge-cancelled'
        };
        return '<span class="badge ' + (map[status] || '') + '">' + status + '</span>';
    }

    function getPaymentBadge(payment) {
        const map = {
            'Paid': 'badge-paid',
            'Refunded': 'badge-refunded'
        };
        return '<span class="badge ' + (map[payment] || '') + '">' + payment + '</span>';
    }

    function renderTable() {
        const tbody = document.getElementById('tableBody');
        if (!tbody) return;

        const start = (currentPage - 1) * ROWS_PER_PAGE;
        const end = start + ROWS_PER_PAGE;
        const pageData = filteredData.slice(start, end);

        if (pageData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; padding: 36px; color: var(--text-muted); font-size: 0.9rem;">No consultations found.</td></tr>';
            return;
        }

        tbody.innerHTML = pageData.map(function (row) {
            return '<tr>' +
                '<td><span class="id-cell">' + row.id + '</span></td>' +
                '<td>' +
                    '<div class="expert-cell">' +
                        '<img src="' + row.avatar + '" alt="' + row.expert + '" class="expert-avatar" onerror="this.src=\'https://api.dicebear.com/7.x/initials/svg?seed=' + encodeURIComponent(row.expert) + '\'">' +
                        '<span class="expert-name">' + row.expert + '</span>' +
                    '</div>' +
                '</td>' +
                '<td>' + row.topic + '</td>' +
                '<td><span class="date-cell">' + row.date + '</span></td>' +
                '<td>' + getStatusBadge(row.status) + '</td>' +
                '<td>' + getPaymentBadge(row.payment) + '</td>' +
                '<td>' +
                    '<button class="btn-view-details" onclick="openModal(\'' + row.id + '\')">' +
                        'View Details' +
                    '</button>' +
                '</td>' +
            '</tr>';
        }).join('');
    }

    /* ============ PAGINATION ============ */
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        if (!pagination) return;

        const totalPages = Math.ceil(filteredData.length / ROWS_PER_PAGE);

        if (totalPages <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let html = '';

        // Prev
        html += '<button class="page-btn" ' + (currentPage === 1 ? 'disabled' : '') + ' onclick="goPage(' + (currentPage - 1) + ')">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>' +
            '</button>';

        // Pages
        for (let i = 1; i <= totalPages; i++) {
            html += '<button class="page-btn' + (i === currentPage ? ' active' : '') + '" onclick="goPage(' + i + ')">' + i + '</button>';
        }

        // Next
        html += '<button class="page-btn" ' + (currentPage === totalPages ? 'disabled' : '') + ' onclick="goPage(' + (currentPage + 1) + ')">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>' +
            '</button>';

        pagination.innerHTML = html;
    }

    window.goPage = function (page) {
        const totalPages = Math.ceil(filteredData.length / ROWS_PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderTable();
        renderPagination();
    };

    /* ============ MODAL ============ */
    const modalOverlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');

    window.openModal = function (id) {
        const row = consultations.find(function (c) { return c.id === id; });
        if (!row || !modalOverlay) return;

        const modalBody = document.getElementById('modalBody');
        if (!modalBody) return;

        modalBody.innerHTML =
            '<div class="modal-expert-row">' +
                '<img src="' + row.avatar + '" alt="' + row.expert + '" class="modal-expert-avatar" onerror="this.src=\'https://api.dicebear.com/7.x/initials/svg?seed=' + encodeURIComponent(row.expert) + '\'">' +
                '<div>' +
                    '<div class="modal-expert-name">' + row.expert + '</div>' +
                    '<div class="modal-expert-topic">' + row.topic + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="modal-fields">' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Consultation ID</span>' +
                    '<span class="modal-field-value">' + row.id + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Date</span>' +
                    '<span class="modal-field-value">' + row.date + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Status</span>' +
                    '<span class="modal-field-value">' + getStatusBadge(row.status) + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Payment Status</span>' +
                    '<span class="modal-field-value">' + getPaymentBadge(row.payment) + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Payment Method</span>' +
                    '<span class="modal-field-value">' + row.paymentMethod + '</span>' +
                '</div>' +
                '<div class="modal-field">' +
                    '<span class="modal-field-label">Total Payment</span>' +
                    '<span class="modal-field-value" style="font-weight:700;">' + row.total + '</span>' +
                '</div>' +
            '</div>' +
            '<div class="modal-note">' +
                '<p>' + row.note + '</p>' +
            '</div>';

        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    function closeModal() {
        if (modalOverlay) modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (modalClose) modalClose.addEventListener('click', closeModal);

    if (modalOverlay) {
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) closeModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModal();
            closeSidebar();
        }
    });

    function getStatusBadge(status) {
        const map = {
            'Completed': 'badge-completed',
            'Ongoing': 'badge-ongoing',
            'Cancelled': 'badge-cancelled'
        };
        return '<span class="badge ' + (map[status] || '') + '">' + status + '</span>';
    }

    function getPaymentBadge(payment) {
        const map = {
            'Paid': 'badge-paid',
            'Refunded': 'badge-refunded'
        };
        return '<span class="badge ' + (map[payment] || '') + '">' + payment + '</span>';
    }

    /* ============ INIT ============ */
    renderTable();
    renderPagination();

});