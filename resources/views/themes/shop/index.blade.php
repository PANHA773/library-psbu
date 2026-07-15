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
        /* background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 40%, rgba(0,0,0,0.2) 100%); */
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
        .slider-content-left h1 { font-size: 4rem; }
    }
    @media (max-width: 991px) {
        .slider-content-left { width: 90%; top: 25%; text-align: center; left: 5%; }
        .slider-content-left h1 { font-size: 3.5rem; }
        .slider-content-left .subtitle::before { display: none; }
        .slider-content-left .subtitle { padding-left: 0; }
        .slider-content-left .btn-wrap { justify-content: center; }
        .slider-content-left p { margin: 0 auto 30px; }
        .slider-bottom-bar { display: none; } /* Hide on mobile to save space */
    }
    @media (max-width: 767px) {
        .slider-content-left h1 { font-size: 2.5rem; margin-bottom: 15px; }
    }
</style>

<div class="travel-slider-wrap">
    <!-- Main Background Swiper -->
    <div class="swiper bg-swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide" style="background-image: url('{{asset('frontend/assets/img/caruOne.png')}}');">
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
                <div class="slider-content-left">
                    <!-- <div class="subtitle animate-elem">New Arrivals - 2026</div> -->
                    <!-- <h1 class="animate-elem">សៀវភៅ<br>ថ្មីៗបំផុត</h1> -->
                    <!-- <p class="animate-elem">ស្វែងរកសៀវភៅ និងឯកសារស្រាវជ្រាវជាច្រើនដែលទើបតែបន្ថែមថ្មីៗ។ មានសៀវភៅល្អៗរាប់ពាន់ក្បាលរង់ចាំអ្នក។</p> -->
                    <div class="btn-wrap animate-elem" style="display: flex; align-items: center;">
                        <!-- <span class="btn-icon-custom"><i class="fa fa-book"></i></span> -->
                        <!-- <a href="{{ front_url('books') }}" class="btn-discover">VIEW COLLECTION</a> -->
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide" style="background-image: url('{{asset('frontend/assets/img/caruselTree.png')}}'); background-color: #2b2b2b; background-size: cover; background-position: top center;">
                <div class="slider-content-left">
                    <!-- <div class="subtitle animate-elem">Student Area - PSBU</div> -->
                    <!-- <h1 class="animate-elem">ទីកន្លែង<br>សិក្សាស្រាវជ្រាវ</h1>  -->
                    <!-- <p class="animate-elem">បណ្ណាល័យផ្តល់ជូនកន្លែងអង្គុយអានយ៉ាងមានផាសុកភាព ស្ងប់ស្ងាត់ និងមានអ៊ីនធឺណិតល្បឿនលឿន។</p> -->
                    <div class="btn-wrap animate-elem" style="display: flex; align-items: center;"> -->
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
                <h2 class="wow fadeInUp" data-wow-delay=".3s">Featured Books</h2>
            </div>
            <a href="{{front_url('books')}}" class="theme-btn transparent-btn wow fadeInUp" data-wow-delay=".5s">Explore More <i
                    class="fa-solid fa-arrow-right-long"></i></a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                @foreach($books as $book)
                <div class="swiper-slide">
                    <div class="shop-box-items style-2">
                        <div class="book-thumb center">
                            <a href="{{ front_url('book_details/'. $book->slug); }}"><img src="{{$book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png')}}" alt="img"></a>
                            
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
                <h2 class="wow fadeInUp" data-wow-delay=".3s">Categories Book</h2>
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
                                <img src="{{$category->image ? asset('uploads/category/'. $category->image) : asset('uploads/category/no_image.png')}}" alt="img" class="img-fluid" style="">
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
<style>
    .custom-cta-wrapper {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 450px;
        padding: 40px;
    }
    .custom-cta-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(255, 101, 0, 0.4) 100%);
        z-index: 1;
    }
    .custom-cta-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .custom-cta-wrapper:hover .custom-cta-bg {
        transform: scale(1.05);
    }
    .custom-cta-content {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 50px 60px;
        border-radius: 24px;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }
    .custom-cta-title {
        color: #ffffff !important;
        font-size: 2.8rem;
        text-shadow: 2px 4px 8px rgba(0,0,0,0.3);
        margin-bottom: 35px;
        line-height: 1.4;
    }
    .custom-cta-btn {
        background: linear-gradient(90deg, #FF6500, #ff9d00);
        border: none;
        color: #fff;
        padding: 16px 45px;
        font-size: 1.1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        box-shadow: 0 10px 20px rgba(255, 101, 0, 0.4);
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    .custom-cta-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(255, 101, 0, 0.6);
        color: #fff;
    }
    .custom-cta-btn i {
        margin-left: 12px;
        transition: transform 0.3s ease;
    }
    .custom-cta-btn:hover i {
        transform: translateX(6px);
    }
    .custom-girl-shape {
        position: absolute;
        bottom: 0;
        right: 5%;
        z-index: 2;
        height: 110%;
        max-height: 550px;
        pointer-events: none;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
    }
    @media (max-width: 992px) {
        .custom-girl-shape {
            opacity: 0.5;
            right: -10%;
        }
    }
    @media (max-width: 768px) {
        .custom-girl-shape {
            display: none;
        }
        .custom-cta-content {
            padding: 35px 25px;
        }
        .custom-cta-title {
            font-size: 2rem;
        }
        .custom-cta-wrapper {
            min-height: 350px;
        }
    }

    .top-ratting-book-section .top-ratting-box-items {
        border-radius: 22px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(12, 32, 57, 0.08);
        box-shadow: 0 5px 5px rgba(12, 32, 57, 0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .top-ratting-book-section .top-ratting-box-items:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(12, 32, 57, 0.14);
    }

    .top-ratting-book-section .top-ratting-box-items .book-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .top-ratting-book-section .top-ratting-box-items .book-content {
        padding: 14px 16px 16px;
    }

    .top-ratting-book-section .top-ratting-box-items .book-content h3 {
        font-size: 15px;
        line-height: 1.45;
        margin: 0;
    }

    .top-ratting-book-section .top-ratting-box-items .shop-icon {
        opacity: 0;
        transform: translateY(6px);
        transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .top-ratting-book-section .top-ratting-box-items:hover .shop-icon {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<section class="cta-banner-section fix section-padding pt-12 pb-12">
    <div class="container">
        <div class="custom-cta-wrapper wow fadeInUp" data-wow-delay=".2s">
            <div class="custom-cta-bg" style="background-image: url('{{asset('frontend/assets/img/banner1.jpg')}}');"></div>
            
            <!-- <div class="custom-girl-shape float-bob-x">
                <img src="{{asset('frontend/assets/img/student.png')}}" alt="Student Reading" style="height: 100%; object-fit: contain;">
            </div> -->
            
            <div class="custom-cta-content text-center">
                <h2 class="wow fadeInUp moul-beauty custom-cta-title" data-wow-delay=".4s">
                    សកម្មភាពនិស្សិតកំពុងអានសៀវភៅ
                </h2>
                <a href="{{ front_url('books') }}" class="custom-cta-btn wow fadeInUp" data-wow-delay=".10s">
                    Books more <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Top Ratting Book Section start  -->
<section class="top-ratting-book-section fix section-padding section-bg">
    <div class="container">
        <div class="top-ratting-book-wrapper">
            <div class="section-title-area">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">សៀវភៅពេញនិយម</h2>
                </div>
                <a href="{{ front_url('books'); }}" class="theme-btn transparent-btn wow fadeInUp" data-wow-delay=".5s">មើលសៀវភៅច្រើនទៀត <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="row">
                @foreach($books as $book)
                <div class="col-xl-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="top-ratting-box-items">
                        <div class="book-thumb">
                            <a href="{{ front_url('book_details/'. $book->slug) }}">
                                <img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png') }}" alt="img">
                            </a>
                        </div>
                        <div class="book-content">
                            <div class="title-header">
                                <div>
                                    <h3>
                                        <a href="{{ front_url('book_details/'. $book->slug); }}">{{ $book->title; }}</a>
                                    </h3>
                                </div>
                                <ul class="shop-icon d-flex justify-content-center align-items-center">
                                    <li>
                                        <a href="{{ front_url('book_details/'. $book->slug) }}"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</section>

<!-- Shop Section start  -->
<section class="shop-section section-padding fix">
    <div class="container">
        <div class="section-title-area">
            <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                <h2>Top Selling Books</h2>
            </div>
            <a href="{{ front_url('books') }}" class="theme-btn transparent-btn wow fadeInUp" data-wow-delay=".5s">Explore More <i
                    class="fa-solid fa-arrow-right-long"></i></a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                @foreach($books as $book)
                <div class="swiper-slide">
                    <div class="shop-box-items style-2">
                        <div class="book-thumb center">
                            <a href="{{front_url('book_details/'. $book->slug)}}"><img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png') }}" alt="img"></a>
                            
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
            <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">Our Latest News</h2>
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
