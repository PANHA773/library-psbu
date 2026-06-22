@extends(front_layout('main'))
@section('content')

<!-- Hero Section start  -->
<div class="hero-section hero-1 fix">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8 col-lg-6">
                <div class="hero-items">
                    <div class="book-shape">
                        <img src="{{asset('frontend/assets/img/readingbook.jpg')}}" alt="shape-img" class="img-fluid" style="width: 300px">
                    </div>
                    <div class="frame-shape1 float-bob-x">
                        <img src="{{asset('frontend/assets/img/hero/frame.png')}}" alt="shape-img">
                    </div>
                    <div class="frame-shape2 float-bob-y">
                        <img src="{{asset('frontend/assets/img/hero/frame-2.png')}}" alt="shape-img">
                    </div>
                    <div class="frame-shape3">
                        <img src="{{asset('frontend/assets/img/hero/xstar.png')}}" alt="img">
                    </div>
                    <div class="frame-shape4 float-bob-x">
                        <img src="{{asset('frontend/assets/img/hero/frame-shape.png')}}" alt="img">
                    </div>
                    <div class="bg-shape1">
                        <img src="{{asset('frontend/assets/img/hero/bg-shape.png')}}" alt="img">
                    </div>
                    <div class="bg-shape2">
                        <img src="{{asset('frontend/assets/img/hero/bg-shape2.png')}}" alt="shape-img">
                    </div>
                    <div class="hero-content">
                        
                        <h1 class="wow fadeInUp moul-beauty" data-wow-delay=".5s">បណ្ណាល័យតេជោសន្តិភាព<br><span style="color: #FF6500">សូមស្វាគមន៍</span>
                        </h1>
                        <div class="form-clt wow fadeInUp" data-wow-delay=".9s">
                            <button type="submit" class="theme-btn">
                                Books more <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-4 col-lg-6">
                <div class="girl-image">
                    <img class=" float-bob-x" src="{{asset('frontend/assets/img/psbu-student.png')}}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>

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
<section class="cta-banner-section fix section-padding pt-12">
    <div class="container">
        <div class="cta-banner-wrapper section-padding bg-cover"
            style="background-image: url('{{asset('frontend/assets/img/banner1.jpg')}}');">
            <div class="book-shape">
                {{-- <img src="{{asset('frontend/assets/img/.jpg')}}" alt="shape-img"> --}}
            </div>
            <div class="girl-shape float-bob-x">
                <img src="{{asset('frontend/assets/img/student.png')}}" alt="shape-img">
            </div>
            <div class="cta-content text-center">
                <h2 class="mb-40 wow fadeInUp moul-beauty" data-wow-delay=".3s"
                    style="color:#FF6500; visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">សកម្មភាពនិស្សិតកំពុងអានសៀវភៅ</h2>
                <a href="shop.html" class="theme-btn wow fadeInUp" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">Books more<i
                        class="fa-solid fa-arrow-right-long"></i></a>
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