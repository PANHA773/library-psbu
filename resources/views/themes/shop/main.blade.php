<!DOCTYPE html>
<html lang="{{ request()->cookie('language', 'kh') === 'us' ? 'en' : 'km' }}">
<!--<< Header Area >>-->

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="gramentheme">
    <meta name="description" content="Bookle - Book Store WooCommerce Html Template ">
    <!-- ======== Page title ============ -->
    <title>{{shop_settings()->shop_name}}</title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="{{asset('uploads/settings/'. shop_settings()->logo)}}">
    <!-- Khmer Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&family=Moul&family=Siemreap&display=swap" rel="stylesheet">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/all.min.css')}}">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/meanmenu.css')}}">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper-bundle.min.css')}}">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
    <!--<< Icomoon.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/flag-icon-css/css/flag-icon.min.css')}}">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
    <style>
        /* ── Khmer Font Base ── */
        body, p, span, a, li, td, th, input, button, select, textarea {
            font-family: 'Battambang', 'Siemreap', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Battambang', 'Moul', sans-serif;
        }
        .moul-regular, .moul-beauty {
            font-family: 'Moul', serif !important;
        }
        .battambang-regular {
            font-family: 'Battambang', sans-serif !important;
        }

        /* ── Navbar Khmer Style ── */
        .header-1 .main-menu nav ul li a {
            font-family: 'Battambang', sans-serif !important;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0;
            color: #1a202c;
            transition: color .2s;
        }
        .header-1 .main-menu nav ul li a:hover,
        .header-1 .main-menu nav ul li.active > a {
            color: #FF6500 !important;
        }
        /* Active underline */
        .header-1 .main-menu nav ul li.active > a::after {
            content: '';
            display: block;
            height: 2px;
            background: #FF6500;
            border-radius: 2px;
            margin-top: 3px;
        }

        /* ── Top bar Khmer ── */
        .header-top-1 .contact-list li,
        .header-top-1 .contact-list li a {
            font-family: 'Battambang', sans-serif;
            font-size: .88rem;
        }
        .header-top-1 .contact-list li.language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .header-top-1 .lang-flag-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 24px;
            border-radius: 999px;
            border: 1px solid rgba(26, 32, 44, 0.12);
            background: #fff;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
            text-decoration: none;
        }
        .header-top-1 .lang-flag-link:hover {
            transform: translateY(-1px);
            border-color: rgba(255, 101, 0, 0.45);
            box-shadow: 0 8px 18px rgba(16, 24, 40, 0.10);
        }
        .header-top-1 .lang-flag-link.active {
            border-color: #FF6500;
            box-shadow: 0 8px 18px rgba(255, 101, 0, 0.18);
        }
        .header-top-1 .lang-flag-link .flag-icon {
            border-radius: 50%;
            width: 18px;
            height: 18px;
            background-size: cover;
        }

        /* ── Footer Khmer ── */
        .footer-section h3,
        .footer-section .widget-head h3 {
            font-family: 'Battambang', sans-serif;
            font-weight: 700;
        }
        .footer-section .list-area li a,
        .footer-section p {
            font-family: 'Battambang', sans-serif;
            font-size: .92rem;
        }
        .footer-bottom p {
            font-family: 'Battambang', sans-serif;
        }

        /* ── Offcanvas Khmer ── */
        .offcanvas__info h4,
        .offcanvas__info a,
        .offcanvas__info p {
            font-family: 'Battambang', sans-serif;
        }

        /* ── Section Titles ── */
        .section-title h2,
        .section-title-area .section-title h2 {
            font-family: 'Battambang', 'Moul', sans-serif;
            font-weight: 700;
        }

        /* ── Book titles ── */
        .shop-content h3,
        .book-content h3,
        .top-ratting-box-items .book-content h3 {
            font-family: 'Battambang', sans-serif;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader start -->
    <div id="preloader" class="preloader moul-regular">
        <div class="animation-preloader">
            <div class="spinner">
            </div>
            <div class="txt-loading">
                <span data-text-preloader="បណ្ណា" class="letters-loading moul-regular">
                    បណ្ណា
                </span>
                <span data-text-preloader="ល័យ" class="letters-loading moul-regular">
                    ល័យ
                </span>
                <span data-text-preloader="តេជោ" class="letters-loading moul-regular">
                    តេជោ
                </span>
                <span data-text-preloader="សន្តិ" class="letters-loading moul-regular">
                    សន្តិ
                </span>
                {{-- <span data-text-preloader="L" class="letters-loading">
                    
                </span> --}}
                <span data-text-preloader="ភាព" class="letters-loading moul-regular">
                    ភាព
                </span>
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back To Top start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Offcanvas Area start  -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="{{front_url('')}}">
                                <img src="{{asset('uploads/settings/'. shop_settings()->logo)}}" alt="logo-img">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text d-none d-xl-block">
                        បណ្ណាល័យតេជោសន្តិភាព — ផ្តល់ចំណេះដឹង ជំរុញការអភិវឌ្ឍ ដល់សិស្សានុសិស្ស។
                    </p>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>ព័ត៌មានទំនាក់ទំនង</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="{{front_url('')}}">{{shop_settings()->address}}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:{{shop_settings()->email}}">{{shop_settings()->email}}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="{{front_url('')}}">ច័ន្ទ-សុក្រ, ម៉ោង ៧:០០ - ១៧:០០</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:{{shop_settings()->phone}}">{{shop_settings()->phone}}</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4">
                            <a href="{{front_url('contact')}}" class="theme-btn text-center">
                                ទំនាក់ទំនងយើង <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="social-icon d-flex align-items-center">
                            @if(shop_settings()->facebook)
                            <a href="{{shop_settings()->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            @endif

                            @if(shop_settings()->twitter)
                            <a href="https://x.com/"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if(shop_settings()->youtube)
                            <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if(shop_settings()->linkedin)
                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <div class="header-top-1">
        <div class="container">
            <div class="header-top-wrapper">
                <ul class="contact-list">
                    <li>
                        <i class="fa-regular fa-phone"></i>
                        <a href="tel:{{shop_settings()->phone}}">{{shop_settings()->phone}}</a>
                    </li>
                    <li>
                        <i class="far fa-envelope"></i>
                        <a href="mailto:{{shop_settings()->email}}">{{shop_settings()->email}}</a>
                    </li>
                    @php
                        $currentLanguage = request()->cookie('language', 'kh');
                    @endphp
                    <li class="language-switcher">
                        <a class="lang-flag-link {{ $currentLanguage === 'kh' ? 'active' : '' }}" href="{{ url('/localization/km') }}" title="Khmer" aria-label="Switch to Khmer">
                            <span class="flag-icon flag-icon-kh"></span>
                        </a>
                        <a class="lang-flag-link {{ $currentLanguage === 'us' ? 'active' : '' }}" href="{{ url('/localization/en') }}" title="English" aria-label="Switch to English">
                            <span class="flag-icon flag-icon-us"></span>
                        </a>
                    </li>
                    @if(shop_settings()->workday)
                    <li>
                        <i class="far fa-clock"></i>
                        <span>{{shop_settings()->workday}}</span>
                    </li>
                    @endif
                </ul>
                <!-- <ul class="list">
                    <li><i class="fa-light fa-comments"></i><a href="{{front_url('contact')}}">Live Chat</a></li>
                    <li><i class="fa-light fa-user"></i>
                        <button data-bs-toggle="modal" data-bs-target="#loginModal">
                            Login
                        </button>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>

    <!-- Sticky Header Section start  -->
    <header class="header-1 sticky-header">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-10 col-xl-8 col-xxl-10">
                            <div class="header-left">
                                <div class="logo">
                                    <a href="{{front_url('')}}" class="header-logo">
                                        <img src="{{asset('uploads/settings/'. shop_settings()->logo)}}" alt="logo-img" class="img-fluid" style="width: 11rem">
                                    </a>
                                </div>
                                <div class="mean__menu-wrapper">
                                    <div class="main-menu">
                                        <nav>
                                            <ul>
                                                <li class="{{ request()->is('/') || request()->is('') ? 'active' : '' }}">
                                                    <a href="{{ front_url('')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-home" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>ទំព័រដើម</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('books*') ? 'active' : '' }}">
                                                    <a href="{{front_url('books')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-book" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>សៀវភៅ</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('about*') ? 'active' : '' }}">
                                                    <a href="{{front_url('about')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-info-circle" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>អំពីយើង</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('contact*') ? 'active' : '' }}">
                                                    <a href="{{front_url('contact')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-envelope" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>ទំនាក់ទំនង</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-2 col-xl-4 col-xxl-2">
                            <div class="header-right">
                                {{-- <div class="category-oneadjust gap-6 d-flex align-items-center">
                                    <div class="icon">
                                        <i class="fa-sharp fa-solid fa-grid-2"></i>
                                    </div>
                                    <select name="cate" class="category">
                                        <option value="1">
                                            Category
                                        </option>
                                        <option value="1">
                                            Web Design
                                        </option>
                                        <option value="1">
                                            Web Development
                                        </option>
                                        <option value="1">
                                            Graphic Design
                                        </option>
                                        <option value="1">
                                            Softwer Eng
                                        </option>
                                    </select>
                                    <form action="#" class="search-toggle-box d-md-block">
                                        <div class="input-area">
                                            <input type="text" placeholder="Author">
                                            <button class="cmn-btn">
                                                <i class="far fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="menu-cart">
                                    {{-- <a href="wishlist.html" class="cart-icon">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                    <a href="shop-cart.html" class="cart-icon">
                                        <i class="fa-regular fa-cart-shopping"></i>
                                    </a> --}}
                                    <div class="header-humbager ml-30">
                                        <a class="sidebar__toggle" href="javascript:void(0)">
                                            <div class="bar-icon-2">
                                                <img src="{{asset('frontend/assets/img/icon/icon-13.svg')}}" alt="img">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Header Section start  -->
    <header class="header-1">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-10 col-xl-8 col-xxl-10">
                            <div class="header-left">
                                <div class="logo">
                                    <a href="{{ front_url('') }}" class="header-logo">
                                        <img src="{{asset('uploads/settings/'. shop_settings()->logo)}}" alt="logo-img" class="img-fluid" style="width: 11rem">
                                    </a>
                                </div>
                                <div class="mean__menu-wrapper">
                                    <div class="main-menu">
                                        <nav id="mobile-menu">
                                            <ul>
                                                <li class="{{ request()->is('/') || request()->is('') ? 'active' : '' }}">
                                                    <a href="{{front_url('')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-home" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>ទំព័រដើម</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('books*') ? 'active' : '' }}">
                                                    <a href="{{front_url('books')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-book" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>សៀវភៅ</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('about*') ? 'active' : '' }}">
                                                    <a href="{{front_url('about')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-info-circle" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>អំពីយើង</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('contact*') ? 'active' : '' }}">
                                                    <a href="{{front_url('contact')}}" style="display:inline-flex;align-items:center;gap:8px;">
                                                        <i class="fas fa-envelope" style="font-size:20px;width:20px;min-width:20px;text-align:center;"></i><span>ទំនាក់ទំនង</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-2 col-xl-4 col-xxl-2">
                            <div class="header-right">
                                {{-- <div class="category-oneadjust gap-6 d-flex align-items-center">
                                    <div class="icon">
                                        <i class="fa-sharp fa-solid fa-grid-2"></i>
                                    </div>
                                    <select name="cate" class="category">
                                        <option value="1">
                                            Category
                                        </option>
                                        <option value="1">
                                            Web Design
                                        </option>
                                        <option value="1">
                                            Web Development
                                        </option>
                                        <option value="1">
                                            Graphic Design
                                        </option>
                                        <option value="1">
                                            Softwer Eng
                                        </option>
                                    </select>
                                    <form action="#" class="search-toggle-box d-md-block">
                                        <div class="input-area">
                                            <input type="text" placeholder="Author">
                                            <button class="cmn-btn">
                                                <i class="far fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="menu-cart">
                                    {{-- <a href="wishlist.html" class="cart-icon">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                    <a href="shop-cart.html" class="cart-icon">
                                        <i class="fa-regular fa-cart-shopping"></i>
                                    </a> --}}
                                    <div class="header-humbager ml-30">
                                        <a class="sidebar__toggle" href="javascript:void(0)">
                                            <div class="bar-icon-2">
                                                <img src="{{asset('frontend/assets/img/icon/icon-13.svg')}}" alt="img">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </header>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="close-btn">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="identityBox">
                        <div class="form-wrapper">
                            <h1 id="loginModalLabel">welcome back!</h1>
                            <input class="inputField" type="email" name="email" placeholder="Email Address">
                            <input class="inputField" type="password" name="password" placeholder="Enter Password">
                            <div class="input-check remember-me">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" class="form-check-input" name="save-for-next"
                                        id="saveForNext">
                                    <label for="saveForNext">Remember me</label>
                                </div>
                                <div class="text"> <a href="index-2.html">Forgot Your password?</a> </div>
                            </div>
                            <div class="loginBtn">
                                <a href="index-2.html" class="theme-btn rounded-0"> Log in </a>
                            </div>
                            <div class="orting-badge">
                                Or
                            </div>
                            <div>
                                <a class="another-option" href="https://www.google.com/">
                                    <img src="{{asset('frontend/assets/img/google.png')}}" alt="google">
                                    Continue With Google
                                </a>
                            </div>
                            <div>
                                <a class="another-option another-option-two" href="https://www.facebook.com/">
                                    <img src="{{asset('frontend/assets/img/facebook.png')}}" alt="google">
                                    Continue With Facebook
                                </a>
                            </div>

                            <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                <input class="form-check-input" type="radio" name="flexRadioDefault">
                                <label class="form-check-label">
                                    I Accept Your Terms & Conditions
                                </label>
                            </div>
                        </div>

                        <div class="banner">
                            <button type="button" class="rounded-0 login-btn" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Log in</button>
                            <button type="button" class="theme-btn rounded-0 register-btn" data-bs-toggle="modal"
                                data-bs-target="#registrationModal">Create
                                Account</button>
                            <div class="loginBg">
                                <img src="{{asset('frontend/assets/img/signUpbg.jpg')}}" alt="signUpBg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="close-btn">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="identityBox">
                        <div class="form-wrapper">
                            <h1 id="registrationModalLabel">Create account!</h1>
                            <input class="inputField" type="text" name="name" id="name" placeholder="User Name">
                            <input class="inputField" type="email" name="email" placeholder="Email Address">
                            <input class="inputField" type="password" name="password" placeholder="Enter Password">
                            <input class="inputField" type="password" name="password"
                                placeholder="Enter Confirm Password">
                            <div class="input-check remember-me">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" class="form-check-input" name="save-for-next"
                                        id="rememberMe">
                                    <label for="rememberMe">Remember me</label>
                                </div>
                                <div class="text"> <a href="index-2.html">Forgot Your password?</a> </div>
                            </div>
                            <div class="loginBtn">
                                <a href="index-2.html" class="theme-btn rounded-0"> Log in </a>
                            </div>
                            <div class="orting-badge">
                                Or
                            </div>
                            <div>
                                <a class="another-option" href="https://www.google.com/">
                                    <img src="{{asset('frontend/assets/img/google.png')}}" alt="google">
                                    Continue With Google
                                </a>
                            </div>
                            <div>
                                <a class="another-option another-option-two" href="https://www.facebook.com/">
                                    <img src="{{asset('frontend/assets/img/facebook.png')}}" alt="google">
                                    Continue With Facebook
                                </a>
                            </div>
                            <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                <input class="form-check-input" type="radio" name="flexRadioDefault">
                                <label class="form-check-label">
                                    I Accept Your Terms & Conditions
                                </label>
                            </div>
                        </div>

                        <div class="banner">
                            <button type="button" class="rounded-0 login-btn" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Log in</button>
                            <button type="button" class="theme-btn rounded-0 register-btn" data-bs-toggle="modal"
                                data-bs-target="#registrationModal">Create
                                Account</button>
                            <div class="signUpBg">
                                <img src="{{asset('frontend/assets/img/registrationbg.jpg')}}" alt="signUpBg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')


    <!-- Footer Section start  -->
    <footer class="footer-section footer-bg">
        <div class="container">
            <div class="contact-info-area" style="gap:18px;">
                <div class="contact-info-items wow fadeInUp" data-wow-delay=".2s" style="padding:22px 24px;border-radius:22px;background:linear-gradient(135deg,#0f3b5e 0%,#0b2b47 100%);border:1px solid rgba(255,255,255,.10);box-shadow:0 20px 40px rgba(0,0,0,.20);">
                    <div class="icon">
                        <i class="icon-icon-5"></i>
                    </div>
                    <div class="content">
                        <p style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:4px;opacity:.85;">Call Us 7/24</p>
                        <h3 style="font-size:18px;line-height:1.45;margin-bottom:0;">
                            <a href="tel:{{shop_settings()->phone}}">{{shop_settings()->phone}}</a>
                        </h3>
                    </div>
                </div>
                <div class="contact-info-items wow fadeInUp" data-wow-delay=".4s" style="padding:22px 24px;border-radius:22px;background:linear-gradient(135deg,#0f3b5e 0%,#0b2b47 100%);border:1px solid rgba(255,255,255,.10);box-shadow:0 20px 40px rgba(0,0,0,.20);">
                    <div class="icon">
                        <i class="icon-icon-6"></i>
                    </div>
                    <div class="content">
                        <p style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:4px;opacity:.85;">Make a Quote</p>
                        <h3 style="font-size:18px;line-height:1.45;margin-bottom:0;">
                            <a href="mailto:{{shop_settings()->email}}">{{shop_settings()->email}}</a>
                        </h3>
                    </div>
                </div>
                <div class="contact-info-items wow fadeInUp" data-wow-delay=".6s" style="padding:22px 24px;border-radius:22px;background:linear-gradient(135deg,#0f3b5e 0%,#0b2b47 100%);border:1px solid rgba(255,255,255,.10);box-shadow:0 20px 40px rgba(0,0,0,.20);">
                    <div class="icon">
                        <i class="icon-icon-7"></i>
                    </div>
                    <div class="content">
                        <p style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:4px;opacity:.85;">Opening Hour</p>
                        <h3 style="font-size:18px;line-height:1.45;margin-bottom:0;">
                            {{shop_settings()->workday}}
                        </h3>
                    </div>
                </div>
                <div class="contact-info-items wow fadeInUp" data-wow-delay=".8s" style="padding:22px 24px;border-radius:22px;background:linear-gradient(135deg,#0f3b5e 0%,#0b2b47 100%);border:1px solid rgba(255,255,255,.10);box-shadow:0 20px 40px rgba(0,0,0,.20);">
                    <div class="icon">
                        <i class="icon-icon-8"></i>
                    </div>
                    <div class="content">
                        <p style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:4px;opacity:.85;">Location</p>
                        <h3 style="font-size:18px;line-height:1.45;margin-bottom:0;">
                            {{shop_settings()->address}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widgets-wrapper">
            <div class="plane-shape float-bob-y">
                <img src="{{asset('frontend/assets/img/plane-shape.png')}}" alt="img">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <a href="{{ front_url(''); }}">
                                    <img src="{{asset('uploads/settings/'. shop_settings()->logo)}}" alt="logo-img" class="img-fluid" style="50px">
                                </a>
                            </div>
                            <div class="footer-content">
                                <p>
                                    {{shop_settings()->follow_text}}
                                </p>
                                <div class="social-icon d-flex align-items-center">
                                    @if(shop_settings()->facebook)
                                    <a href="{{ shop_settings()->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if(shop_settings()->twitter)
                                    <a href="{{ shop_settings()->twitter }}"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if(shop_settings()->youtube)
                                    <a href="{{shop_settings()->youtube}}"><i class="fab fa-youtube"></i></a>
                                    @endif
                                    @if(shop_settings()->linkedin)
                                    <a href="{{shop_settings()->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-footer-widget">
                             <div class="widget-head">
                                <h3>ផ្នែក</h3>
                            </div>
                            <ul class="list-area">
                                <li>
                                    <a href="{{front_url('books');}}">
                                        <i class="fa-solid fa-chevrons-right"></i>
                                        បញ្ជីសៀវភៅ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ front_url('about'); }}">
                                        <i class="fa-solid fa-chevrons-right"></i>
                                        អំពីយើង
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ front_url('contact')}}">
                                        <i class="fa-solid fa-chevrons-right"></i>
                                        ទំនាក់ទំនងយើង
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>ប្រភេទសៀវភៅ</h3>
                            </div>
                            <ul class="list-area">
                                @foreach($foot_categories as $category)
                                <li>
                                    <a href="{{ front_url('books/'. $category->id); }}">
                                        <i class="fa-solid fa-chevrons-right"></i>
                                        {{$category->name;}}
                                    </a>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>ព័ត៌មានថ្មី</h3>
                            </div>
                            <div class="footer-content">
                                <p>ចុះឈ្មោះដើម្បីទទួលបានព័ត៌មានថ្មីៗ និងសកម្មភាពបណ្ណាល័យ។</p>
                                <div class="footer-input">
                                    <input type="email" id="email2" placeholder="បញ្ចូលអ៊ីម៉ែលរបស់អ្នក">
                                    <button class="newsletter-btn" type="submit">
                                        <i class="fa-regular fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-wrapper d-flex align-items-center justify-content-between">
                    <p class="wow fadeInLeft" data-wow-delay=".3s">
                        © រក្សាសិទ្ធគ្រប់យ៉ាង <?= DATE("Y"); ?> ដោយ <a href="#">{{shop_settings()->shop_name;}}</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!--<< All JS Plugins >>-->
    <script src="{{asset('frontend/assets/js/jquery-3.7.1.min.js')}}"></script>
    <!--<< Viewport Js >>-->
    <script src="{{asset('frontend/assets/js/viewport.jquery.js')}}"></script>
    <!--<< Bootstrap Js >>-->
    <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--<< Nice Select Js >>-->
    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <!--<< Waypoints Js >>-->
    <script src="{{asset('frontend/assets/js/jquery.waypoints.js')}}"></script>
    <!--<< Counterup Js >>-->
    <script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="{{asset('frontend/assets/js/swiper-bundle.min.js')}}"></script>
    <!--<< MeanMenu Js >>-->
    <script src="{{asset('frontend/assets/js/jquery.meanmenu.min.js')}}"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!--<< Wow Animation Js >>-->
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <!-- Gsap -->
    <script src="{{asset('frontend/assets/js/gsap.min.js')}}"></script>
    <!--<< Main.js >>-->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>

    <script src="{{ asset('frontend/assets/jquery/products.js') }}"></script>
</body>

</html>
