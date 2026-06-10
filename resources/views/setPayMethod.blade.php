<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method Settings – Sproutly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-setPayMethod.css') }}">
</head>
<body>


<!-- ===== MAIN CONTENT ===== -->
<div class="main-content full" id="mainContent">
   
    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('homeExpert') }}" class="logo-wrap">
                <div class="logo-box">
                    <img src="images/logo.png" class="logo-img">
                </div>
                <span class="logo-text">Sproutly</span>
            </a>
        </div>

        <div class="sidebar-line"></div>

        <nav class="sidebar-menu">
            <a href="{{ route('dashboard-ahli') }}" 
            class="menu-link {{ request()->routeIs('dashboard-ahli') ? 'active' : '' }}">
                <img src="images/dashboard.png">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('consultexpert') }}" 
            class="menu-link {{ request()->routeIs('consultexpert') ? 'active' : '' }}">
                <img src="images/consultation.png">
                <span>Consultation</span>
            </a>

            <a href="{{ route('articleExpert') }}" 
            class="menu-link {{ request()->routeIs('articleExpert') ? 'active' : '' }}">
                <img src="images/article.png">
                <span>Article</span>
            </a>

            <a href="{{ route('myarticleExpert') }}" 
            class="menu-link child-link {{ request()->routeIs('myarticleExpert') ? 'active' : '' }}">
                <img src="images/myarticle.png">
                <span>My Article</span>
            </a>

            <a href="{{ route('setpricingexpert') }}" 
            class="menu-link child-link {{ request()->routeIs('setpricingexpert') ? 'active' : '' }}">
                <img src="images/pricing.png">
                <span>Pricing</span>
            </a>

            <a href="{{ route('ConsultationhistoryExpert') }}" 
            class="menu-link child-link {{ request()->routeIs('ConsultationhistoryExpert') ? 'active' : '' }}">
                <img src="images/clienthistory.png">
                <span>Client History</span>
            </a>

            <a href="{{ route('accountExpert') }}" 
            class="menu-link active" {{ request()->routeIs('accountExpert') ? 'active' : '' }}">
                <img src="images/settings.png">
                <span>Setting</span>
            </a>
        </nav>
    </aside>
    <!-- TOP NAV -->
    <header class="topnav">
        <button class="burger-btn" id="sidebarToggle" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="topnav-title">
            <h1>Payment Method Settings</h1>
            <p>Manage how clients pay you for consultations</p>
        </div>
        <div class="topnav-user">
            <img src="images/avatar.png" alt="User" class="avatar-img">
        </div>
    </header>

    <!-- PAGE BODY -->
    <main class="page-body">

        <!-- INFO BANNER -->
        <div class="info-banner">
            <div class="info-icon">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="info-text">
                <strong>Payment Information</strong>
                <p>Users must complete payment before consultation starts. Payment is made via direct bank transfer to your registered account.</p>
            </div>
        </div>

        <div class="two-col-layout">

            <!-- LEFT: FORM -->
            <section class="form-card">
                <h2 class="section-title">Bank Account Details</h2>

                <form id="paymentForm" onsubmit="return false;">

                    <div class="field-group">
                        <label for="bankName">Bank Name</label>
                        <div class="input-wrap">
                            <input type="text" id="bankName" name="bankName" placeholder="e.g. Bank Central Asia">
                            <img src="images/bank.png" alt="" class="input-icon">
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="holderName">Account Holder Name</label>
                        <div class="input-wrap">
                            <input type="text" id="holderName" name="holderName" placeholder="e.g. Dr. Sarah Martinez">
                            <img src="images/user.png" alt="" class="input-icon">
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="accountNumber">Bank Account Number</label>
                        <div class="input-wrap">
                            <input type="text" id="accountNumber" name="accountNumber" placeholder="e.g. 1234567890123">
                            <img src="images/card.png" alt="" class="input-icon">
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="branchName">Branch Name <span class="optional">(Optional)</span></label>
                        <div class="input-wrap">
                            <input type="text" id="branchName" name="branchName" placeholder="e.g. Jakarta Central Branch">
                            <img src="images/location.png" alt="" class="input-icon">
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="instructions">Payment Instructions <span class="optional">(Optional)</span></label>
                        <textarea id="instructions" name="instructions" rows="4"
                            placeholder="Please transfer exactly to this account before the consultation session begins. Include your booking ID in the transfer notes."></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save" id="btnSave">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Payment Method
                        </button>
                        <button type="button" class="btn-remove" id="btnRemove">
                            <i class="fa-solid fa-trash-can"></i>
                            Remove Payment Method
                        </button>
                    </div>

                </form>
            </section>

            <!-- RIGHT: PREVIEW -->
            <aside class="preview-card">
                <h2 class="section-title">Preview</h2>
                <p class="preview-sub">This is how users will see your payment information</p>

                <!-- EMPTY STATE -->
                <div class="preview-empty" id="previewEmpty">
                    <div class="empty-icon">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <p>Fill in your bank details and click<br><strong>Save Payment Method</strong> to see a preview.</p>
                </div>

                <!-- PREVIEW FILLED (hidden until save) -->
                <div class="preview-filled" id="previewFilled" style="display:none;">
                    <div class="preview-header">
                        <div class="preview-bank-icon">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div>
                            <span class="preview-label-sm">Transfer Payment To</span>
                            <p class="preview-holder-name" id="prevHolderName">—</p>
                        </div>
                    </div>

                    <div class="preview-details">
                        <div class="preview-row">
                            <span>Bank Name</span>
                            <strong id="prevBankName">—</strong>
                        </div>
                        <div class="preview-row">
                            <span>Account Number</span>
                            <strong id="prevAccountNumber">—</strong>
                        </div>
                        <div class="preview-row" id="prevBranchRow">
                            <span>Branch</span>
                            <strong id="prevBranchName">—</strong>
                        </div>
                    </div>

                    <div class="preview-instructions" id="prevInstructions" style="display:none;">
                        <p id="prevInstructionsText"></p>
                    </div>
                </div>

            </aside>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-brand-top">
                    <div class="footer-logo-box">
                        <img src="images/logo.png" alt="Sproutly Logo" class="footer-logo">
                    </div>
                    <div>
                        <h3>Sproutly</h3>
                        <span>by AVI</span>
                    </div>
                </div>
                <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
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
                    <a href="#"><img src="images/instagram.jpg" alt="Instagram"></a>
                    <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="images/X.jpg" alt="X"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 Sproutly by AVI. All rights reserved.
        </div>
    </footer>
    {{-- Footer block only — sidebar already included above --}}

</div><!-- /main-content -->

<!-- SUCCESS TOAST -->
<div class="toast" id="toast">
    <i class="fa-solid fa-circle-check"></i>
    <span>Payment method saved successfully!</span>
</div>

<script src="{{ asset('js/script-setPayMethos.js') }}"></script>
</body>
</html>