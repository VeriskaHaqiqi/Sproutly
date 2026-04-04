<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Article - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-tulisartikelExpert.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-top">
                <a href="#" class="logo-wrap">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                    </div>
                    <span class="logo-text">Sproutly</span>
                </a>
            </div>

            <nav class="sidebar-menu">
                <a href="#" class="menu-item">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    <span>Dashboard</span>
                </a>

                <a href="#" class="menu-item">
                    <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                    <span>Consultation</span>
                </a>

                <a href="#" class="menu-item active">
                    <img src="{{ asset('images/article.png') }}" alt="Article">
                    <span>Article</span>
                </a>

                <a href="#" class="menu-item">
                    <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                    <span>My Article</span>
                </a>

                <a href="#" class="menu-item">
                    <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                    <span>Pricing</span>
                </a>

                <a href="#" class="menu-item">
                    <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                    <span>Client History</span>
                </a>

                <a href="#" class="menu-item">
                    <img src="{{ asset('images/settings.png') }}" alt="Setting">
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="main-content" id="mainContent">
            <section class="write-article-section">
                <div class="write-header">
                    <div class="write-title-group">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="write-title-icon">✎</div>
                        <h1>Write Article</h1>
                    </div>

                    <button type="button" class="publish-btn" id="publishBtn">Publish &gt;</button>
                </div>

                <div class="header-line"></div>

                <div class="article-form">
                    <!-- Upload Image -->
                    <label for="featureImage" class="upload-box">
                        <input type="file" id="featureImage" accept="image/*" hidden>
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <div class="upload-icon">🖼️</div>
                            <p>Upload Feature Image</p>
                            <span>Recommended size: 1200x500px</span>
                        </div>
                        <img id="imagePreview" class="image-preview" alt="Preview">
                    </label>

                    <!-- Title -->
                    <input
                        type="text"
                        class="article-title-input"
                        id="articleTitle"
                        placeholder="Enter your article title..."
                    >

                    <!-- Tags -->
                    <div class="tag-row">
                        <div class="tag-list" id="tagList">
                            <span class="tag-chip">Hydroponics <button type="button" class="remove-tag">×</button></span>
                            <span class="tag-chip">Soil Health <button type="button" class="remove-tag">×</button></span>
                        </div>

                        <button type="button" class="add-tag-btn" id="addTagBtn">+ Add Tag</button>
                    </div>

                    <!-- Summary -->
                    <div class="summary-box">
                        <label for="articleSummary">ARTICLE SUMMARY</label>
                        <textarea
                            id="articleSummary"
                            placeholder="Write a short summary of your article for SEO and previews..."
                        ></textarea>
                    </div>

                    <div class="content-line"></div>

                    <!-- Toolbar -->
                    <div class="editor-toolbar">
                        <button type="button" class="toolbar-btn" data-command="bold"><b>B</b></button>
                        <button type="button" class="toolbar-btn" data-command="italic"><i>I</i></button>
                        <button type="button" class="toolbar-btn heading-btn" data-heading="H1">H1</button>
                        <button type="button" class="toolbar-btn heading-btn" data-heading="H2">H2</button>
                        <button type="button" class="toolbar-btn" data-command="insertUnorderedList">• List</button>
                        <button type="button" class="toolbar-btn" id="quoteBtn">❞</button>
                        <button type="button" class="toolbar-btn" id="linkBtn">🔗</button>
                    </div>

                    <!-- Editor -->
                    <div
                        class="article-editor"
                        id="articleEditor"
                        contenteditable="true"
                        data-placeholder="Start writing your article..."
                    ></div>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-top">
                    <div class="footer-brand">
                        <div class="footer-brand-row">
                            <div class="footer-logo-circle">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                            </div>
                            <div>
                                <h2>Sproutly</h2>
                                <span>by AVI</span>
                            </div>
                        </div>
                        <p>
                            A modern agriculture consultation platform for a greener and
                            more sustainable future.
                        </p>
                    </div>

                    <div class="footer-links">
                        <h3>About Us</h3>
                        <a href="#">Our Team</a>
                        <a href="#">Blog</a>
                        <a href="#">Privacy Policy</a>
                    </div>

                    <div class="footer-contact">
                        <h3>Contact</h3>
                        <p>✉ sproutly@gmail.com</p>
                        <p>📞 +62 851 5693 2186</p>

                        <div class="social-row">
                            <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
                            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                            <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    © 2025 Sproutly by AVI. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <!-- POPUP -->
    <div class="modal-overlay" id="publishModal">
        <div class="modal-box">
            <div class="modal-check">✓</div>
            <h2>Article Published Successfully!</h2>
            <p>Your article has been published.</p>
            <button type="button" id="closeModalBtn">OK</button>
        </div>
    </div>

    <script src="{{ asset('js/script-tulisartikelExpert.js') }}"></script>
</body>
</html>