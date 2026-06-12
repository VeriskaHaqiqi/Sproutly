<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-paymentUser.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-layout">
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
                    <a href="/dashboard-user" class="menu-item">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                        <span>Dashboard</span>
                    </a>
                    <a href="/consultationUser" class="menu-item">
                        <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                        <span>Consultation</span>
                    </a>
                    <a href="/daftarArtikel" class="menu-item">
                        <img src="{{ asset('images/article.png') }}" alt="Article">
                        <span>Article</span>
                    </a>
                    <a href="/bookmarkedArticleUser" class="menu-item">
                        <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article">
                        <span>Bookmarked Article</span>
                    </a> 
                    <a href="/reviewsUser" class="menu-item">
                        <img src="{{ asset('images/reviews.png') }}" alt="Reviews">
                        <span>Reviews</span>
                    </a>
                    <a href="/paymentUser" class="menu-item active">
                        <img src="{{ asset('images/payment.png') }}" alt="Payment">
                        <span>Payment</span>
                    </a>
                    <a href="/accountUser" class="menu-item">
                        <img src="{{ asset('images/settings.png') }}" alt="Setting">
                        <span>Setting</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <div class="main-content" id="mainContent">
            <section class="payment-section">
                <div class="section-header">
                    <div class="title-row">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div>
                            <h1>Payment</h1>
                            <p>Complete your payment before starting the consultation session.</p>
                        </div>
                    </div>
                </div>

                <div class="info-banner">
                    <span class="info-icon">i</span>
                    <p>Your consultation will begin after payment is confirmed by our team.</p>
                </div>

                <div class="payment-grid">
                    <div class="left-column">
                        <div class="card">
                            <h2>Consultation Summary</h2>

                            <div class="expert-summary">
                                <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?q=80&w=300&auto=format&fit=crop" alt="Expert" class="expert-avatar">

                                <div class="expert-details">
                                    <div class="expert-head">
                                        <div>
                                            <h3>Dr. Sarah Mitchell</h3>
                                            <span>Plant Disease Specialist</span>
                                        </div>
                                        <strong class="waiting-text">Waiting for Payment</strong>
                                    </div>

                                    <ul class="consultation-meta">
                                        <li>Chat Consultation</li>
                                        <li>Scheduled for Today, 3:00 PM</li>
                                        <li>30 minutes session</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h2>Payment Method</h2>

                            <div class="bank-box">
                                <div class="bank-head">
                                    <div class="bank-icon">🏦</div>
                                    <div>
                                        <span class="small-label">Payment Method</span>
                                        <h3>Bank Transfer</h3>
                                    </div>
                                </div>

                                <div class="bank-detail">
                                    <span>Bank Name</span>
                                    <strong>Green Valley Bank</strong>
                                </div>

                                <div class="bank-detail">
                                    <span>Account Holder Name</span>
                                    <strong>Sproutly Platform Inc.</strong>
                                </div>

                                <div class="bank-detail">
                                    <span>Account Number</span>
                                    <div class="copy-row">
                                        <strong id="accountNumber">1234-5678-9012-3456</strong>
                                        <button type="button" class="copy-btn" id="copyBtn">Copy</button>
                                    </div>
                                </div>

                                <div class="bank-detail">
                                    <span>Branch</span>
                                    <strong>Downtown Branch</strong>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h2>Payment Instructions</h2>

                            <div class="instruction-list">
                                <div>
                                    <h4>Transfer the exact consultation fee</h4>
                                    <p>Make sure to transfer the exact amount shown in the payment summary.</p>
                                </div>
                                <div>
                                    <h4>Use the correct account details</h4>
                                    <p>Double-check the account number and account holder name before transferring.</p>
                                </div>
                                <div>
                                    <h4>Complete payment before consultation starts</h4>
                                    <p>Payment must be completed at least 15 minutes before your scheduled session.</p>
                                </div>
                                <div>
                                    <h4>Upload your payment proof</h4>
                                    <p>After payment, upload your transfer receipt or screenshot for verification.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h2>Upload Payment Proof</h2>

                            <label class="upload-box" for="paymentProof">
                                <input type="file" id="paymentProof" accept=".jpg,.jpeg,.png,.pdf" hidden>
                                <div class="upload-icon">☁</div>
                                <h4>Drag and drop your file here</h4>
                                <p>or click to browse</p>
                                <button type="button" class="browse-btn">Browse Files</button>
                                <span class="upload-note">Accepted formats: JPG, PNG, PDF (Max 5MB)</span>
                                <span class="file-name" id="fileName"></span>
                            </label>

                            <p class="upload-error" id="uploadError"></p>
                        </div>
                    </div>

                    <div class="right-column">
                        <div class="card payment-summary-card">
                            <h2>Payment Summary</h2>

                            <div class="summary-line">
                                <span>Consultation Fee</span>
                                <strong>$45.00</strong>
                            </div>

                            <div class="summary-line">
                                <span>Admin Fee</span>
                                <strong>$2.00</strong>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-total">
                                <span>Total Payment</span>
                                <strong>$47.00</strong>
                            </div>

                            <button type="button" class="confirm-btn" id="confirmPaymentBtn">Confirm Payment</button>
                            <button type="button" class="cancel-btn">Cancel</button>

                            <div class="secure-note">
                                <span>🛡</span>
                                <p>Your payment is secure and protected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
                        <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
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

    <!-- PAYMENT SUBMITTED MODAL -->
    <div class="modal-overlay" id="paymentSuccessModal">
        <div class="payment-modal">
            <button type="button" class="modal-close" id="closePaymentModal">×</button>

            <div class="payment-modal-icon-wrap">
                <div class="payment-modal-icon">✓</div>
            </div>

            <h2>Payment Submitted Successfully</h2>
            <p>
                Your payment has been successfully submitted. Your consultation will begin
                once the payment is verified.
            </p>

            <div class="payment-modal-summary">
                <div class="payment-modal-line">
                    <span>Expert</span>
                    <strong>Dr. Sarah Mitchell</strong>
                </div>
                <div class="payment-modal-line">
                    <span>Consultation Type</span>
                    <strong>30-min Chat Consultation</strong>
                </div>
                <div class="payment-modal-line">
                    <span>Amount Paid</span>
                    <strong>$47.00</strong>
                </div>
                <div class="payment-modal-line">
                    <span>Payment Status</span>
                    <strong class="submitted-status">Pending Verification</strong>
                </div>
            </div>

            <a href="#" class="primary-link-btn">View Consultation</a>
            <a href="#" class="secondary-link-btn">Back to Dashboard</a>
        </div>
    </div>

    <script src="{{ asset('js/paymentUser.js') }}"></script>
</body>
</html>