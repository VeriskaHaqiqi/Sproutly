<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Sproutly</title>

    <link rel="stylesheet" href="{{ asset('css/style-paymentUser.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-top">
                <a href="#" class="brand">
                    <div class="brand-icon-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="brand-logo">
                    </div>
                    <span class="brand-text">Sproutly</span>
                </a>

                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <nav class="menu">
                <a href="/dashboard-user" class="menu-item">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/consultationUser" class="menu-item">
                    <i class="fa-solid fa-comments"></i>
                    <span>Consultation</span>
                </a>

                <a href="/daftarArtikel" class="menu-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Article</span>
                </a>

                <a href="/bookmarkArtikelUser" class="menu-item">
                    <i class="fa-solid fa-bookmark"></i>
                    <span>Bookmarked Article</span>
                </a>

                <a href="#" class="menu-item">
                    <i class="fa-solid fa-star"></i>
                    <span>Reviews</span>
                </a>

                <a href="/payment" class="menu-item active">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Payment</span>
                </a>

                <a href="#" class="menu-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <header class="page-header">
                <div class="page-header-left">
                    <button class="mobile-toggle" id="mobileToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div>
                        <h1>Payment</h1>
                        <p>Complete your payment before starting the consultation session.</p>
                    </div>
                </div>
            </header>

            <div class="info-alert">
                <div class="alert-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <p>Your consultation will begin after payment is confirmed by our team.</p>
            </div>

            <div class="content-grid">
                <div class="left-column">
                    <section class="card">
                        <h2>Consultation Summary</h2>

                        <div class="consultation-summary">
                            <div class="doctor-profile">
                                <img src="{{ asset('images/fotoprofile.png') }}" alt="Doctor" class="doctor-avatar">

                                <div class="doctor-info">
                                    <h3>Dr. Sarah Mitchell</h3>
                                    <p>Plant Disease Specialist</p>

                                    <ul class="summary-list">
                                        <li><i class="fa-solid fa-message"></i> Chat Consultation</li>
                                        <li><i class="fa-solid fa-calendar"></i> Scheduled for Today, 3:00 PM</li>
                                        <li><i class="fa-solid fa-clock"></i> 30 minutes session</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="payment-status">Waiting for Payment</div>
                        </div>
                    </section>

                    <section class="card">
                        <h2>Payment Method</h2>

                        <div class="bank-box">
                            <div class="bank-top">
                                <div class="bank-icon">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>

                                <div>
                                    <p class="mini-label">Payment Method</p>
                                    <h3>Bank Transfer</h3>
                                </div>
                            </div>

                            <div class="bank-details">
                                <div class="detail-row">
                                    <span>Bank Name</span>
                                    <strong>Green Valley Bank</strong>
                                </div>

                                <div class="detail-row">
                                    <span>Account Holder Name</span>
                                    <strong>Sproutly Platform Inc.</strong>
                                </div>

                                <div class="detail-row">
                                    <span>Account Number</span>
                                    <div class="account-copy">
                                        <strong id="accountNumber">1234-5678-9012-3456</strong>
                                        <button class="copy-btn" id="copyBtn" type="button">
                                            <i class="fa-regular fa-copy"></i> Copy
                                        </button>
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <span>Branch</span>
                                    <strong>Downtown Branch</strong>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="card">
                        <h2>Payment Instructions</h2>

                        <div class="instructions">
                            <div class="instruction-item">
                                <h4>Transfer the exact consultation fee</h4>
                                <p>Make sure to transfer the exact amount shown in the payment summary.</p>
                            </div>

                            <div class="instruction-item">
                                <h4>Use the correct account details</h4>
                                <p>Double-check the account number and account holder name before transferring.</p>
                            </div>

                            <div class="instruction-item">
                                <h4>Complete payment before consultation starts</h4>
                                <p>Payment must be completed at least 15 minutes before your scheduled session.</p>
                            </div>

                            <div class="instruction-item">
                                <h4>Upload your payment proof</h4>
                                <p>After payment, upload your transfer receipt or screenshot for verification.</p>
                            </div>
                        </div>
                    </section>

                    <section class="card">
                        <h2>Upload Payment Proof</h2>

                        <div class="upload-box" id="uploadBox">
                            <div class="upload-icon">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>

                            <h4>Drag and drop your file here</h4>
                            <p>or click to browse</p>

                            <label for="paymentProof" class="browse-btn">Browse Files</label>
                            <input type="file" id="paymentProof" hidden accept=".jpg,.jpeg,.png,.pdf">

                            <small>Accepted formats: JPG, PNG, PDF (Max 5MB)</small>

                            <div class="file-name" id="fileName"></div>
                        </div>
                    </section>
                </div>

                <div class="right-column">
                    <section class="card payment-summary-card">
                        <h2>Payment Summary</h2>

                        <div class="summary-row">
                            <span>Consultation Fee</span>
                            <strong>$45.00</strong>
                        </div>

                        <div class="summary-row">
                            <span>Admin Fee</span>
                            <strong>$2.00</strong>
                        </div>

                        <div class="divider"></div>

                        <div class="summary-row total-row">
                            <span>Total Payment</span>
                            <strong>$47.00</strong>
                        </div>

                        <button class="confirm-btn" type="button">Confirm Payment</button>
                        <button class="cancel-btn" type="button">Cancel</button>

                        <div class="secure-note">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Your payment is secure and protected</span>
                        </div>
                    </section>
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="site-footer">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <div class="footer-brand-top">
                            <div class="footer-logo-box">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
                            </div>
                            <div>
                                <h3>Sproutly</h3>
                                <span>by AVI</span>
                            </div>
                        </div>

                        <p>
                            A modern agriculture consultation platform for a greener and more sustainable future.
                        </p>
                    </div>

                    <div class="footer-links">
                        <h4>About Us</h4>
                        <a href="#">Our Team</a>
                        <a href="#">Blog</a>
                        <a href="#">Privacy Policy</a>
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

                <div class="footer-bottom">
                    © 2025 Sproutly by AVI. All rights reserved.
                </div>
            </footer>
        </main>
    </div>

    <script src="{{ asset('js/paymentUser.js') }}"></script>
</body>
</html>