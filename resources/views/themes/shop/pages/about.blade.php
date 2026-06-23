@extends(front_layout('main'))
@section('content')

<!-- Scoped CSS for Modern Library About Page -->
<style>
    /* -- Theme Custom Variables -- */
    :root {
        --uni-blue-deep: #0B2F64;
        --uni-blue-dark: #071E3D;
        --uni-blue-gradient: linear-gradient(135deg, #071E3D 0%, #0B2F64 100%);
        --uni-gold-primary: #D4AF37;
        --uni-gold-hover: #F3E5AB;
        --uni-gold-dark: #B59410;
        --text-white: #ffffff;
        --text-dark: #1E293B;
        --text-muted: #64748B;
        --glass-bg: rgba(255, 255, 255, 0.08);
        --glass-border: rgba(255, 255, 255, 0.18);
        --card-glass-bg: rgba(255, 255, 255, 0.75);
        --card-glass-border: rgba(209, 213, 219, 0.3);
        --card-shadow: 0 10px 30px -10px rgba(11, 47, 100, 0.1);
        --card-hover-shadow: 0 20px 40px -15px rgba(181, 148, 16, 0.25);
    }

    /* -- Global Styles & Khmer Typography Override for About Page -- */
    .edu-about-page {
        background-color: #f8fafc;
        color: var(--text-dark);
        overflow-x: hidden;
    }
    
    .edu-heading-moul {
        font-family: 'Moul', 'Siemreap', 'Noto Sans Khmer', 'Khmer OS System', sans-serif !important;
        line-height: 1.6;
        letter-spacing: 0px;
    }

    .edu-font-battambang {
        font-family: 'Battambang', 'Siemreap', 'Noto Sans Khmer', 'Khmer OS System', sans-serif !important;
    }

    /* -- Section Title Styling -- */
    .edu-section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .edu-section-title h2 {
        font-size: 2.2rem;
        color: var(--uni-blue-deep);
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .edu-section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--uni-blue-deep) 0%, var(--uni-gold-primary) 100%);
        border-radius: 2px;
    }

    .edu-section-title p {
        color: var(--text-muted);
        font-size: 1.05rem;
        max-width: 650px;
        margin: 0 auto;
    }

    /* -- Hero Banner Section -- */
    .library-hero-banner {
        position: relative;
        min-height: 550px;
        background: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        color: var(--text-white);
        z-index: 1;
    }

    .library-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(7, 30, 61, 0.9) 0%, rgba(11, 47, 100, 0.75) 100%);
        z-index: -1;
    }

    .hero-banner-content {
        max-width: 800px;
    }

    .hero-badge {
        background-color: var(--uni-gold-primary);
        color: var(--uni-blue-dark);
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 25px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }

    .hero-banner-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--text-white);
        margin-bottom: 25px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .hero-banner-content p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 35px;
    }

    .hero-btns .btn-gold {
        background-color: var(--uni-gold-primary);
        color: var(--uni-blue-dark);
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 6px;
        transition: all 0.3s ease;
        border: 2px solid var(--uni-gold-primary);
    }

    .hero-btns .btn-gold:hover {
        background-color: transparent;
        color: var(--text-white);
        border-color: var(--text-white);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
    }

    .hero-btns .btn-outline {
        background-color: transparent;
        color: var(--text-white);
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 6px;
        border: 2px solid var(--text-white);
        margin-left: 15px;
        transition: all 0.3s ease;
    }

    .hero-btns .btn-outline:hover {
        background-color: var(--text-white);
        color: var(--uni-blue-deep);
        transform: translateY(-3px);
    }

    /* -- Heading & Intro Section -- */
    .library-intro-section {
        padding: 80px 0;
    }

    .intro-img-wrapper {
        position: relative;
        padding-right: 20px;
    }

    .intro-img-main {
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .intro-badge-card {
        position: absolute;
        bottom: -20px;
        right: 0;
        background: var(--uni-blue-gradient);
        color: var(--text-white);
        padding: 25px;
        border-radius: 12px;
        max-width: 260px;
        box-shadow: 0 15px 35px rgba(11, 47, 100, 0.2);
        border-left: 5px solid var(--uni-gold-primary);
    }

    .intro-badge-card h4 {
        color: var(--uni-gold-primary);
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .intro-content-right {
        padding-left: 20px;
    }

    .intro-content-right h3 {
        font-size: 2rem;
        color: var(--uni-blue-deep);
        margin-bottom: 20px;
    }

    .intro-content-right p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    /* -- Mission & Vision Section -- */
    .mission-vision-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
    }

    .mv-card {
        background: var(--card-glass-bg);
        border: 1px solid var(--card-glass-border);
        border-radius: 16px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .mv-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--uni-blue-deep);
        transition: all 0.3s ease;
    }

    .mv-card.vision-card::before {
        background: var(--uni-gold-primary);
    }

    .mv-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-hover-shadow);
    }

    .mv-icon-box {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: rgba(11, 47, 100, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        font-size: 28px;
        color: var(--uni-blue-deep);
        transition: all 0.3s ease;
    }

    .vision-card .mv-icon-box {
        background-color: rgba(212, 175, 55, 0.15);
        color: var(--uni-gold-dark);
    }

    .mv-card:hover .mv-icon-box {
        background-color: var(--uni-blue-deep);
        color: var(--text-white);
        transform: rotateY(180deg);
    }

    .mv-card.vision-card:hover .mv-icon-box {
        background-color: var(--uni-gold-primary);
        color: var(--uni-blue-dark);
    }

    .mv-card h3 {
        font-size: 1.6rem;
        color: var(--uni-blue-deep);
        margin-bottom: 15px;
    }

    .mv-card p {
        color: var(--text-muted);
        line-height: 1.8;
        font-size: 1rem;
    }

    /* -- Library Statistics Section -- */
    .library-stats-section {
        padding: 80px 0;
        background: var(--uni-blue-gradient);
        color: var(--text-white);
        position: relative;
    }

    .stat-box {
        text-align: center;
        padding: 30px;
        border-radius: 12px;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        background: var(--glass-hover-bg);
        transform: scale(1.05);
    }

    .stat-icon {
        font-size: 3rem;
        color: var(--uni-gold-primary);
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 3.2rem;
        font-weight: 700;
        color: var(--text-white);
        margin-bottom: 10px;
        letter-spacing: -1px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
    }

    /* -- Services Section -- */
    .library-services-section {
        padding: 100px 0;
        background-color: #ffffff;
    }

    .service-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 35px;
        text-align: center;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(11, 47, 100, 0.12);
        border-color: rgba(11, 47, 100, 0.2);
    }

    .service-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(11, 47, 100, 0.05) 0%, rgba(11, 47, 100, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: var(--uni-blue-deep);
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon-wrapper {
        background: var(--uni-blue-gradient);
        color: var(--uni-gold-primary);
        transform: scale(1.1);
    }

    .service-card h4 {
        font-size: 1.35rem;
        color: var(--uni-blue-deep);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .service-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.7;
    }

    /* -- Featured Facilities -- */
    .library-facilities-section {
        padding: 100px 0;
        background-color: #f8fafc;
    }

    .facility-gallery-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
        height: 280px;
    }

    .facility-gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .facility-gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(360deg, rgba(7, 30, 61, 0.95) 0%, rgba(11, 47, 100, 0.2) 100%);
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 30px;
        color: var(--text-white);
    }

    .facility-gallery-item:hover .facility-gallery-img {
        transform: scale(1.15);
    }

    .facility-gallery-item:hover .facility-gallery-overlay {
        opacity: 1;
    }

    .facility-gallery-overlay h4 {
        font-size: 1.4rem;
        color: var(--uni-gold-primary);
        margin-bottom: 8px;
    }

    .facility-gallery-overlay p {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: rgba(255, 255, 255, 0.8);
    }

    /* -- Timeline Section -- */
    .library-timeline-section {
        padding: 100px 0;
        background-color: #ffffff;
    }

    .timeline-container {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 0;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 4px;
        background-color: rgba(11, 47, 100, 0.15);
        transform: translateX(-50%);
    }

    .timeline-block {
        position: relative;
        margin-bottom: 50px;
        width: 50%;
    }

    .timeline-block-left {
        left: 0;
        padding-right: 40px;
        text-align: right;
    }

    .timeline-block-right {
        left: 50%;
        padding-left: 40px;
        text-align: left;
    }

    .timeline-dot {
        position: absolute;
        top: 15px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: var(--text-white);
        border: 4px solid var(--uni-gold-primary);
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
        z-index: 10;
        transition: all 0.3s ease;
    }

    .timeline-block-left .timeline-dot {
        right: -12px;
    }

    .timeline-block-right .timeline-dot {
        left: -12px;
    }

    .timeline-block:hover .timeline-dot {
        background-color: var(--uni-blue-deep);
        transform: scale(1.3);
    }

    .timeline-content-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
    }

    .timeline-block:hover .timeline-content-card {
        border-color: rgba(181, 148, 16, 0.4);
        background: #ffffff;
    }

    .timeline-year {
        display: inline-block;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--uni-gold-dark);
        margin-bottom: 8px;
    }

    .timeline-content-card h4 {
        color: var(--uni-blue-deep);
        font-size: 1.2rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .timeline-content-card p {
        font-size: 0.95rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* -- Staff Profiles -- */
    .library-staff-section {
        padding: 100px 0;
        background-color: #f8fafc;
    }

    .staff-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        height: 100%;
    }

    .staff-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(11, 47, 100, 0.1);
    }

    .staff-img-box {
        position: relative;
        height: 300px;
        overflow: hidden;
    }

    .staff-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .staff-card:hover .staff-img-box img {
        transform: scale(1.08);
    }

    .staff-social-overlay {
        position: absolute;
        bottom: -50px;
        left: 0;
        width: 100%;
        background: linear-gradient(360deg, rgba(7, 30, 61, 0.9) 0%, rgba(7, 30, 61, 0) 100%);
        padding: 15px;
        display: flex;
        justify-content: center;
        transition: all 0.4s ease;
        opacity: 0;
    }

    .staff-card:hover .staff-social-overlay {
        bottom: 0;
        opacity: 1;
    }

    .staff-social-overlay a {
        color: var(--text-white);
        margin: 0 10px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .staff-social-overlay a:hover {
        color: var(--uni-gold-primary);
    }

    .staff-info {
        padding: 25px;
        text-align: center;
    }

    .staff-info h4 {
        font-size: 1.25rem;
        color: var(--uni-blue-deep);
        margin-bottom: 5px;
        font-weight: 700;
    }

    .staff-info p {
        color: var(--uni-gold-dark);
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .staff-desc {
        color: var(--text-muted) !important;
        font-size: 0.9rem !important;
        font-weight: 400 !important;
        line-height: 1.6;
        margin-bottom: 0 !important;
    }

    /* -- Student Testimonials -- */
    .library-testimonials-section {
        padding: 100px 0;
        background-color: #ffffff;
    }

    .testimonial-item {
        background: #f8fafc;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        height: 100%;
        position: relative;
    }

    .testimonial-quote-icon {
        position: absolute;
        top: 30px;
        right: 35px;
        font-size: 3rem;
        color: rgba(11, 47, 100, 0.05);
    }

    .testimonial-stars {
        color: var(--uni-gold-primary);
        margin-bottom: 15px;
    }

    .testimonial-text {
        font-size: 1.05rem;
        color: var(--text-dark);
        line-height: 1.8;
        font-style: italic;
        margin-bottom: 25px;
    }

    .testimonial-user {
        display: flex;
        align-items: center;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid var(--uni-gold-primary);
    }

    .testimonial-meta h5 {
        font-size: 1.1rem;
        color: var(--uni-blue-deep);
        margin-bottom: 3px;
        font-weight: 700;
    }

    .testimonial-meta span {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    /* -- CTA Banner Section -- */
    .library-cta-section {
        padding: 100px 0;
        background: url('https://images.unsplash.com/photo-1548048026-5a1a941d93d3?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
        background-size: cover;
        position: relative;
        text-align: center;
        color: var(--text-white);
        z-index: 1;
    }

    .library-cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(7, 30, 61, 0.95) 0%, rgba(11, 47, 100, 0.85) 100%);
        z-index: -1;
    }

    .cta-content-wrapper {
        max-width: 750px;
        margin: 0 auto;
    }

    .cta-content-wrapper h2 {
        font-size: 2.8rem;
        color: var(--text-white);
        margin-bottom: 20px;
    }

    .cta-content-wrapper p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        line-height: 1.8;
    }

    .cta-btns .btn-gold {
        background-color: var(--uni-gold-primary);
        color: var(--uni-blue-dark);
        font-weight: 700;
        padding: 15px 40px;
        border-radius: 6px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid var(--uni-gold-primary);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }

    .cta-btns .btn-gold:hover {
        background-color: transparent;
        color: var(--text-white);
        border-color: var(--text-white);
        transform: translateY(-3px);
    }

    /* -- Responsive Styling -- */
    @media (max-width: 991px) {
        .hero-banner-content h1 {
            font-size: 2.8rem;
        }
        .intro-img-wrapper {
            padding-right: 0;
            margin-bottom: 50px;
        }
        .intro-content-right {
            padding-left: 0;
        }
        .timeline-container::before {
            left: 20px;
        }
        .timeline-block {
            width: 100%;
            padding-left: 55px;
            padding-right: 0;
            text-align: left;
        }
        .timeline-block-left {
            left: 0;
        }
        .timeline-block-right {
            left: 0;
        }
        .timeline-block-left .timeline-dot,
        .timeline-block-right .timeline-dot {
            left: 9px;
            right: auto;
        }
    }

    @media (max-width: 768px) {
        .hero-banner-content h1 {
            font-size: 2.2rem;
        }
        .hero-badge {
            margin-bottom: 15px;
        }
        .hero-btns .btn-outline {
            margin-left: 0;
            margin-top: 15px;
            display: block;
        }
        .hero-btns .btn-gold {
            display: block;
            width: 100%;
        }
        .edu-section-title h2 {
            font-size: 1.8rem;
        }
        .stat-box {
            margin-bottom: 20px;
        }
    }
</style>

<div class="edu-about-page">
    
    <!-- 1. Hero Banner Section -->
    <section class="library-hero-banner">
        <div class="container">
            <div class="hero-banner-content wow fadeInUp" data-wow-delay=".2s">
                <span class="hero-badge edu-font-battambang">{{ $about->subtitle ?? 'ស្វាគមន៍មកកាន់បណ្ណាល័យវិទ្យាសាស្ត្រ' }}</span>
                <h1 class="edu-heading-moul">{{ $about->title ?? 'បណ្ណាល័យតេជោសន្តិភាព' }}</h1>
                <p class="edu-font-battambang">
                    {{ $about->hero_description ?? 'មជ្ឈមណ្ឌលស្រាវជ្រាវ និងសិក្សាឈានមុខគេ ដែលប្រមូលផ្តុំទៅដោយធនធានវិទ្យាសាស្ត្រ សៀវភៅ ឯកសារសិក្សា និងបណ្ណសារអេឡិចត្រូនិចដ៏សំបូរបែប សម្រាប់បម្រើដល់ការសិក្សារបស់សិស្សានុសិស្ស គ្រូឧទ្ទេស និងអ្នកស្រាវជ្រាវគ្រប់រូប។' }}
                </p>
                <div class="hero-btns edu-font-battambang">
                    <a href="#services" class="btn btn-gold">
                        ស្វែងរកសេវាកម្មរបស់យើង <i class="fa-solid fa-arrow-down ms-2"></i>
                    </a>
                    <a href="{{ front_url('books') }}" class="btn btn-outline">
                        ស្វែងរកសៀវភៅ <i class="fa-solid fa-search ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Heading Section (Intro) -->
    <section class="library-intro-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay=".3s">
                    <div class="intro-img-wrapper">
                        <img src="{{ asset('frontend/assets/img/about.jpg') }}" alt="Students studying in Library" class="intro-img-main">
                        <div class="intro-badge-card edu-font-battambang">
                            <h4>{{ $about->years_of_service ?? '10' }}+ ឆ្នាំ</h4>
                            <p class="mb-0 text-white">{{ $about->service_description ?? 'នៃការបម្រើការ និងរួមចំណែកកសាងធនធានមនុស្សក្នុងប្រទេសកម្ពុជា' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay=".3s">
                    <div class="intro-content-right">
                        <h3 class="edu-heading-moul">ការណែនាំអំពីបណ្ណាល័យ</h3>
                        <p class="edu-font-battambang">
                            បណ្ណាល័យតេជោសន្តិភាព ត្រូវបានបង្កើតឡើងក្នុងគោលបំណងលើកកម្ពស់វប្បធម៌នៃការអាន ការសិក្សាស្រាវជ្រាវ និងការស្វែងរកចំណេះដឹងថ្មីៗ។ បណ្ណាល័យរបស់យើងផ្តល់ជូននូវបរិយាកាសសិក្សាដ៏ល្អប្រសើរ និងបរិក្ខារសមស្របតាមស្តង់ដារអប់រំ។
                        </p>
                        <p class="edu-font-battambang">
                            យើងផ្តល់ភាពងាយស្រួលដល់អ្នកសិក្សាតាមរយៈប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យឌីជីថល ដែលអនុញ្ញាតឱ្យសិស្សានុសិស្សស្វែងរក និងកក់សៀវភៅតាមអនឡាញ ក៏ដូចជាចូលទៅកាន់មូលដ្ឋានទិន្នន័យស្រាវជ្រាវទំនើបទូទាំងសកលលោក។
                        </p>
                        <div class="mt-4 edu-font-battambang">
                            <a href="#stats" class="theme-btn" style="background-color: var(--uni-blue-deep); color: white;">
                                មើលស្ថិតិបណ្ណាល័យ <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 3. Mission and Vision Section -->
    <section class="mission-vision-section">
        <div class="container">
            <div class="edu-section-title">
                <h2 class="edu-heading-moul">បេសកកម្ម និងចក្ខុវិស័យ</h2>
                <p class="edu-font-battambang">ច្បាប់ចម្លងការប្រើប្រាស់អត្ថបទនេះសម្រាប់បង្ហាញពីគោលបំណង និងចក្ខុវិស័យរបស់បណ្ណាល័យនៅលើទំព័រអំពីយើង។</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="mv-card">
                        <div class="mv-icon-box">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h3 class="edu-heading-moul">បេសកកម្ម (Mission)</h3>
                        <p class="edu-font-battambang">
                            ផ្តល់នូវបរិយាកាសសិក្សាដ៏ល្អប្រសើរ និងធនធានចម្បងដល់សិស្សានុសិស្ស គ្រូបង្រៀន និងអ្នកស្រាវជ្រាវ ដើម្បីលើកកម្ពស់វប្បធម៌សម្រាប់ការវិទ្យាសាស្ត្រ និងការសិក្សា។
                        </p>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="mv-card vision-card">
                        <div class="mv-icon-box">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h3 class="edu-heading-moul">ចក្ខុវិស័យ (Vision)</h3>
                        <p class="edu-font-battambang">
                            ក្លាយជាបណ្ណាល័យលំដាប់ជាច្រើនដែលនាំមកនូវផលប្រយោជន៍ដល់សហគមន៍ និងក្លាយជាមជ្ឈមណ្ឌលសិក្សាស្រាវជ្រាវដែលមានលក្ខណៈលូតលាស់ និងទំនើបទាន់សម័យ។
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Statistics Section -->
    <section id="stats" class="library-stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay=".1s">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                        <div class="stat-number">50,000+</div>
                        <div class="stat-label edu-font-battambang">សៀវភៅបោះពុម្ព</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="fa-solid fa-laptop"></i></div>
                        <div class="stat-number">2,000+</div>
                        <div class="stat-label edu-font-battambang">ធនធានឌីជីថល</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-number">500+</div>
                        <div class="stat-label edu-font-battambang">អ្នកស្រាវជ្រាវ</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-number">1,000+</div>
                        <div class="stat-label edu-font-battambang">សិស្សដែលប្រើសេវា</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Services Section -->
    <section id="services" class="library-services-section">
        <div class="container">
            <div class="edu-section-title">
                <h2 class="edu-heading-moul">សេវាកម្មបណ្ណាល័យ</h2>
                <p class="edu-font-battambang">យើងផ្តល់ជូននូវសេវាកម្មសំខាន់ៗ ដើម្បីគាំទ្រការសិក្សា និងការស្រាវជ្រាវរបស់សមាជិកបណ្ណាល័យទាំងអស់។</p>
            </div>
            <div class="row g-4">
                <!-- 1. Book Borrowing -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".1s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <h4 class="edu-font-battambang">ការខ្ចី-សងសៀវភៅ</h4>
                        <p class="edu-font-battambang">សេវាកម្មខ្ចីសៀវភៅ និងសៀវភៅអានកម្សាន្តដោយងាយស្រួល ជាមួយនឹងរយៈពេលសមស្រប និងប្រព័ន្ធគ្រប់គ្រងស្វ័យប្រវត្តិ។</p>
                    </div>
                </div>
                <!-- 2. Digital Library -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <h4 class="edu-font-battambang">បណ្ណាល័យអេឡិចត្រូនិច</h4>
                        <p class="edu-font-battambang">ការចូលទៅកាន់ប្រព័ន្ធផ្ទុកសៀវភៅអេឡិចត្រូនិច E-books អត្ថបទស្រាវជ្រាវ និងធនធានអនឡាញគ្រប់ពេលវេលា។</p>
                    </div>
                </div>
                <!-- 3. Research Support -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-magnifying-glass-chart"></i>
                        </div>
                        <h4 class="edu-font-battambang">ការគាំទ្រការស្រាវជ្រាវ</h4>
                        <p class="edu-font-battambang">ការជួយណែនាំ និងផ្តល់ប្រឹក្សាពីបណ្ណារក្សជំនាញអំពីវិធីសាស្ត្រស្វែងរកឯកសារយោង និងការសរសេរអត្ថបទវិទ្យាសាស្ត្រ។</p>
                    </div>
                </div>
                <!-- 4. Reading Rooms -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-person-shelter"></i>
                        </div>
                        <h4 class="edu-font-battambang">បន្ទប់អាន និងពិភាក្សា</h4>
                        <p class="edu-font-battambang">បន្ទប់អានស្ងប់ស្ងាត់សម្រាប់បុគ្គល និងបន្ទប់ពិភាក្សាក្រុមសម្រាប់ការងារសហការគ្នា។</p>
                    </div>
                </div>
                <!-- 5. Online Catalog -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <h4 class="edu-font-battambang">កាតាឡុកអនឡាញ (OPAC)</h4>
                        <p class="edu-font-battambang">ប្រព័ន្ធស្វែងរកសៀវភៅតាមអនឡាញ និងទូរស័ព្ទដៃ ដើម្បីត្រួតពិនិត្យភាពមានសៀវភៅ និងទីតាំងស្តុក។</p>
                    </div>
                </div>
                <!-- 6. WiFi Access -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h4 class="edu-font-battambang">អ៊ីនធឺណិតល្បឿនលឿន</h4>
                        <p class="edu-font-battambang">ការផ្តល់ជូននូវបណ្តាញអ៊ីនធឺណិត WiFi ល្បឿនលឿនទូទាំងបណ្ណាល័យ ដើម្បីទាញយកឯកសារសិក្សា។</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Featured Library Facilities (Gallery) -->
    <section class="library-facilities-section">
        <div class="container">
            <div class="edu-section-title">
                <h2 class="edu-heading-moul">បរិក្ខារ និងកន្លែងសិក្សាលេចធ្លោ</h2>
                <p class="edu-font-battambang">ស្វែងយល់ពីកន្លែងសិក្សា និងបន្ទប់បម្រើសេវាកម្មដែលមានបរិយាកាសសមស្រប និងគុណភាពខ្ពស់។</p>
            </div>
            <div class="row">
                <!-- Facility 1 -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".1s">
                    <div class="facility-gallery-item">
                        <img src="{{ asset('frontend/assets/img/about.jpg') }}" alt="Main Reading Hall" class="facility-gallery-img">
                        <div class="facility-gallery-overlay edu-font-battambang">
                            <h4>សាលអានកណ្ដាល</h4>
                            <p>កន្លែងអានសៀវភៅដ៏ធំទូលាយ មានពន្លឺធម្មជាតិ និងបរិយាកាសស្ងប់ស្ងាត់។</p>
                        </div>
                    </div>
                </div>
                <!-- Facility 2 -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".2s">
                    <div class="facility-gallery-item">
                        <img src="{{ asset('frontend/assets/img/readingbook.jpg') }}" alt="E-Library Lab" class="facility-gallery-img">
                        <div class="facility-gallery-overlay edu-font-battambang">
                            <h4>បន្ទប់កុំព្យូទ័រ E-Lab</h4>
                            <p>បន្ទប់កុំព្យូទ័រសម្រាប់ការស្រាវជ្រាវ និងចូលប្រើធនធានអនឡាញ។</p>
                        </div>
                    </div>
                </div>
                <!-- Facility 3 -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                    <div class="facility-gallery-item">
                        <img src="{{ asset('frontend/assets/img/banner/book-banner-2.jpg') }}" alt="Discussion Rooms" class="facility-gallery-img">
                        <div class="facility-gallery-overlay edu-font-battambang">
                            <h4>បន្ទប់ពិភាក្សាក្រុម</h4>
                            <p>កន្លែងសម្រាប់ការងារជាក្រុម ការបង្ហាញមេរៀន និងការសហការគ្នា។</p>
                        </div>
                    </div>
                </div>
                <!-- Facility 4 -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".4s">
                    <div class="facility-gallery-item">
                        <img src="{{ asset('frontend/assets/img/banner/book-banner-3.jpg') }}" alt="Research Archives" class="facility-gallery-img">
                        <div class="facility-gallery-overlay edu-font-battambang">
                            <h4>បណ្ណសារស្រាវជ្រាវ</h4>
                            <p>កន្លែងរក្សាទុកឯកសារ និងសៀវភៅកម្ររបស់បណ្ណាល័យ។</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Timeline Section -->
    <section class="library-timeline-section">
        <div class="container">
            <div class="edu-section-title">
                <h2 class="edu-heading-moul">ប្រវត្តិនៃការអភិវឌ្ឍ</h2>
                <p class="edu-font-battambang">ការអភិវឌ្ឍ និងការពង្រីកបណ្ណាល័យតាមលំដាប់ពេលវេលា។</p>
            </div>
            <div class="timeline-container">
                <!-- Timeline Year 1 -->
                <div class="timeline-block timeline-block-left wow fadeInLeft" data-wow-delay=".1s">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content-card edu-font-battambang">
                        <span class="timeline-year">2018</span>
                        <h4>ការបង្កើតបណ្ណាល័យ</h4>
                        <p>បណ្ណាល័យត្រូវបានបង្កើតឡើងជាមួយសៀវភៅប្រមាណ ៥,០០០ ក្បាល និងទីកន្លែងអានដំបូង។</p>
                    </div>
                </div>
                <!-- Timeline Year 2 -->
                <div class="timeline-block timeline-block-right wow fadeInRight" data-wow-delay=".2s">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content-card edu-font-battambang">
                        <span class="timeline-year">2020</span>
                        <h4>ការពង្រីក និងបន្ថែម E-Lab</h4>
                        <p>ចាប់ផ្តើមដាក់ឱ្យប្រើប្រាស់បន្ទប់កុំព្យូទ័រសម្រាប់ការស្រាវជ្រាវ និងសិក្សាឌីជីថល។</p>
                    </div>
                </div>
                <!-- Timeline Year 3 -->
                <div class="timeline-block timeline-block-left wow fadeInLeft" data-wow-delay=".3s">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content-card edu-font-battambang">
                        <span class="timeline-year">2022</span>
                        <h4>ការបង្កើតមជ្ឈមណ្ឌលស្រាវជ្រាវ</h4>
                        <p>បង្កើតផ្នែកគាំទ្រការស្រាវជ្រាវ និងមូលដ្ឋានទិន្នន័យសម្រាប់អ្នកស្រាវជ្រាវ។</p>
                    </div>
                </div>
                <!-- Timeline Year 4 -->
                <div class="timeline-block timeline-block-right wow fadeInRight" data-wow-delay=".4s">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content-card edu-font-battambang">
                        <span class="timeline-year">2025</span>
                        <h4>ការភ្ជាប់ទំនាក់ទំនងបណ្ណាល័យសកល</h4>
                        <p>ភ្ជាប់ជាមួយប្រព័ន្ធកាតាឡុកអនឡាញ និងធនធានឌីជីថលពិភពលោក។</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Staff and Librarians Section -->
    <section class="library-staff-section">
        <div class="container">
            <div class="edu-section-title">
                <h2 class="edu-heading-moul">ថ្នាក់ដឹកនាំ និងបណ្ណារក្ស</h2>
                <p class="edu-font-battambang">បុគ្គលិកដែលមានវិជ្ជាជីវៈ និងបទពិសោធន៍ខ្ពស់ រង់ចាំជួយសម្រួលដល់ការសិក្សារបស់អ្នកគ្រប់ពេលវេលា។</p>
            </div>
            <div class="row g-4">
                @forelse($staffMembers as $staff)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="{{ ($loop->iteration * 0.2) }}s">
                        <div class="staff-card">
                            <div class="staff-img-box">
                                <img src="{{ $staff->image_url }}" alt="{{ $staff->name }}">
                                <div class="staff-social-overlay">
                                    @if($staff->facebook_url)
                                        <a href="{{ $staff->facebook_url }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if($staff->twitter_url)
                                        <a href="{{ $staff->twitter_url }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if($staff->linkedin_url)
                                        <a href="{{ $staff->linkedin_url }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="staff-info edu-font-battambang">
                                <h4>{{ $staff->name }}</h4>
                                <p>{{ $staff->position }}</p>
                                <p class="staff-desc">{{ $staff->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center mb-0">
                            មិនទាន់មានថ្នាក់ដឹកនាំ ឬបណ្ណារក្សត្រូវបានបន្ថែមនៅឡើយ។
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 10. Call to Action (CTA) Section -->
    <section class="library-cta-section">
        <div class="container">
            <div class="cta-content-wrapper wow scaleIn" data-wow-delay=".2s">
                <h2 class="edu-heading-moul">មកកាន់បណ្ណាល័យថ្ងៃនេះ ដើម្បីពង្រីកចំណេះដឹងរបស់អ្នក!</h2>
                <p class="edu-font-battambang">
                    បណ្ណាល័យតេជោសន្តិភាព បើកទ្វារស្វាគមន៍និស្សិត គ្រូឧទ្ទេស និងអ្នកស្រាវជ្រាវទាំងអស់រៀងរាល់ថ្ងៃចន្ទ ដល់ថ្ងៃសុក្រ ចាប់ពីម៉ោង ៧:០០ ព្រឹក ដល់ម៉ោង ៥:០០ ល្ងាច។
                </p>
                <div class="cta-btns edu-font-battambang">
                    <a href="{{ front_url('contact') }}" class="btn btn-gold">
                        ទំនាក់ទំនងកក់កន្លែងសិក្សា <i class="fa-solid fa-envelope ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection


