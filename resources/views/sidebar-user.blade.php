<aside class="sidebar" id="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-top">
            <a href="#" class="logo-wrap">
                <div class="logo-box">
                    <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                </div>
                <span class="logo-text">Sproutly</span>
            </a>
        </div>

        <nav class="sidebar-menu">
            <a href="#" class="menu-item {{ ($active ?? '') === 'dashboard' ? 'active' : '' }}">
                <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                <span>Dashboard</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'consultation' ? 'active' : '' }}">
                <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                <span>Consultation</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'article' ? 'active' : '' }}">
                <img src="{{ asset('images/article.png') }}" alt="Article">
                <span>Article</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'bookmarked-article' ? 'active' : '' }}">
                <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article">
                <span>Bookmarked Article</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'reviews' ? 'active' : '' }}">
                <img src="{{ asset('images/reviews.png') }}" alt="Reviews">
                <span>Reviews</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'payment' ? 'active' : '' }}">
                <img src="{{ asset('images/payment.png') }}" alt="Payment">
                <span>Payment</span>
            </a>

            <a href="#" class="menu-item {{ ($active ?? '') === 'setting' ? 'active' : '' }}">
                <img src="{{ asset('images/settings.png') }}" alt="Setting">
                <span>Setting</span>
            </a>
        </nav>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>