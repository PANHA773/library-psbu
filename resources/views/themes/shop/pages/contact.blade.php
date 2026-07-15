@extends(front_layout('main'))
@section('content')

<!-- Breadcumb Section Start -->
<div class="breadcrumb-wrapper">
    <div class="book1">
        <img src="{{asset('frontend/assets/img/readingbook.jpg')}}" alt="book" class="img-fluid" style="width: 300px">
    </div>
    <div class="book2">
        <img src="{{asset('frontend/assets/img/hero/book2.png')}}" alt="book">
    </div>
    <div class="container">
        <div class="page-heading">
            <h1>Contact Us</h1>
            <div class="page-header">
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                    <li>
                        <a href="{{front_url('')}}">
                            Home
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li>
                        Contact Us
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section Start -->
<section class="contact-section fix section-padding">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row g-4 align-items-center">
                <div class="col-lg-4">
                    <div class="contact-left-items">
                        <div class="contact-info-area-2">
                            <div class="contact-info-items mb-4">
                                <div class="icon">
                                    <i class="icon-icon-10"></i>
                                </div>
                                <div class="content">
                                    <p>Call Us</p>
                                    <h3>
                                        <a href="tel: 023 902 904"> 023 902 904</a>
                                    </h3>
                                </div>
                            </div>
                            <div class="contact-info-items mb-4">
                                <div class="icon">
                                    <i class="icon-icon-11"></i>
                                </div>
                                <div class="content">
                                    <p>Make a Quote</p>
                                    <h3>
                                        <a href="mailto:elibrary@psbu.cloud">elibrary@psbu.cloud</a>
                                    </h3>
                                </div>
                            </div>
                            <div class="contact-info-items border-none">
                                <div class="icon">
                                    <i class="icon-icon-12"></i>
                                </div>
                                <div class="content">
                                    <p>Location</p>
                                    <h3>
                                        Sangkat Tonle Basac, Khan Chamkarmorn, Phnom Penh, Cambodia
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="video-image">
                            <img src="{{asset('frontend/assets/img/cover.png')}}" alt="img">
                            <div class="video-box">
                                <a href="https://www.youtube.com/watch?v=ZGeP_FfSsBI"
                                    class="video-btn ripple video-popup">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-content">
                        <h2>Ready to Get Started?</h2>
                        <p>
                            Nunc tincidunt cursus lectus ac semper. Aenean ullamcorper quis arcu molestie consequat.
                            Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut nec lobortis elit, eu
                            ultrices justo. Fusce auctor erat est, non fringilla nibh tempus quis. Aenean dignissim
                        </p>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" id="contact-form" method="POST" class="contact-form-items">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                    <div class="form-clt">
                                        <span>Your name*</span>
                                        <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="form-clt">
                                        <span>Your Email*</span>
                                        <input type="email" name="email" id="email123" placeholder="Your Email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 wow fadeInUp" data-wow-delay=".7s">
                                    <div class="form-clt">
                                        <span>Write Message*</span>
                                        <textarea name="message" id="message"
                                            placeholder="Write Message" class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-7 wow fadeInUp" data-wow-delay=".9s">
                                    <button type="submit" class="theme-btn">
                                        Send Message <i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<< Map Section Start >>-->
<div class="map-section">
    <div class="map-items">
        <div class="googpemap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6678.7619084840835!2d144.9618311901502!3d-37.81450084255415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642b4758afc1d%3A0x3119cc820fdfc62e!2sEnvato!5e0!3m2!1sen!2sbd!4v1641984054261!5m2!1sen!2sbd"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

@endsection