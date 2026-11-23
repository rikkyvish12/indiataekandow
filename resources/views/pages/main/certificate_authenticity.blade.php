<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
    <title>Certificate Authenticity &amp; Official Information | India Taekwondo</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="Certificate Authenticity &amp; Official Information | India Taekwondo">
    <meta name="description" content="Official certificate verification and authenticity portal for the 1st India International Open Taekwondo Championship 2026 under the authority of India Taekwondo.">
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/certificate-authenticity.css') }}">
</head>
<body class="cert-verify-body">

    <div class="cert-page-container">
        
        <!-- 1. Federation Header Logos -->
        <header class="cert-header-banner">
            <img src="{{ asset('images/championship_header_logos.png') }}" 
                 alt="World Taekwondo, India Taekwondo, 1st India International Open Taekwondo Championship 2026, ATU, India Olympic" 
                 class="header-logos"
                 loading="eager">
        </header>

        <!-- 2. Championship Title & Accent -->
        <section class="cert-championship-section">
            <h1 class="cert-org-title">INDIA TAEKWONDO</h1>
            <p class="cert-event-title">1st India International Open Taekwondo Championship<br>2026</p>
            <div class="cert-gold-divider"></div>
        </section>

        <!-- 3. Authenticity & Official Information -->
        <main class="cert-content-section">
            <h2 class="cert-main-heading">Certificate Authenticity &amp;<br>Official Information</h2>
            
            <p class="cert-authority-description">
                This certificate is issued under the authority of India Taekwondo. For verification of certificate authenticity or any official information, please contact us using the details below.
            </p>

            <!-- 4. Contact Information Card -->
            <div class="cert-contact-card">
                <h3 class="cert-card-title">Contact Information</h3>
                
                <div class="cert-info-group">
                    <span class="cert-label">Email</span>
                    <a href="mailto:indiataekwondo2020@gmail.com?subject=Certificate%20Authenticity%20Verification%20Request" 
                       class="cert-email-value">
                        indiataekwondo2020@gmail.com
                    </a>
                </div>

                <div class="cert-info-group phone-group">
                    <span class="cert-label">Phone</span>
                </div>

                <a href="mailto:indiataekwondo2020@gmail.com?subject=Certificate%20Authenticity%20Verification%20Request" 
                   class="cert-btn-verify">
                    Contact Us for Verification
                </a>
            </div>
        </main>

    </div>

    <!-- 5. Page Footer -->
    <footer class="cert-footer">
        <p>&copy; {{ date('Y') }} India Taekwondo. All Rights Reserved.</p>
    </footer>

</body>
</html>
