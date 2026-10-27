@extends(front_layout('main'))
@section('content')

<!-- Hero Section start  -->
<style>
    .travel-slider-wrap {
        position: relative;
        width: 100%;
        height: 440px;
        margin: 0 auto;
        background: #000;
        color: #fff;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }
    .bg-swiper {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%; height: 100%;
        z-index: 1;
    }
    .bg-swiper .swiper-slide {
        background-size: cover;
        background-position: center;
    }
    .bg-swiper .swiper-slide::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
    }

    /* Mobile img fallback inside slide */
    .slide-img-mobile {
        display: none;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
    }

    .slider-content-left {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 8%;
        z-index: 10;
        width: 40%;
    }
    .slider-content-left .subtitle {
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 13px;
        margin-bottom: 15px;
        position: relative;
        padding-left: 45px;
        color: rgba(255,255,255,0.8);
        font-weight: 600;
    }
    .slider-content-left .subtitle::before {
        content: '';
        position: absolute;
        left: 0; top: 50%;
        width: 30px; height: 2px;
        background: #D4AF37;
    }
    .slider-content-left h1 {
        font-size: 5rem;
        line-height: 1.3;
        font-weight: 800;
        margin-bottom: 25px;
        color: #fff;
        text-shadow: 2px 4px 10px rgba(0,0,0,0.5);
        font-family: 'Kantumruy Pro', 'Moul', 'Battambang', sans-serif;
    }
    .slider-content-left p {
        font-size: 16px;
        color: #e0e0e0;
        margin-bottom: 40px;
        line-height: 1.7;
        max-width: 85%;
        font-weight: 300;
    }
    .btn-discover {
        display: inline-flex;
        align-items: center;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        padding: 14px 35px;
        border-radius: 50px;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 2px;
        text-decoration: none;
        transition: all 0.4s ease;
        font-weight: 600;
    }
    .btn-discover:hover {
        background: #D4AF37;
        border-color: #D4AF37;
        box-shadow: 0 10px 20px rgba(212,175,55,0.4);
        transform: translateY(-2px);
        color: #fff;
    }
    .btn-icon-custom {
        background: #D4AF37;
        color: #fff;
        width: 45px; height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: -15px;
        margin-left: 20px;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(212,175,55,0.4);
    }

    /* Progress and Controls */
    .slider-bottom-bar {
        position: absolute;
        bottom: 5%;
        left: 8%;
        right: 5%;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .slider-nav-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .swiper-nav-btn {
        width: 45px; height: 45px;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        transition: 0.3s;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(5px);
    }
    .swiper-nav-btn:hover {
        background: #D4AF37;
        border-color: #D4AF37;
        transform: scale(1.1);
    }
    .progress-container {
        flex-grow: 1;
        margin: 0 40px;
        height: 2px;
        background: rgba(255,255,255,0.2);
        position: relative;
        overflow: hidden;
    }
    .progress-fill {
        position: absolute;
        top: 0; left: 0; bottom: 0;
        background: #D4AF37;
        width: 0%;
    }
    .slider-counter {
        font-size: 4rem;
        font-weight: 800;
        color: rgba(255,255,255,0.3);
        line-height: 1;
        letter-spacing: -2px;
    }
    .slider-counter span {
        font-size: 1.5rem;
        color: rgba(255,255,255,0.1);
        vertical-align: super;
    }
    
    /* Animations for left content */
    .slider-content-left .animate-elem {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .swiper-slide-active .slider-content-left .animate-elem {
        opacity: 1;
        transform: translateY(0);
    }
    .swiper-slide-active .slider-content-left h1 { transition-delay: 0.2s; }
    .swiper-slide-active .slider-content-left p { transition-delay: 0.4s; }
    .swiper-slide-active .slider-content-left .btn-wrap { transition-delay: 0.6s; }

    @media (max-width: 1199px) {
        .travel-slider-wrap { height: 380px; }
        .slider-content-left h1 { font-size: 4rem; }
    }
    @media (max-width: 991px) {
        .travel-slider-wrap { height: 300px; }
        .slider-content-left { width: 90%; top: 25%; text-align: center; left: 5%; }
        .slider-content-left h1 { font-size: 3.5rem; }
        .slider-content-left .subtitle::before { display: none; }
        .slider-content-left .subtitle { padding-left: 0; }
        .slider-content-left .btn-wrap { justify-content: center; }
        .slider-content-left p { margin: 0 auto 30px; }
        .slider-bottom-bar { display: none; }
    }
    @media (max-width: 767px) {
        /* Let the slide height be auto based on image */
        .travel-slider-wrap {
            height: auto !important;
            background: transparent;
        }
        .bg-swiper {
            position: relative;
            width: 100%;
            height: auto;
        }
        .bg-swiper .swiper-slide {
            background-image: none !important;
            height: auto !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .slide-img-mobile {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        .slider-content-left { display: none; }
        .slider-bottom-bar { display: none; }
    }
</style>

<div class="travel-slider-wrap">
    <!-- Main Background Swiper -->
    <div class="swiper bg-swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide" style="background-image: url('{{asset('frontend/assets/img/caruOne.png')}}');">
                <img class="slide-img-mobile" src="{{asset('frontend/assets/img/caruOne.png')}}" alt="Slide 1">
                <div class="slider-content-left">
                    <!-- <div class="subtitle animate-elem">Techo Peace Library</div> -->
                     <!-- <h1 class="animate-elem">អានសៀវភៅ<br>បង្កើនចំណេះ</h1> -->
                    <!-- <p class="animate-elem">បណ្ណាល័យយើងខ្ញុំផ្តល់ជូនបរិយាកាសអានដ៏ល្អឥតខ្ចោះ និងឯកសារគ្រប់ប្រភេទសម្រាប់និស្សិតគ្រប់រូប។ ចាប់ផ្តើមការអានរបស់អ្នកនៅថ្ងៃនេះ!</p> -->
                    <div class="btn-wrap animate-elem" style="display: flex; align-items: center;"> -->
                        <!-- <span class="btn-icon-custom"><i class="fa fa-bookmark"></i></span> -->
                        <!-- <a href="{{ front_url('books') }}" class="btn-discover">DISCOVER BOOKS</a> -->
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide" style="background-image: url('{{asset('frontend/assets/img/caruselTow.png')}}');">
                <img class="slide-img-mobile" src="{{asset('frontend/assets/img/caruselTow.png')}}" alt="Slide 2">
                <div class="slider-content-left">
                    <!-- <div class="subtitle animate-elem">New Arrivals - 2026</div> -->
                    <!-- <h1 class="animate-elem">សៀវភៅ<br>ថ្មីៗបំផុត</h1> -->
                    <!-- <p class="animate-elem">ស្វែងរកសៀវភៅ និងឯកសារស្រាវជ្រាវជាច្រើនដែលទើបតែបន្ថែមថ្មីៗ។ មានសៀវភៅល្អៗរាប់ពាន់ក្បាលរង់ចាំអ្នក។</p> -->
                    <div class="btn-wrap animate-elem" style="display: flex; align-items: center;"> -->
                        <!-- <span class="btn-icon-custom"><i class="fa fa-book"></i></span> -->
                        <!-- <a href="{{ front_url('books') }}" class="btn-discover">VIEW COLLECTION</a> -->
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide" style="background-image: url('{{asset('frontend/assets/img/caruselTree.png')}}'); background-color: #2b2b2b; background-size: cover; background-position: top center;">
                <img class="slide-img-mobile" src="{{asset('frontend/assets/img/caruselTree.png')}}" alt="Slide 3">
                <div class="slider-content-left">
                    <!-- <div class="subtitle animate-elem">Student Area - PSBU</div> -->
                    <!-- <h1 class="animate-elem">ទីកន្លែង<br>សិក្សាស្រាវជ្រាវ</h1>  -->
                    <!-- <p class="animate-elem">បណ្ណាល័យផ្តល់ជូនកន្លែងអង្គុយអានយ៉ាងមានផាសុកភាព ស្ងប់ស្ងាត់ និងមានអ៊ីនធឺណិតល្បឿនលឿន។</p> -->
                    <div class="btn-wrap animate-elem" style="display: flex; align-items: center;">
                        <!-- <span class="btn-icon-custom"><i class="fa fa-graduation-cap"></i></span> -->
                        <!-- <a href="{{ front_url('books') }}" class="btn-discover">JOIN US NOW</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
    <!-- Bottom Bar: Controls, Progress, Counter -->
    <div class="slider-bottom-bar">
        <div class="slider-nav-controls">
            <div class="swiper-nav-btn custom-prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="swiper-nav-btn custom-next"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
        <div class="progress-container">
            <div class="progress-fill" id="sliderProgress"></div>
        </div>
        <div class="slider-counter" id="slideCounter">01<span>/03</span></div>
    </div>
</div>

<script>
    var swiperCheck = setInterval(function() {
        if (typeof Swiper !== 'undefined') {
            clearInterval(swiperCheck);
            
            var slideDuration = 6000;
            var progressFill = document.getElementById('sliderProgress');
            var slideCounter = document.getElementById('slideCounter');
            
            var bgSwiper = new Swiper(".bg-swiper", {
                effect: "fade",
                fadeEffect: { crossFade: true },
                speed: 1200,
                navigation: {
                    nextEl: ".custom-next",
                    prevEl: ".custom-prev",
                },
                autoplay: {
                    delay: slideDuration,
                    disableOnInteraction: false,
                },
                on: {
                    init: function () {
                        startProgress();
                    },
                    slideChange: function () {
                        // Update counter
                        var current = this.realIndex + 1;
                        slideCounter.innerHTML = '0' + current + '<span>/03</span>';
                        
                        // Restart progress animation
                        resetProgress();
                        startProgress();
                    }
                }
            });
            
            function startProgress() {
                progressFill.style.transition = 'width ' + slideDuration + 'ms linear';
                progressFill.style.width = '100%';
            }
            
            function resetProgress() {
                progressFill.style.transition = 'none';
                progressFill.style.width = '0%';
                // Force reflow
                void progressFill.offsetWidth;
            }
        }
    }, 100);
</script>

<!-- Feature Section start  -->
{{-- <section class="feature-section fix section-padding">
    <div class="container">
        <div class="feature-wrapper">
            <div class="feature-box-items wow fadeInUp" data-wow-delay=".2s">
                <div class="icon">
                    <i class="icon-icon-1"></i>
                </div>
                <div class="content">
                    <h3>Return & refund</h3>
                    <p>Money back guarantee</p>
                </div>
            </div>
            <div class="feature-box-items wow fadeInUp" data-wow-delay=".4s">
                <div class="icon">
                    <i class="icon-icon-2"></i>
                </div>
                <div class="content">
                    <h3>Secure Payment</h3>
                    <p>30% off by subscribing</p>
                </div>
            </div>
            <div class="feature-box-items wow fadeInUp" data-wow-delay=".6s">
                <div class="icon">
                    <i class="icon-icon-3"></i>
                </div>
                <div class="content">
                    <h3>Quality Support</h3>
                    <p>Always online 24/7</p>
                </div>
            </div>
            <div class="feature-box-items wow fadeInUp" data-wow-delay=".8s">
                <div class="icon">
                    <i class="icon-icon-4"></i>
                </div>
                <div class="content">
                    <h3>Daily Offers</h3>
                    <p>20% off by subscribing</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Shop Section start  -->
<section class="shop-section section-padding fix pt-4">
    <div class="container">
        <div class="section-title-area">
            <div class="section-title">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ __('Featured Books') }}</h2>
            </div>
            <a href="{{front_url('books')}}" class="theme-btn transparent-btn wow fadeInUp" data-wow-delay=".5s">{{ __('Explore More') }} <i
                    class="fa-solid fa-arrow-right-long"></i></a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                @foreach($featuredBooks as $book)
                <div class="swiper-slide">
                    <div class="shop-box-items style-2">
                        <div class="book-thumb center">
                            <a href="{{ front_url('book_details/'. $book->slug); }}"><img src="{{$book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png')}}" alt="{{ $book->title }}" loading="lazy" decoding="async"></a>
                            
                            <ul class="shop-icon d-grid justify-content-center align-items-center">

                                <li>
                                    <a href="{{front_url('book_details/'. $book->slug)}}"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-content">
                            <h3 class="battambang-regular"><a href="{{ front_url('book_details/'. $book->slug) }}">{{$book->title}}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Book Catagories Section start  -->
<section class="book-catagories-section fix section-padding">
    <div class="container">
        <div class="book-catagories-wrapper">
            <div class="section-title text-center">
                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ __('Book Categories') }}</h2>
            </div>
            <div class="array-button">
                <button class="array-prev"><i class="fal fa-arrow-left"></i></button>
                <button class="array-next"><i class="fal fa-arrow-right"></i></button>
            </div>
            <div class="swiper book-catagories-slider">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide">
                        <div class="book-catagories-items">
                            <div class="book-thumb">
                                <img src="{{$category->image ? asset('uploads/category/'. $category->image) : asset('uploads/category/no_image.png')}}" alt="{{ $category->name }}" class="img-fluid" loading="lazy" decoding="async">
                                <div class="circle-shape">
                                    <img src="{{asset('frontend/assets/img/book-categori/circle-shape.png')}}" alt="shape-img">
                                </div>
                            </div>
                           
                            <h3><a href="{{ front_url('books/'. $category->slug); }}">{{$category->name}}</a></h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Section start  -->


<!-- Cta Banner Section start  -->
<!-- Cta Banner & Top Rating Section Styles -->
<style>
    /* ===== PSB UNIVERSITY WELCOME BANNER ===== */
    .cta-banner-section {
        position: relative;
        padding: 50px 0;
        background: #f8fafc;
    }

    .psbu-welcome-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 40px 45px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease;
    }

    .psbu-welcome-card:hover {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    }

    /* Left Column: Photo Collage */
    .psbu-grid-collage {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .collage-main-img {
        border-radius: 16px;
        overflow: hidden;
        height: 210px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .collage-main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .psbu-grid-collage:hover .collage-main-img img {
        transform: scale(1.05);
    }

    .collage-sub-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .collage-sub-img {
        border-radius: 12px;
        overflow: hidden;
        height: 110px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .collage-sub-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .collage-sub-img:hover img {
        transform: scale(1.08);
    }

    /* Middle Column: Text & Signature */
    .psbu-welcome-content {
        padding: 0 10px;
    }

    .psbu-welcome-content .psbu-title {
        color: #002B7F;
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 16px;
        font-family: 'Kantumruy Pro', 'Inter', sans-serif;
    }

    .psbu-welcome-content .psbu-text {
        color: #475569;
        font-size: 0.91rem;
        line-height: 1.75;
        margin-bottom: 24px;
        font-weight: 400;
        font-family: 'Battambang', 'Inter', sans-serif;
    }

    .psbu-signature-block {
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }

    .psbu-signature-block .psbu-role {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 2px;
        display: block;
    }

    .psbu-signature-block .psbu-univ-name {
        color: #0f172a;
        font-weight: 800;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }

    .psbu-signature-block .psbu-rector-name {
        color: #334155;
        font-weight: 700;
        font-size: 0.88rem;
        margin-bottom: 2px;
    }

    .psbu-signature-block .psbu-rector-title {
        color: #64748b;
        font-size: 0.82rem;
        margin: 0;
        line-height: 1.4;
    }

    /* Right Column: Rector Portrait */
    .psbu-rector-portrait {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .portrait-card {
        width: 200px;
        height: 270px;
        border-radius: 36px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        background: linear-gradient(180deg, #d97706 0%, #78350f 100%);
        position: relative;
        border: 3px solid #ffffff;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .portrait-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2);
    }

    .portrait-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    @media (max-width: 991px) {
        .psbu-welcome-card {
            padding: 30px 24px;
        }
        .psbu-welcome-content {
            padding: 0;
            margin-top: 20px;
        }
        .psbu-rector-portrait {
            margin-top: 24px;
        }
    }
        height: 210px;
        top: 50%; left: 50%;
        transform: translate(-62%, -46%) rotate(-12deg);
        background: linear-gradient(135deg, rgba(255, 179, 71, 0.2) 0%, rgba(15, 10, 30, 0.85) 100%);
        border: 1px solid rgba(255, 179, 71, 0.25);
        z-index: 2;
    }

    .cta-book-card-back2 {
        width: 145px;
        height: 200px;
        top: 50%; left: 50%;
        transform: translate(-36%, -54%) rotate(8deg);
        background: linear-gradient(135deg, rgba(120, 80, 220, 0.2) 0%, rgba(10, 5, 25, 0.85) 100%);
        border: 1px solid rgba(120, 80, 220, 0.25);
        z-index: 1;
    }

    .cta-book-icon {
        font-size: 2.8rem;
        color: #FF6500;
        filter: drop-shadow(0 4px 10px rgba(255, 101, 0, 0.5));
    }

    @media (max-width: 991px) {
        .cta-deco-side { display: none; }
        .cta-content-side { padding: 40px 30px; }
        .cta-headline { font-size: 2rem; }
    }

    /* ===== TOP RATING BOOK SECTION ===== */
    .top-ratting-book-section {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        position: relative;
        padding: 80px 0;
    }

    .top-ratting-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .top-ratting-title-group .sub-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 101, 0, 0.1);
        color: #FF6500;
        font-size: 0.82rem;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }

    .top-ratting-title-group h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        font-family: 'Kantumruy Pro', 'Moul', sans-serif;
    }

    .top-ratting-view-all {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #FF6500;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 10px 24px;
        background: #ffffff;
        border: 1px solid rgba(255, 101, 0, 0.25);
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(255, 101, 0, 0.08);
    }

    .top-ratting-view-all:hover {
        background: #FF6500;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 101, 0, 0.3);
    }

    .top-ratting-view-all i {
        transition: transform 0.3s ease;
    }

    .top-ratting-view-all:hover i {
        transform: translateX(4px);
    }

    .top-ratting-card {
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 10px -6px rgba(15, 23, 42, 0.02);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .top-ratting-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #FF6500 0%, #FF9D00 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .top-ratting-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px -10px rgba(255, 101, 0, 0.15), 0 10px 20px -5px rgba(15, 23, 42, 0.06);
        border-color: rgba(255, 101, 0, 0.3);
    }

    .top-ratting-card:hover::before {
        opacity: 1;
    }

    .top-ratting-thumb {
        flex: 0 0 110px;
        height: 145px;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        background: #f1f5f9;
    }

    .top-ratting-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .top-ratting-card:hover .top-ratting-thumb img {
        transform: scale(1.08);
    }

    .top-ratting-content {
        flex: 1;
        padding-left: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 145px;
    }

    .top-ratting-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .top-ratting-stars {
        display: flex;
        align-items: center;
        gap: 3px;
        color: #f59e0b;
        font-size: 0.8rem;
    }

    .top-ratting-stars span {
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 4px;
    }

    .top-ratting-badge {
        background: #fef3c7;
        color: #d97706;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .top-ratting-title {
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.45;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-family: 'Kantumruy Pro', 'Battambang', sans-serif;
    }

    .top-ratting-title a {
        color: #0f172a;
        text-decoration: none;
        transition: color 0.25s ease;
    }

    .top-ratting-card:hover .top-ratting-title a {
        color: #FF6500;
    }

    .top-ratting-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 10px;
        border-top: 1px dashed #e2e8f0;
    }

    .top-ratting-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #FF6500;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .top-ratting-btn i {
        font-size: 0.8rem;
        transition: transform 0.25s ease;
    }

    .top-ratting-card:hover .top-ratting-btn {
        color: #d95200;
    }

    .top-ratting-card:hover .top-ratting-btn i {
        transform: translateX(4px);
    }

    .top-ratting-view-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f8fafc;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .top-ratting-card:hover .top-ratting-view-icon {
        background: #FF6500;
        color: #ffffff;
        border-color: #FF6500;
        box-shadow: 0 4px 12px rgba(255, 101, 0, 0.3);
    }

    @media (max-width: 576px) {
        .top-ratting-card {
            padding: 14px;
        }
        .top-ratting-thumb {
            flex: 0 0 90px;
            height: 125px;
        }
        .top-ratting-content {
            height: 125px;
            padding-left: 14px;
        }
        .top-ratting-title {
            font-size: 0.95rem;
        }
    }

    /* ===== INSPIRATIONAL QUOTE SECTION — PREMIUM REDESIGN ===== */
    .quote-banner-section {
        position: relative;
        padding: 0 0 70px;
        background: #f0f4f8;
        overflow: hidden;
    }

    /* Floating star particles */
    .quote-particles {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }
    .q-particle {
        position: absolute;
        border-radius: 50%;
        opacity: 0;
        animation: q-float linear infinite;
    }
    .q-particle:nth-child(1) { width:4px; height:4px; background:#d4af37; left:8%;  animation-duration:9s;  animation-delay:0s; }
    .q-particle:nth-child(2) { width:3px; height:3px; background:#fff;    left:20%; animation-duration:12s; animation-delay:2s; }
    .q-particle:nth-child(3) { width:5px; height:5px; background:#90cdf4; left:35%; animation-duration:8s;  animation-delay:1s; }
    .q-particle:nth-child(4) { width:3px; height:3px; background:#d4af37; left:55%; animation-duration:11s; animation-delay:3s; }
    .q-particle:nth-child(5) { width:4px; height:4px; background:#fff;    left:72%; animation-duration:7s;  animation-delay:0.5s; }
    .q-particle:nth-child(6) { width:3px; height:3px; background:#90cdf4; left:88%; animation-duration:10s; animation-delay:4s; }
    @keyframes q-float {
        0%   { bottom:-10px; opacity:0; transform:scale(0.5) translateX(0); }
        15%  { opacity:0.85; }
        85%  { opacity:0.5; }
        100% { bottom:110%; opacity:0; transform:scale(1.2) translateX(25px); }
    }

    .quote-card-wrapper {
        position: relative;
        background: linear-gradient(135deg, #0d1b3e 0%, #0b2d6b 40%, #0f3460 70%, #0b2545 100%);
        border-radius: 32px;
        padding: 70px 80px;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 55, 0.2);
        box-shadow:
            0 30px 70px rgba(11, 37, 69, 0.35),
            0 0 0 1px rgba(255,255,255,0.05),
            inset 0 1px 0 rgba(255,255,255,0.08);
    }

    /* Animated mesh gradient overlay */
    .quote-mesh-overlay {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 20% 30%, rgba(212,175,55,0.18) 0%, transparent 60%),
            radial-gradient(ellipse 50% 60% at 80% 70%, rgba(56,189,248,0.15) 0%, transparent 60%),
            radial-gradient(ellipse 40% 40% at 50% 10%, rgba(167,139,250,0.12) 0%, transparent 60%);
        animation: mesh-shift 12s ease-in-out infinite alternate;
        pointer-events: none;
        z-index: 0;
    }
    @keyframes mesh-shift {
        0%   { opacity: 0.7; transform: scale(1) rotate(0deg); }
        100% { opacity: 1;   transform: scale(1.1) rotate(3deg); }
    }

    /* Rotating decorative ring */
    .quote-deco-ring {
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        border: 1px solid rgba(212, 175, 55, 0.1);
        top: 50%;
        right: -100px;
        transform: translateY(-50%);
        animation: ring-spin 30s linear infinite;
        pointer-events: none;
        z-index: 0;
    }
    .quote-deco-ring::before {
        content: '';
        position: absolute;
        inset: 20px;
        border-radius: 50%;
        border: 1px dashed rgba(212, 175, 55, 0.15);
    }
    .quote-deco-ring::after {
        content: '';
        position: absolute;
        inset: 50px;
        border-radius: 50%;
        border: 1px solid rgba(56, 189, 248, 0.1);
    }
    @keyframes ring-spin {
        from { transform: translateY(-50%) rotate(0deg); }
        to   { transform: translateY(-50%) rotate(360deg); }
    }

    /* Shimmer scan line */
    .quote-shimmer-line {
        position: absolute;
        top: 0; left: -100%;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(255,255,255,0.04) 50%,
            transparent 100%);
        animation: shimmer-scan 6s ease-in-out infinite;
        pointer-events: none;
        z-index: 0;
    }
    @keyframes shimmer-scan {
        0%   { left: -60%; }
        100% { left: 120%; }
    }

    /* Inner content */
    .quote-content-inner {
        position: relative;
        z-index: 5;
        text-align: center;
        max-width: 860px;
        margin: 0 auto;
    }

    /* Top open-quote icon with rotating halo */
    .quote-icon-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        margin: 0 auto 28px;
        position: relative;
    }
    .quote-icon-halo {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: conic-gradient(
            from 0deg,
            rgba(212,175,55,0.6),
            rgba(212,175,55,0.1) 60%,
            rgba(212,175,55,0.6)
        );
        animation: halo-spin 4s linear infinite;
        filter: blur(2px);
    }
    @keyframes halo-spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
    .quote-icon-core {
        position: relative;
        z-index: 2;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(212,175,55,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #fcd34d;
        animation: icon-pulse 3s ease-in-out infinite;
        box-shadow: 0 0 20px rgba(212,175,55,0.3), inset 0 0 15px rgba(212,175,55,0.1);
    }
    @keyframes icon-pulse {
        0%, 100% { transform: scale(1);    box-shadow: 0 0 20px rgba(212,175,55,0.3); }
        50%       { transform: scale(1.08); box-shadow: 0 0 35px rgba(212,175,55,0.55); }
    }

    /* Decorative divider dots */
    .quote-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 28px;
    }
    .quote-divider span {
        display: inline-block;
        border-radius: 50%;
        background: rgba(212,175,55,0.4);
        animation: dot-blink 2s ease-in-out infinite;
    }
    .quote-divider span:nth-child(1) { width:6px; height:6px; animation-delay:0s; }
    .quote-divider span:nth-child(2) { width:10px; height:10px; background:rgba(212,175,55,0.7); animation-delay:0.3s; }
    .quote-divider span:nth-child(3) { width:6px; height:6px; animation-delay:0.6s; }
    @keyframes dot-blink {
        0%, 100% { opacity: 0.4; transform: scale(1); }
        50%       { opacity: 1;   transform: scale(1.3); }
    }

    /* Main quote text */
    .quote-text-main {
        font-family: 'Kantumruy Pro', 'Battambang', sans-serif;
        font-size: 1.65rem;
        font-weight: 700;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 12px;
        text-shadow: 0 2px 20px rgba(0,0,0,0.4);
        letter-spacing: 0.01em;
        animation: text-fade-in 1s ease both;
    }
    @keyframes text-fade-in {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .quote-text-main .q-gold {
        background: linear-gradient(90deg, #fde68a 0%, #fbbf24 50%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        position: relative;
    }

    .quote-text-main .q-gold::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, #fde68a, #f59e0b);
        border-radius: 2px;
        opacity: 0.5;
    }

    /* English sub-translation */
    .quote-text-sub {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        color: rgba(255,255,255,0.45);
        font-style: italic;
        margin-bottom: 32px;
        letter-spacing: 0.03em;
    }

    /* Author badge */
    .quote-author-badge {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(212,175,55,0.25);
        backdrop-filter: blur(16px);
        padding: 10px 28px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .quote-author-badge:hover {
        background: rgba(255,255,255,0.12);
        border-color: rgba(212,175,55,0.5);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    .quote-author-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fbbf24, #d97706);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .quote-author-info {
        text-align: left;
    }
    .quote-author-name {
        display: block;
        color: #fef08a;
        font-size: 0.88rem;
        font-weight: 700;
        font-family: 'Battambang', sans-serif;
        line-height: 1.2;
    }
    .quote-author-role {
        display: block;
        color: rgba(255,255,255,0.45);
        font-size: 0.76rem;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.04em;
    }

    /* Stats row */
    .quote-stats-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 48px;
        margin-top: 40px;
        padding-top: 32px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .q-stat {
        text-align: center;
    }
    .q-stat-num {
        display: block;
        font-size: 2rem;
        font-weight: 800;
        color: #fbbf24;
        line-height: 1;
        font-family: 'Inter', sans-serif;
        animation: count-up 0.6s ease both;
    }
    .q-stat-label {
        display: block;
        font-size: 0.8rem;
        color: rgba(255,255,255,0.45);
        margin-top: 4px;
        font-family: 'Battambang', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .q-stat-divider {
        width: 1px;
        height: 40px;
        background: rgba(255,255,255,0.12);
    }

    @media (max-width: 768px) {
        .quote-card-wrapper { padding: 40px 28px; border-radius: 22px; }
        .quote-text-main { font-size: 1.25rem; }
        .quote-stats-row { gap: 24px; }
        .quote-deco-ring { display: none; }
    }
    @media (max-width: 480px) {
        .quote-card-wrapper { padding: 32px 20px; }
        .quote-stats-row { flex-direction: column; gap: 20px; }
        .q-stat-divider { width: 60px; height: 1px; }
</style>

<!-- PSB University Welcome Section (CTA Banner) -->
<section class="cta-banner-section fix">
    <div class="container">
        <div class="psbu-welcome-card wow fadeInUp" data-wow-delay=".2s">
            <div class="row align-items-center g-4">
                
                {{-- LEFT COLUMN: Photo Collage Grid --}}
                <div class="col-lg-4 col-md-5">
                    <div class="psbu-grid-collage">
                        <div class="collage-main-img">
                            <img src="{{ asset('frontend/assets/img/psbu-student.png') }}" alt="PSBU Students">
                        </div>
                        <div class="collage-sub-grid">
                            <div class="collage-sub-img">
                                <img src="{{ asset('frontend/assets/img/readingbook.jpg') }}" alt="Library Activity">
                            </div>
                            <div class="collage-sub-img">
                                <img src="{{ asset('frontend/assets/img/banner1.jpg') }}" alt="PSBU Campus">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MIDDLE COLUMN: Welcome Message & Signature Block --}}
                <div class="col-lg-5 col-md-7">
                    <div class="psbu-welcome-content">
                        <h2 class="psbu-title">Welcome to PSB University</h2>
                        <p class="psbu-text">
                            At Preah Sihamoniraja Buddhist University, our founder envisions a world where peace, understanding, and compassion are at the heart of society. Guided by the timeless teachings of the Buddha, we are committed to cultivating a humanist, tolerant, and harmonious mindset in the modern world. By weaving these principles into the fabric of higher education, we strive to foster solidarity and empathy within our communities and encourage respectful, friendly relations among all people.
                        </p>
                        
                        <div class="psbu-signature-block">
                            <span class="psbu-role">Rector</span>
                            <h4 class="psbu-univ-name">Preah Sihamoniraja Buddhist University.</h4>
                            <p class="psbu-rector-name">H.H. Samdech Preah Abhisiri Sugandha Mahasangharajah Dhipati BOUR KRY</p>
                            <p class="psbu-rector-title">Samdech Preah Mahasangharajah of Dhammayuttikanikaya of The Kingdom of Cambodia</p>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Rector Portrait Card --}}
                <div class="col-lg-3 col-md-12">
                    <div class="psbu-rector-portrait">
                        <div class="portrait-card">
                            <img src="{{ asset('frontend/assets/img/samdach.jpg') }}" alt="H.H. Samdech Preah Bour Kry">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Inspirational Quote Section -->
<section class="quote-banner-section fix">
    <div class="container">
        <div class="quote-card-wrapper wow fadeInUp" data-wow-delay=".2s">

            {{-- Animated mesh gradient overlay --}}
            <div class="quote-mesh-overlay"></div>

            {{-- Shimmer scan line --}}
            <div class="quote-shimmer-line"></div>

            {{-- Rotating decorative ring --}}
            <div class="quote-deco-ring"></div>

            {{-- Floating particles --}}
            <div class="quote-particles">
                <div class="q-particle"></div>
                <div class="q-particle"></div>
                <div class="q-particle"></div>
                <div class="q-particle"></div>
                <div class="q-particle"></div>
                <div class="q-particle"></div>
            </div>

            <div class="quote-content-inner">

                {{-- Icon with rotating halo --}}
                <div class="quote-icon-wrap">
                    <div class="quote-icon-halo"></div>
                    <div class="quote-icon-core">
                        <i class="fa-solid fa-quote-left"></i>
                    </div>
                </div>

                {{-- Animated dot divider --}}
                <div class="quote-divider">
                    <span></span><span></span><span></span>
                </div>

                {{-- Main Khmer quote --}}
                <h3 class="quote-text-main wow fadeInUp" data-wow-delay=".25s">
                    « ការអានសៀវភៅ គឺជា
                    <span class="q-gold">ការបើកទ្វារទៅកាន់ពិភពនៃចំណេះដឹង</span>
                    និងកសាងអនាគតឲ្យកាន់តែរុងរឿង »
                </h3>

                {{-- English subtitle --}}
                <p class="quote-text-sub wow fadeInUp" data-wow-delay=".35s">
                    "Reading opens the door to a world of knowledge and builds a brighter future."
                </p>

                {{-- Author badge --}}
                <div class="quote-author-badge wow fadeInUp" data-wow-delay=".45s">
                    <div class="quote-author-avatar">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div class="quote-author-info">
                        <span class="quote-author-name">ទស្សនវិជ្ជានៃការអាន</span>
                        <span class="quote-author-role">Digital Library · PSBU</span>
                    </div>
                </div>

                {{-- Stats row --}}
                <div class="quote-stats-row wow fadeInUp" data-wow-delay=".55s">
                    <div class="q-stat">
                        <span class="q-stat-num">500+</span>
                        <span class="q-stat-label">សៀវភៅ</span>
                    </div>
                    <div class="q-stat-divider"></div>
                    <div class="q-stat">
                        <span class="q-stat-num">1K+</span>
                        <span class="q-stat-label">អ្នកអាន</span>
                    </div>
                    <div class="q-stat-divider"></div>
                    <div class="q-stat">
                        <span class="q-stat-num">50+</span>
                        <span class="q-stat-label">ប្រភេទ</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Top Rating Book Section -->
<section class="top-ratting-book-section fix">
    <div class="container">
        <div class="top-ratting-header">
            <div class="top-ratting-title-group wow fadeInUp" data-wow-delay=".2s">
                <span class="sub-badge"><i class="fa-solid fa-fire"></i> {{ __('Popular Books') }}</span>
                <h2>{{ __('Popular Books') }}</h2>
            </div>
            <a href="{{ front_url('books') }}" class="top-ratting-view-all wow fadeInUp" data-wow-delay=".3s">
                <span>{{ __('View More Books') }}</span>
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
        <div class="row">
            @foreach($popularBooks as $book)
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="top-ratting-card">
                    <div class="top-ratting-thumb">
                        <a href="{{ front_url('book_details/'. $book->slug) }}">
                            <img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png') }}" alt="{{ $book->title }}" loading="lazy" decoding="async">
                        </a>
                    </div>
                    <div class="top-ratting-content">
                        <div>
                            <div class="top-ratting-meta">
                                <div class="top-ratting-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span>5.0</span>
                                </div>
                                <span class="top-ratting-badge">{{ __('Top Rated') }}</span>
                            </div>
                            <h3 class="top-ratting-title">
                                <a href="{{ front_url('book_details/'. $book->slug) }}">{{ $book->title }}</a>
                            </h3>
                        </div>
                        <div class="top-ratting-footer">
                            <a href="{{ front_url('book_details/'. $book->slug) }}" class="top-ratting-btn">
                                <span>{{ __('View Details') }}</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <a href="{{ front_url('book_details/'. $book->slug) }}" class="top-ratting-view-icon" title="{{ __('View Details') }}">
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="shop-section section-padding fix">
    <div class="container">
        <div class="section-title-area">
            <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                <h2>{{ __('Top Selling Books') }}</h2>
            </div>
            <a href="{{ front_url('books') }}" class="theme-btn transparent-btn wow fadeInUp" data-wow-delay=".5s">{{ __('Explore More') }} <i
                    class="fa-solid fa-arrow-right-long"></i></a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                @foreach($popularBooks as $book)
                <div class="swiper-slide">
                    <div class="shop-box-items style-2">
                        <div class="book-thumb center">
                            <a href="{{front_url('book_details/'. $book->slug)}}"><img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png') }}" alt="{{ $book->title }}" loading="lazy" decoding="async"></a>
                            
                            <ul class="shop-icon d-grid justify-content-center align-items-center">
                               
                                <li>
                                    <a href="{{ front_url('book_details/'. $book->slug) }}"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-content">
                           
                            <h3 class="battambang-regular"><a href="{{ front_url('book_details/'. $book->slug) }}">{{ $book->title; }}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



<!-- News Section start  -->
<!-- <section class="news-section fix section-padding section-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">{{ __('Our Latest News') }}</h2>
            <p class="wow fadeInUp" data-wow-delay=".5s">Interdum et malesuada fames ac ante ipsum primis in
                faucibus. <br> Donec at nulla nulla. Duis posuere ex lacus</p>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="news-card-items">
                    <div class="news-image">
                        <img src="{{asset('frontend/assets/img/news/09.jpg')}}" alt="img">
                        <img src="{{asset('frontend/assets/img/news/09.jpg')}}" alt="img">
                        <div class="post-box">
                            Activities
                        </div>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li>
                                <i class="fa-light fa-calendar-days"></i>
                                Feb 10, 2024
                            </li>
                            <li>
                                <i class="fa-regular fa-user"></i>
                                By Admin
                            </li>
                        </ul>
                        <h3><a href="news-details.html">Montes suspendisse massa curae malesuada</a></h3>
                        <a href="news-details.html" class="theme-btn-2">Read More <i
                                class="fa-regular fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="news-card-items">
                    <div class="news-image">
                        <img src="{{asset('frontend/assets/img/news/10.jpg')}}" alt="img">
                        <img src="{{asset('frontend/assets/img/news/10.jpg')}}" alt="img">
                        <div class="post-box">
                            Activities
                        </div>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li>
                                <i class="fa-light fa-calendar-days"></i>
                                Mar 20, 2024
                            </li>
                            <li>
                                <i class="fa-regular fa-user"></i>
                                By Admin
                            </li>
                        </ul>
                        <h3><a href="news-details.html">Playful Picks Paradise: Kids’ Essentials with Dash.</a></h3>
                        <a href="news-details.html" class="theme-btn-2">Read More <i
                                class="fa-regular fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="news-card-items">
                    <div class="news-image">
                        <img src="{{asset('frontend/assets/img/news/11.jpg')}}" alt="img">
                        <img src="{{asset('frontend/assets/img/news/11.jpg')}}" alt="img">
                        <div class="post-box">
                            Activities
                        </div>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li>
                                <i class="fa-light fa-calendar-days"></i>
                                Jun 14, 2024
                            </li>
                            <li>
                                <i class="fa-regular fa-user"></i>
                                By Admin
                            </li>
                        </ul>
                        <h3><a href="news-details.html">Tiny Emporium: Playful Picks for Kids’ Delightful Days.</a>
                        </h3>
                        <a href="news-details.html" class="theme-btn-2">Read More <i
                                class="fa-regular fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                <div class="news-card-items">
                    <div class="news-image">
                        <img src="{{asset('frontend/assets/img/news/12.jpg')}}" alt="img">
                        <img src="{{asset('frontend/assets/img/news/12.jpg')}}" alt="img">
                        <div class="post-box">
                            Activities
                        </div>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li>
                                <i class="fa-light fa-calendar-days"></i>
                                Mar 12, 2024
                            </li>
                            <li>
                                <i class="fa-regular fa-user"></i>
                                By Admin
                            </li>
                        </ul>
                        <h3><a href="news-details.html">Eu parturient dictumst fames quam tempor</a></h3>
                        <a href="news-details.html" class="theme-btn-2">Read More <i
                                class="fa-regular fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection
