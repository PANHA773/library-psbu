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
        margin-top: 0;
        padding: 0;
        width: 100%;
        max-width: none;
        position: relative;
        left: 0;
        transform: none;
        background: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
    }

    .book-pdf-section {
        width: 100vw;
        max-width: 100vw;
        position: relative;
        left: 50%;
        margin-left: -50vw;
        background: #ffffff;
        padding: 26px 0 28px;
    }

    .book-pdf-band {
        width: 100%;
        padding: 0 32px;
    }

    .book-pdf-band-head {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        margin-bottom: 18px;
    }

    .book-pdf-band-head h4 {
        margin: 0;
        font-size: 1rem;
        color: #111827;
    }

    .book-pdf-band-head p,
    .pdf-footer-bar {
        color: #4b5563;
    }

    .book-pdf-viewer {
        width: calc(100% - 64px);
        margin: 0 32px;
        background: #2f2f2f;
        border-radius: 22px;
        padding: 24px 20px 18px;
        position: relative;
        overflow: hidden;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.04), 0 28px 70px rgba(15, 23, 42, 0.22);
    }

    .book-pdf-viewer::before,
    .book-pdf-viewer::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 58px;
        height: 58px;
        border-top: 3px solid rgba(255, 255, 255, 0.85);
        border-right: 3px solid rgba(255, 255, 255, 0.85);
        opacity: .65;
        transform: translateY(-50%) rotate(45deg);
        pointer-events: none;
        z-index: 2;
    }

    .book-pdf-viewer::before {
        left: 10px;
        transform: translateY(-50%) rotate(225deg);
    }

    .book-pdf-viewer::after {
        right: 10px;
    }

    .pdf-spread-stage {
        position: relative;
        min-height: clamp(720px, calc(100vh - 210px), 980px);
        display: flex;
        align-items: stretch;
        justify-content: center;
        gap: 0;
        padding: 0 56px;
    }

    .pdf-page-pane {
        position: relative;
        flex: 1 1 0;
        background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        overflow: hidden;
        min-height: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pdf-page-pane:first-child {
        border-radius: 2px 0 0 2px;
    }

    .pdf-page-pane:last-child {
        border-radius: 0 2px 2px 0;
    }

    .pdf-page-spine {
        width: 32px;
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.18), rgba(255, 255, 255, 0.96), rgba(0, 0, 0, 0.16));
        box-shadow: inset 0 0 34px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 2;
    }

    .pdf-page-spine::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.05), transparent);
    }

    .pdf-page-pane canvas {
        display: block;
        max-width: 100%;
        max-height: 100%;
        opacity: 1;
        transition: opacity .25s ease;
        image-rendering: auto;
    }

    .book-pdf-viewer.is-rendering .pdf-page-pane canvas {
        opacity: .82;
    }

    .pdf-loading-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        letter-spacing: .04em;
        background: rgba(47, 47, 47, 0.32);
        z-index: 3;
        backdrop-filter: blur(2px);
    }

    .pdf-nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 54px;
        height: 54px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        font-size: 2rem;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 4;
        transition: transform .2s ease, background .2s ease, opacity .2s ease;
    }

    .pdf-nav-button:hover {
        background: rgba(255, 255, 255, 0.18);
        transform: translateY(-50%) scale(1.04);
    }

    .pdf-nav-button:disabled {
        opacity: .35;
        cursor: not-allowed;
        transform: translateY(-50%);
    }

    .pdf-nav-prev {
        left: 18px;
    }

    .pdf-nav-next {
        right: 18px;
    }

    .pdf-footer-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 14px;
        font-size: .92rem;
    }

    .pdf-footer-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(17, 24, 39, 0.06);
        border: 1px solid rgba(17, 24, 39, 0.08);
        color: black;
        border-radius: 999px;
        padding: .5rem .95rem;
    }

    .pdf-footer-pill strong {
        color: #fff;
    }

    .pdf-action-link {
        border-radius: 999px;
        padding: .72rem 1.15rem;
        background: linear-gradient(135deg, #ff7b54, #ff5252);
        color: #fff;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 14px 30px rgba(255, 82, 82, 0.28);
    }

    .pdf-action-link:hover {
        color: #fff;
        opacity: .94;
    }

    .pdf-nav-button {
        background: rgba(17, 24, 39, 0.1);
        border-color: rgba(17, 24, 39, 0.15);
        color: #111827;
    }

    .pdf-nav-button:hover {
        background: rgba(17, 24, 39, 0.16);
    }

    /* Flip Animation Styles */
    .pdf-spread-stage {
        perspective: 3000px;
    }

    .flip-page-container {
        position: absolute;
        top: 0;
        width: calc((100% - 112px - 32px) / 2);
        height: 100%;
        z-index: 10;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        pointer-events: none;
    }

    .flip-page-container.flip-right-to-left {
        right: 56px;
        transform-origin: left center;
    }

    .flip-page-container.flip-left-to-right {
        left: 56px;
        transform-origin: right center;
    }

    .flip-page-front, .flip-page-back {
        position: absolute;
        inset: 0;
        backface-visibility: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .flip-page-back {
        transform: rotateY(180deg);
    }

    .flip-page-front canvas, .flip-page-back canvas {
        max-width: 100%;
        max-height: 100%;
        display: block;
    }

    /* Mobile simple transition */
    .mobile-fade-transition canvas {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .mobile-fade-out {
        opacity: 0;
        transform: scale(0.98);
    }

    @media (max-width: 991px) {
        .pdf-spread-stage {
            min-height: 70vh;
            padding: 0 24px;
        }

        .pdf-page-pane {
            min-height: 70vh;
        }
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

        .pdf-spread-stage {
            min-height: 64vh;
            padding: 0 12px;
        }

        .pdf-page-pane {
            min-height: 64vh;
        }

        .book-detail-thumb {
            min-height: 280px;
            padding: 12px;
        }

        .pdf-nav-button {
            width: 42px;
            height: 42px;
            font-size: 1.5rem;
        }

        .pdf-nav-prev {
            left: 8px;
        }

        .pdf-nav-next {
            right: 8px;
        }

        .pdf-footer-bar {
            flex-direction: column;
            align-items: flex-start;
            padding: 0 16px;
        }

        .book-pdf-band-head {
            padding: 0 16px;
        }

        .book-pdf-band {
            padding: 0 16px;
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
                    <div class="meta-chip">
                        <span>Author</span>
                        <strong>{{ $book->author ?: 'Unknown' }}</strong>
                    </div>
                    <div class="meta-chip">
                        <span>Published</span>
                        <strong>
                            {{ $book->author_date ? \Carbon\Carbon::parse($book->author_date)->format('Y') : 'Not set' }}
                        </strong>
                    </div>
                    <div class="meta-chip">
                        <span>Code</span>
                        <strong>{{ $book->code }}</strong>
                    </div>
                    <div class="meta-chip">
                        <span>Format</span>
                        <strong>{{ !empty($book->pdf) ? 'PDF available' : 'Print only' }}</strong>
                    </div>
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
                    <button type="button" class="theme-btn style-2" data-bs-toggle="modal" data-bs-target="#readMoreModal">
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

@if(!empty($book->pdf))
<section class="book-pdf-section">
    <div class="book-pdf-band">
        <div class="book-pdf-band-head">
            <div>
                <h4 class="battambang-regular mb-1">Read the PDF</h4>
                <p class="mb-0 text-muted">
                    Preview online. Downloads stay hidden unless the admin enables them.
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="book-crumb">Two-page reader</span>
            </div>
        </div>
        <div class="book-pdf-card">
            <div class="book-pdf-viewer" id="pdfViewer" data-pdf-url="{{ asset('uploads/books/pdfs/' . $book->pdf) }}">
                <button type="button" class="pdf-nav-button pdf-nav-prev" id="pdfPrevBtn" aria-label="Previous pages">
                    &#8249;
                </button>
                <div class="pdf-spread-stage">
                    <div class="pdf-page-pane">
                        <canvas id="pdfLeftCanvas"></canvas>
                    </div>
                    <div class="pdf-page-spine" aria-hidden="true"></div>
                    <div class="pdf-page-pane">
                        <canvas id="pdfRightCanvas"></canvas>
                    </div>
                    <div class="pdf-loading-overlay" id="pdfLoading">Loading PDF...</div>
                </div>
                <button type="button" class="pdf-nav-button pdf-nav-next" id="pdfNextBtn" aria-label="Next pages">
                    &#8250;
                </button>
            </div>
            <div class="pdf-footer-bar">
                <span class="pdf-footer-pill" id="pdfPageInfo">Page 1 - 2</span>
                @if(!empty($book->pdf_downloadable))
                <a href="{{ asset('uploads/books/pdfs/' . $book->pdf) }}" download class="pdf-action-link">
                    Download PDF
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if(!empty($book->pdf))
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewer = document.getElementById('pdfViewer');
        const pageInfo = document.getElementById('pdfPageInfo');
        const loading = document.getElementById('pdfLoading');
        const prevBtn = document.getElementById('pdfPrevBtn');
        const nextBtn = document.getElementById('pdfNextBtn');
        const leftCanvas = document.getElementById('pdfLeftCanvas');
        const rightCanvas = document.getElementById('pdfRightCanvas');

        if (!viewer || typeof pdfjsLib === 'undefined') {
            return;
        }

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const pdfUrl = viewer.dataset.pdfUrl;
        const leftPane = leftCanvas.closest('.pdf-page-pane');
        const rightPane = rightCanvas.closest('.pdf-page-pane');
        const spine = viewer.querySelector('.pdf-page-spine');
        const stage = viewer.querySelector('.pdf-spread-stage');
        let pdfDoc = null;
        let currentPage = 1;
        let renderSeq = 0;

        function isMobile() {
            return window.innerWidth < 992;
        }

        function setLoading(state) {
            loading.style.display = state ? 'flex' : 'none';
            viewer.classList.toggle('is-rendering', state);
        }

        async function renderPage(pageNumber, canvas, targetWidth, targetHeight) {
            if (!pageNumber || pageNumber > pdfDoc.numPages) {
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                canvas.style.display = 'none';
                return;
            }

            const page = await pdfDoc.getPage(pageNumber);
            const viewport = page.getViewport({ scale: 1 });
            const scale = Math.min(targetWidth / viewport.width, targetHeight / viewport.height);
            const cssViewport = page.getViewport({ scale });
            const outputScale = window.devicePixelRatio || 1;
            const renderViewport = page.getViewport({ scale: scale * outputScale });
            const context = canvas.getContext('2d');

            canvas.width = renderViewport.width;
            canvas.height = renderViewport.height;
            canvas.style.width = cssViewport.width + 'px';
            canvas.style.height = cssViewport.height + 'px';
            canvas.style.display = 'block';

            context.imageSmoothingEnabled = true;
            context.imageSmoothingQuality = 'high';
            context.clearRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: context, viewport: renderViewport }).promise;
        }

        async function renderSpread(direction = 0) {
            const seq = ++renderSeq;
            setLoading(true);

            const stageWidth = stage.clientWidth;
            const stageHeight = Math.max(stage.clientHeight - 28, 420);
            const mobile = isMobile();
            const leftPage = currentPage;
            const rightPage = mobile ? null : currentPage + 1;

            const gap = mobile ? 0 : 32;
            const pageWidth = mobile ? stageWidth - 10 : Math.floor((stageWidth - gap) / 2) - 10;
            const pageHeight = stageHeight;

            // If a flip animation is requested and we are not on mobile
            if (direction !== 0 && !mobile && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                const isNext = direction > 0;
                
                // Create flipper container
                const flipper = document.createElement('div');
                flipper.className = 'flip-page-container ' + (isNext ? 'flip-right-to-left' : 'flip-left-to-right');
                
                const front = document.createElement('div');
                front.className = 'flip-page-front';
                const frontCanvas = document.createElement('canvas');
                front.appendChild(frontCanvas);
                
                const back = document.createElement('div');
                back.className = 'flip-page-back';
                const backCanvas = document.createElement('canvas');
                back.appendChild(backCanvas);
                
                flipper.appendChild(front);
                flipper.appendChild(back);
                stage.appendChild(flipper);

                // Copy current page to front of flipper
                const sourceCanvas = isNext ? rightCanvas : leftCanvas;
                frontCanvas.width = sourceCanvas.width;
                frontCanvas.height = sourceCanvas.height;
                frontCanvas.style.width = sourceCanvas.style.width;
                frontCanvas.style.height = sourceCanvas.style.height;
                if (sourceCanvas.width > 0) {
                    frontCanvas.getContext('2d').drawImage(sourceCanvas, 0, 0);
                }

                // Render the incoming page to the back of the flipper
                const incomingPageNum = isNext ? leftPage : rightPage;
                await renderPage(incomingPageNum, backCanvas, pageWidth, pageHeight);

                // Prepare actual canvases behind the flipper
                // If next: update right canvas immediately to R2, left canvas stays L1 until flip finishes
                // If prev: update left canvas immediately to L2, right canvas stays R1 until flip finishes
                if (isNext) {
                    await renderPage(rightPage, rightCanvas, pageWidth, pageHeight);
                } else {
                    await renderPage(leftPage, leftCanvas, pageWidth, pageHeight);
                }

                // Trigger animation
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        flipper.style.transform = isNext ? 'rotateY(-180deg)' : 'rotateY(180deg)';
                    });
                });

                // Wait for animation to finish
                await new Promise(resolve => setTimeout(resolve, 800));
                
                // Now update the hidden side to the new page and remove flipper
                if (isNext) {
                    await renderPage(leftPage, leftCanvas, pageWidth, pageHeight);
                } else {
                    await renderPage(rightPage, rightCanvas, pageWidth, pageHeight);
                }
                
                flipper.remove();
                
            } else if (direction !== 0 && mobile) {
                // Simple fade for mobile
                leftCanvas.classList.add('mobile-fade-transition', 'mobile-fade-out');
                await new Promise(resolve => setTimeout(resolve, 300));
                await renderPage(leftPage, leftCanvas, pageWidth, pageHeight);
                leftCanvas.classList.remove('mobile-fade-out');
                await new Promise(resolve => setTimeout(resolve, 300));
                leftCanvas.classList.remove('mobile-fade-transition');
            } else {
                // Normal render without animation
                leftPane.style.display = 'flex';
                rightPane.style.display = mobile ? 'none' : 'flex';
                spine.style.display = mobile ? 'none' : 'block';
                
                await renderPage(leftPage, leftCanvas, pageWidth, pageHeight);
                if (!mobile) {
                    await renderPage(rightPage, rightCanvas, pageWidth, pageHeight);
                }
            }

            if (seq !== renderSeq) {
                return;
            }

            pageInfo.textContent = mobile
                ? 'Page ' + leftPage + ' of ' + pdfDoc.numPages
                : 'Page ' + leftPage + ' - ' + Math.min(rightPage || leftPage, pdfDoc.numPages) + ' of ' + pdfDoc.numPages;

            prevBtn.disabled = currentPage <= 1;
            nextBtn.disabled = mobile
                ? currentPage >= pdfDoc.numPages
                : currentPage >= pdfDoc.numPages - 1;
                
            if (seq === renderSeq) {
                setLoading(false);
            }
        }

        function goPrev() {
            if (currentPage <= 1) return;
            if (isMobile()) {
                currentPage = Math.max(1, currentPage - 1);
            } else {
                currentPage = Math.max(1, currentPage - 2);
            }
            renderSpread(-1);
        }

        function goNext() {
            if (isMobile()) {
                if (currentPage >= pdfDoc.numPages) return;
                currentPage = Math.min(pdfDoc.numPages, currentPage + 1);
            } else {
                if (currentPage >= pdfDoc.numPages - 1) return;
                currentPage = Math.min(pdfDoc.numPages, currentPage + 2);
            }
            renderSpread(1);
        }

        prevBtn.addEventListener('click', goPrev);
        nextBtn.addEventListener('click', goNext);

        let resizeTimer = null;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                renderSpread();
            }, 150);
        });

        pdfjsLib.getDocument(pdfUrl).promise
            .then(function (doc) {
                pdfDoc = doc;
                return renderSpread();
            })
            .catch(function (error) {
                console.error('PDF preview failed:', error);
                pageInfo.textContent = 'Preview unavailable';
                setLoading(false);
                viewer.innerHTML = '<div class="pdf-loading-overlay">PDF preview could not be loaded.</div>';
            });
    });
</script>
@endif

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
