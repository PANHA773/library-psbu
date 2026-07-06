@extends(front_layout('main'))
@section('content')
<style>
    .book-detail-shell {
        position: relative;
    }
    .book-detail-shell::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top left, rgba(255, 128, 0, 0.08), transparent 34%),
            radial-gradient(circle at bottom right, rgba(13, 110, 253, 0.08), transparent 30%);
        pointer-events: none;
    }
    .book-detail-card,
    .book-pdf-card,
    .book-summary-card {
        position: relative;
        z-index: 1;
        background: #fff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 24px;
        box-shadow: 0 22px 60px rgba(15, 23, 42, 0.08);
    }
    .book-detail-card {
        padding: 18px;
    }
    .book-detail-thumb {
        background: linear-gradient(180deg, #fbfbfb, #f4f7fb);
        border-radius: 20px;
        padding: 18px;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .book-detail-thumb img {
        width: 100%;
        max-width: 420px;
        max-height: 560px;
        object-fit: cover;
        border-radius: 18px;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
    }
    .book-crumb {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: rgba(255, 101, 0, 0.1);
        color: #ff6500;
        border-radius: 999px;
        padding: .45rem .85rem;
        font-size: .85rem;
        font-weight: 700;
    }
    .book-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin: 18px 0 8px;
    }
    .meta-chip {
        background: #f8fafc;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 16px;
        padding: 12px 14px;
    }
    .meta-chip span {
        display: block;
        font-size: .78rem;
        color: #64748b;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .meta-chip strong {
        color: #0f172a;
        font-size: .98rem;
        font-family: 'Battambang', sans-serif;
    }
    .book-summary-card {
        padding: 18px 20px;
        margin-top: 18px;
        background: linear-gradient(180deg, #ffffff, #fbfdff);
    }
    .book-summary-card h4 {
        font-size: 1.1rem;
        margin-bottom: 12px;
    }
    .book-description {
        color: #334155;
        line-height: 1.9;
        font-size: .98rem;
    }
    .book-action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-top: 18px;
    }
    .book-action-row .theme-btn {
        min-height: 48px;
    }
    .book-pdf-card {
        margin-top: 22px;
        padding: 18px;
    }
    .book-pdf-head {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        margin-bottom: 14px;
    }
    .book-pdf-head h4 {
        margin: 0;
        font-size: 1rem;
    }
    .book-pdf-preview {
        border: 1px solid rgba(15, 23, 42, 0.1);
        border-radius: 18px;
        overflow: hidden;
        background: #f8fafc;
        min-height: 360px;
        position: relative;
        background: #fff;
    }
    .pdf-toolbar-mask {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 56px;
        background: linear-gradient(180deg, #ffffff 0%, #ffffff 70%, rgba(255,255,255,0.86) 100%);
        z-index: 3;
        pointer-events: none;
        border-bottom: 1px solid rgba(15, 23, 42, 0.06);
    }
    .book-pdf-preview iframe {
        width: 100%;
        height: 560px;
        border: 0;
        display: block;
    }
    .section-title-soft {
        margin-bottom: 18px;
    }
    .section-title-soft h2 {
        font-size: 1.15rem;
        margin-bottom: 0;
    }
    @media (max-width: 991px) {
        .book-detail-thumb {
            min-height: 360px;
        }
    }
    @media (max-width: 575px) {
        .book-meta-grid {
            grid-template-columns: 1fr;
        }
        .book-pdf-preview {
            min-height: 280px;
        }
        .book-pdf-preview iframe {
            height: 420px;
        }
        .book-detail-thumb {
            min-height: 280px;
            padding: 12px;
        }
    }
</style>
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
            <h1>{{__('frontend.book_details')}}</h1>
            <div class="page-header">
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                    <li>
                        <a href="{{front_url('')}}">
                            {{__('frontend.home')}}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li>
                        {{__('frontend.book_details')}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Shop Details Section Start -->
<section class="shop-details-section fix section-padding">
    <div class="container">
        <div class="shop-details-wrapper">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="book-detail-card">
                        <div class="book-detail-thumb">
                            <div id="thumb1" class="tab-pane fade show active">
                                <div class="shop-details-thumb">
                                    <img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png')}}" alt="img" class="img-fluid">
                                </div>
                            </div>
                            {{-- <div id="thumb2" class="tab-pane fade">
                                <div class="shop-details-thumb">
                                    <img src="{{asset('frontend/assets/img/shop-details/02.png')}}" alt="img">
                                </div>
                            </div>
                            <div id="thumb3" class="tab-pane fade">
                                <div class="shop-details-thumb">
                                    <img src="{{asset('frontend/assets/img/shop-details/03.png')}}" alt="img">
                                </div>
                            </div>
                            <div id="thumb4" class="tab-pane fade">
                                <div class="shop-details-thumb">
                                    <img src="{{asset('frontend/assets/img/shop-details/04.png')}}" alt="img">
                                </div>
                            </div>
                            <div id="thumb5" class="tab-pane fade">
                                <div class="shop-details-thumb">
                                    <img src="{{asset('frontend/assets/img/shop-details/05.png')}}" alt="img">
                                </div>
                            </div> --}}
                        </div>
                        {{-- <ul class="nav">
                            <li class="nav-item">
                                <a href="#thumb1" data-bs-toggle="tab" class="nav-link active">
                                    <img src="{{asset('frontend/assets/img/shop-details/sm-1.png')}}" alt="img">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#thumb2" data-bs-toggle="tab" class="nav-link">
                                    <img src="{{asset('frontend/assets/img/shop-details/sm-2.png')}}" alt="img">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#thumb3" data-bs-toggle="tab" class="nav-link">
                                    <img src="{{asset('frontend/assets/img/shop-details/sm-3.png')}}" alt="img">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#thumb4" data-bs-toggle="tab" class="nav-link">
                                    <img src="{{asset('frontend/assets/img/shop-details/sm-4.png')}}" alt="img">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#thumb5" data-bs-toggle="tab" class="nav-link">
                                    <img src="{{asset('frontend/assets/img/shop-details/sm-5.png')}}" alt="img">
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="shop-details-content">
                        <span class="book-crumb mb-3">
                            {{ $category->name ?? __('frontend.book_details') }}
                        </span>
                        <div class="title-wrapper">
                            <h2 class="battambang-regular mb-2">{{$book->title }}</h2>
                            <p class="mb-0 text-muted">A clean reading view with quick access to the PDF and book summary.</p>
                        </div>
                        <div class="book-meta-grid">
                            <!-- <div class="meta-chip">
                                <span>Author</span>
                                <strong>{{ $book->author ?: 'Unknown' }}</strong>
                            </div> -->
                            <div class="meta-chip">
                                <span>Published</span>
                                <strong>{{ $book->author_date ?: 'Not set' }}</strong>
                            </div>
                            <!-- <div class="meta-chip">
                                <span>Code</span>
                                <strong>{{ $book->code }}</strong>
                            </div> -->
                            <!-- <div class="meta-chip">
                                <span>Format</span>
                                <strong>{{ !empty($book->pdf) ? 'PDF available' : 'Print only' }}</strong>
                            </div> -->
                        </div>

                        <div class="book-summary-card">
                            <h4 class="battambang-regular">Overview</h4>
                            <div class="book-description">
                                <?= decode_html($book->details) ?>
                            </div>
                        </div>
                        <div class="cart-wrapper book-action-row">
                            {{-- <div class="quantity-basket">
                                <p class="qty">
                                    <button class="qtyminus" aria-hidden="true">−</button>
                                    <input type="number" name="qty" id="qty2" min="1" max="10" step="1" value="1">
                                    <button class="qtyplus" aria-hidden="true">+</button>
                                </p>
                            </div>  --}}
                            <button type="button"  class="theme-btn style-2" data-bs-toggle="modal" data-bs-target="#readMoreModal">
                                Read A little
                                </button>
                                <!-- Read More Modal -->
                            <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 24px; overflow: hidden;">
                                        <div class="modal-body" style="background: linear-gradient(180deg, #ffffff, #f8fafc);">
                                            <div class="close-btn text-end mb-3">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="readMoreBox"> 
                                                <div class="content">
                                                    <span class="book-crumb mb-3">{{ $category->name ?? __('frontend.book_details') }}</span>
                                                    <h3 id="readMoreModalLabel" class="battambang-regular">{{$book->title}}</h3>
                                                    <p class="mb-0">
                                                       <?= decode_html($book->details) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="shop-details.html" class="theme-btn"><i
                                    class="fa-solid fa-basket-shopping"></i> Add To Cart</a>
                            <div class="icon-box">
                                <a href="shop-details.html" class="icon">
                                    <i class="far fa-heart"></i>
                                </a>
                                <a href="shop-details.html" class="icon-2">
                                    <img src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                </a>
                            </div> --}}
                        </div>
                        @if(!empty($book->pdf))
                        <div class="book-pdf-card">
                            <div class="book-pdf-head">
                                <div>
                                    <h4 class="battambang-regular mb-1">Read the PDF</h4>
                                    <p class="mb-0 text-muted">
                                        Preview online. Downloads stay hidden unless the admin enables them.
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @if(!empty($book->pdf_downloadable))
                                        <a href="{{ asset('uploads/books/pdfs/' . $book->pdf) }}" download class="theme-btn">
                                            Download
                                        </a>
                                    @else
                                        <span class="book-crumb">Downloads disabled</span>
                                    @endif
                                </div>
                            </div>
                            <div
                                class="book-pdf-preview"
                                id="pdfPreview"
                                data-pdf-url="{{ asset('uploads/books/pdfs/' . $book->pdf) }}"
                            >
                                <div class="pdf-toolbar-mask" aria-hidden="true"></div>
                                <iframe
                                    src="{{ asset('uploads/books/pdfs/' . $book->pdf) }}#toolbar=0&navpanes=0&scrollbar=0"
                                    title="{{ $book->title }} PDF"
                                ></iframe>
                            </div>
                        </div>
                        @endif
                        {{-- <div class="category-box">
                            <div class="category-list">
                                <ul>
                                    <li>
                                        <span>SKU:</span> FTC1020B65D
                                    </li>
                                    <li>
                                        <span>Category:</span> Kids Toys
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <span>Tags:</span> Design Low Book
                                    </li>
                                    <li>
                                        <span>Format:</span> Hardcover
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <span>Total page:</span> 330
                                    </li>
                                    <li>
                                        <span>Language:</span> English
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <span>Publish Years:</span> 2021
                                    </li>
                                    <li>
                                        <span>Century:</span> United States
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box-check">
                            <div class="check-list">
                                <ul>
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        Free shipping orders from $150
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        30 days exchange & return
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        Mamaya Flash Discount: Starting at 30% Off
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        Safe & Secure online shopping
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="social-icon">
                            <h6>Also Available On:</h6>
                            <a href="https://www.customer.io/"><img src="assets/img/cutomerio.png" alt="cutomer.io"></a>
                            <a href="https://www.amazon.com/"><img src="assets/img/amazon.png" alt="amazon"></a>
                            <a href="https://www.dropbox.com/"><img src="assets/img/dropbox.png" alt="dropbox"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-tab section-padding pb-0">
                <ul class="nav mb-5" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active"
                            aria-selected="true" role="tab">
                            <h6>Description</h6>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#additional" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                            tabindex="-1" role="tab">
                            <h6>Additional Information </h6>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#review" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1"
                            role="tab">
                            <h6>reviews (3)</h6>
                        </a>
                    </li>
                </ul> --}}
                {{-- <div class="tab-content">
                    <div id="description" class="tab-pane fade show active" role="tabpanel">
                        <div class="description-items">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis erat
                                interdum, tempor turpis in, sodales ex. In hac habitasse platea dictumst. Etiam
                                accumsan scelerisque urna, a lobortis velit vehicula ut. Maecenas porttitor dolor a
                                velit aliquet, et euismod nibh vulputate. Duis nunc velit, lacinia vel risus in,
                                finibus sodales augue. Aliquam lacinia imperdiet dictum. Etiam tempus finibus
                                tortor, quis placerat arcu tristique in. Sed vitae dui a diam luctus maximus.
                                Quisque nec felis dapibus, dapibus enim vitae, vestibulum libero. Aliquam erat
                                volutpat. Phasellus luctus rhoncus justo. Duis a nulla sit amet justo aliquam
                                ullamcorper. Phasellus nulla lorem, pretium et libero in, porta auctor dui. In a
                                ornare purus, et efficitur elit. Etiam consectetur sit amet quam ut tincidunt. Donec
                                gravida ultricies tellus ac pharetra.
                                Praesent a pulvinar purus. Proin sollicitudin leo eget mi sagittis aliquam. Donec
                                sollicitudin ex ac lobortis mollis. Sed eget libero nec mi
                            </p>
                        </div>
                    </div>
                    <div id="additional" class="tab-pane fade" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-1">Availability</td>
                                        <td class="text-2">Available</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Categories</td>
                                        <td class="text-2">Adventure</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Publish Date</td>
                                        <td class="text-2">2022-10-24</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Total Page</td>
                                        <td class="text-2">330</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Format</td>
                                        <td class="text-2">Hardcover</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Country</td>
                                        <td class="text-2">United States</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Language</td>
                                        <td class="text-2">English</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Dimensions</td>
                                        <td class="text-2">30 × 32 × 46 Inches</td>
                                    </tr>
                                    <tr>
                                        <td class="text-1">Weight</td>
                                        <td class="text-2">2.5 Pounds</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    {{-- <div id="review" class="tab-pane fade" role="tabpanel">
                        <div class="review-items">
                            <div class="review-wrap-area d-flex gap-4">
                                <div class="review-thumb">
                                    <img src="assets/img/shop-details/review.png" alt="img">
                                </div>
                                <div class="review-content">
                                    <div
                                        class="head-area d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                        <div class="cont">
                                            <h5><a href="news-details.html">Leslie Alexander</a></h5>
                                            <span>February 10, 2024 at 2:37 pm</span>
                                        </div>
                                        <div class="star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                    </div>
                                    <p class="mt-30 mb-4">
                                        Neque porro est qui dolorem ipsum quia quaed inventor veritatis et quasi
                                        architecto var sed efficitur turpis gilla sed sit amet finibus eros. Lorem
                                        Ipsum is <br> simply dummy
                                    </p>
                                </div>
                            </div>
                            <div class="review-title mt-5 py-15 mb-30">
                                <h4>Your Rating*</h4>
                                <div class="rate-now d-flex align-items-center">
                                    <p>Your Rating*</p>
                                    <div class="star">
                                        <i class="fa-light fa-star"></i>
                                        <i class="fa-light fa-star"></i>
                                        <i class="fa-light fa-star"></i>
                                        <i class="fa-light fa-star"></i>
                                        <i class="fa-light fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="review-form">
                                <form action="#" id="contact-form" method="POST">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="form-clt">
                                                <span>Your Name*</span>
                                                <input type="text" name="name" id="name" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-clt">
                                                <span>Your Email*</span>
                                                <input type="text" name="email" id="email" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 wow fadeInUp animated" data-wow-delay=".8">
                                            <div class="form-clt">
                                                <span>Message*</span>
                                                <textarea name="message" id="message"
                                                    placeholder="Write Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 wow fadeInUp animated" data-wow-delay=".9">
                                            <div class="form-check d-flex gap-2 from-customradio">
                                                <input type="checkbox" class="form-check-input"
                                                    name="flexRadioDefault" id="flexRadioDefault12">
                                                <label class="form-check-label" for="flexRadioDefault12">
                                                    i accept your terms & conditions
                                                </label>
                                            </div>
                                            <button type="submit" class="theme-btn">
                                                Submit now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Ratting Book Section Start -->
<section class="top-ratting-book-section fix section-padding pt-0">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">Related Books</h2>
            <p class="wow fadeInUp" data-wow-delay=".5s">
                Interdum et malesuada fames ac ante ipsum primis in faucibus. <br> Donec at nulla nulla. Duis
                posuere ex lacus
            </p>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                @foreach($relate_books as $book)
                <div class="swiper-slide">
                    <div class="shop-box-items style-2">
                        <div class="book-thumb center">
                            <a href="{{ front_url('book_details/'. $book->slug)}}"><img src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('uploads/books/no_image.png') }}" alt="img"></a>
                            <ul class="shop-icon d-grid justify-content-center align-items-center">
                                
                                <li>
                                    <a href="{{ front_url('book_details/'. $book->slug)}}"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-content">
                            <h3 class="battambang-regular"><a href="{{ front_url('book_details/'. $book->slug)}}"><?= $book->title; ?></a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
