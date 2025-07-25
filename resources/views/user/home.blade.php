@extends('user.layouts.master')

@section('title', 'Home - ShopNow')

@section('content')
@push('styles')
<style>
    body { 
        background-color: #111; 
        color: #fff; 
        font-family: 'Segoe UI', sans-serif; 
    }
    
    .hero-section { 
        padding: 80px 0; 
        background: radial-gradient(#222, #000); 
    }
    
    .hero-content h1 { 
        font-size: 3rem; 
        font-weight: bold; 
    }
    
    .hero-content p { 
        font-size: 1.2rem; 
        color: #aaa;
    }
    
    .btn-primary { 
        background-color: #ff6b6b; 
        border: none; 
    }
    
    .btn-primary:hover { 
        background-color: #ff5252; 
    }
    
    .category-card, .brand-card, .product-card, .blog-card, .promo-card {
        background: #1a1a1a; 
        border-radius: 16px; 
        padding: 20px; 
        margin: 10px;
        transition: all 0.3s ease; 
        border: 1px solid #333;
    }
    
    .category-card:hover, .brand-card:hover, .product-card:hover, .blog-card:hover, .promo-card:hover {
        transform: translateY(-5px); 
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }
    
    .swiper-slide { 
        width: 250px !important; 
    }
    
    .floating-cart {
        position: fixed; 
        bottom: 30px; 
        right: 30px; 
        z-index: 999;
    }
    
    .rating i { 
        color: gold; 
    }
    
    footer { 
        background-color: #000; 
        padding: 40px 0; 
    }
    
    /* Product card specific styles */
    .product-card {
        transition: 0.3s ease;
        border-radius: 1rem;
        padding: 0.5rem;
        background: #1a1a1a;
        border: 1px solid #333;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }
    
    .card-img-top {
        height: 120px !important;
        object-fit: contain;
        background-color: #222;
        padding: 0.5rem;
        cursor: pointer;
        border-radius: 12px 12px 0 0;
    }
    
    .card-body {
        padding: 0.6rem 0.75rem;
        background: transparent;
    }
    
    .card-title {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        color: #fff;
    }
    
    .card-body p {
        font-size: 0.75rem;
        margin-bottom: 0.5rem;
        color: #aaa;
    }
    
    .card-body .btn {
        font-size: 0.75rem;
        padding: 6px 12px;
    }
    
    .swiper-category-prev,
    .swiper-category-next {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #333;
        border-radius: 50%;
        color: #fff;
    }
    
    .testimonial-swiper .card {
        min-height: 330px;
        background: #1a1a1a;
        border: 1px solid #333;
    }
    
    /* Newsletter section */
    .newsletter-section {
        background: #222 !important;
        border-top: 1px solid #333;
        border-bottom: 1px solid #333;
    }
    
    /* Search box */
    .search-box {
        background: #222;
        border: 1px solid #333;
        color: #fff;
    }
    
    .search-box::placeholder {
        color: #666;
    }
    .promo-card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.promo-card:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.promo-overlay {
    background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.5), rgba(20, 20, 20, 0.7));
    backdrop-filter: blur(3px);
    transition: background 0.3s ease;
}

.promo-title {
    font-size: 1.25rem;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
}

.promo-btn {
    background-color: rgba(255, 255, 255, 0.15);
    border: 1px solid white;
    color: black;
    transition: all 0.3s ease;
}

.promo-btn:hover {
    background-color: white;
    color: #000;
}

</style>
@endpush
@push('styles')
<style>
#search-results {
    position: absolute;
    top: 100%; /* shows below input */
    left: 0;
    width: 100%;
    z-index: 9999 !important; /* 👈 highest priority */
    background-color: #1a1a1a;
    border: 1px solid #333;
    max-height: 350px;
    overflow-y: auto;
}
</style>
@endpush

<!-- Hero Section -->
<section class="hero-section text-center ">
    <div class="container hero-content position-relative">
        <h1>Discover the Future of Shopping</h1>
        <p>Explore curated collections from top categories and brands</p>
        
<x-search-box/>
        <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('allproducts') }}" class="btn btn-primary px-4">Shop Now</a>
            <a href="{{ route('allproducts', ['filter' => 'featured']) }}" class="btn btn-outline-light px-4">Featured Products</a>
        </div>
    </div>
</section>


<!-- Featured Products -->
<section class="container py-5">
    <h1 class="text-center mb-4">Best Sales Products</h1>
    <div class="row g-4">
        @forelse($featured as $product)
            @include('user.homepart.product-card', ['product' => $product])
        @empty
            <div class="col-12 text-center text-muted">No featured products available.</div>
        @endforelse
    </div>
</section>

<!-- Promo Banners -->
<section class="container py-5">
    
    <div class="row g-4">
        @foreach($promos->take(3) as $promo)
            <div class="col-md-4">
                <div class="promo-card card">

                    <img src="{{ asset('storage/' . $promo->image) }}" class="card-img-top" style="height:150px; object-fit:cover;" alt="{{ $promo->title }}" loading="lazy">
                    <div class="card-body text-black">
                        <h5 class="fw-bold text-black">{{ $promo->title }}</h5>
                        @if($promo->button_text && $promo->button_link)
                            <a href="{{ $promo->button_link }}" class="btn btn-outline-light text-black btn-sm mt-2">{{ $promo->button_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Categories Carousel -->
@include('user.homepart.categories-carousel')

<!-- Brands Carousel -->
@include('user.homepart.brands-carousel')

<!-- Latest Products -->
<section class="container py-5">
    <h2 class="text-center mb-4">New Arrivals Products</h2>
    <div class="row g-4">
        @forelse($products as $product)
            @include('user.homepart.product-card', ['product' => $product])
        @empty
            <div class="col-12 text-center text-muted">No products found.</div>
        @endforelse
    </div>
</section>

<!-- Testimonials -->
@include('user.homepart.homeTestimonials')

<!-- Blog Posts -->
@include('user.homepart.blog-preview')

<!-- Newsletter -->
<section class="newsletter-section py-5">
    <div class="container text-center">
        <h2 class="mb-3">Stay Updated!</h2>
        <p>Subscribe to our newsletter to receive the latest deals and news</p>
        <form id="newsletter-form" class="row justify-content-center g-2">
            <div class="col-md-6 col-sm-8">
                <div class="input-group input-group-lg">
                    <input type="email" class="form-control search-box" placeholder="Your email address" required>
                    <button class="btn btn-primary px-4" type="submit">Subscribe</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Features Section -->
@include('user.homepart.feature-section')


@endsection
@push('scripts')
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const timers = @json($timeBlocks);
    
    timers.forEach((block, index) => {
        const endTime = new Date(block.time).getTime();
        const timerId = `timer-${index}`;

        const interval = setInterval(() => {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                document.getElementById(timerId).innerText = "Expired";
                clearInterval(interval);
            } else {
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById(timerId).innerText =
                    `${hours}h ${minutes}m ${seconds}s remaining`;
            }
        }, 1000);
    });
});
</script>
@endpush


<script>
$(document).ready(function () {
    let selectedIndex = -1;

    $('#global-search').on('keydown', function (e) {
        const items = $('#search-results .dropdown-item');
        if (e.key === 'ArrowDown') {
            selectedIndex = (selectedIndex + 1) % items.length;
            items.removeClass('active').eq(selectedIndex).addClass('active');
            e.preventDefault();
        } else if (e.key === 'ArrowUp') {
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
            items.removeClass('active').eq(selectedIndex).addClass('active');
            e.preventDefault();
        } else if (e.key === 'Enter' && selectedIndex !== -1) {
            items.eq(selectedIndex).trigger('click');
            e.preventDefault();
        }
    });

    $('#global-search').on('input', function () {
        let query = $(this).val().trim();

        if (query.length < 2) {
            $('#search-results').hide().html('');
            return;
        }

        $.ajax({
            url: "{{ route('search.suggestions') }}",
            type: "GET",
            data: { q: query },
            success: function (res) {
                selectedIndex = -1;
                let html = '';

                const highlight = (text) => {
                    const regex = new RegExp(`(${query})`, 'i');
                    return text.replace(regex, '<span class="text-success fw-bold">$1</span>');
                };

                if (res.length > 0) {
                    res.forEach(item => {
                        html += `
                            <a href="${item.url}" class="dropdown-item">
                                ${highlight(item.name)}<br>
                                <small class="text-muted">${item.type}</small>
                            </a>`;
                    });
                } else {
                    html = '<div class="dropdown-item text-muted">No results found</div>';
                }

                $('#search-results').html(html).show();
            }
        });
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#global-search, #search-results').length) {
            $('#search-results').hide();
        }
    });

    $('#search-form').on('submit', function (e) {
        e.preventDefault(); // stop page reload
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    // Your existing search functionality
    $('#global-search').on('keyup', function () {
        let query = $(this).val().trim();

        if (query.length < 2) {
            $('#search-results').hide().html('');
            return;
        }

        $.ajax({
            url: "{{ route('search.suggestions') }}",
            type: "GET",
            data: { q: query },
            success: function (res) {
                let html = '';
                if (res.products.length || res.categories.length || res.brands.length) {
                    res.products.forEach(product => {
                        html += `
                            <a href="/product/${product.id}" class="dropdown-item">
                                <strong>${product.name}</strong>
                                <small class="text-muted d-block">Product</small>
                            </a>`;
                    });

                    res.categories.forEach(cat => {
                        html += `
                            <a href="/allproducts?category=${cat.id}" class="dropdown-item">
                                ${cat.name}
                                <small class="text-muted d-block">Category</small>
                            </a>`;
                    });

                    res.brands.forEach(brand => {
                        html += `
                            <a href="/allproducts?brand=${brand.id}" class="dropdown-item">
                                ${brand.name}
                                <small class="text-muted d-block">Brand</small>
                            </a>`;
                    });
                } else {
                    html = '<div class="dropdown-item text-muted">No results found</div>';
                }

                $('#search-results').html(html).show();
            }
        });
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#global-search, #search-results').length) {
            $('#search-results').hide();
        }
    });
});

// Initialize Swipers with dark theme navigation buttons
const brandSwiper = new Swiper('.brand-swiper', {
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 5 },
        1200: { slidesPerView: 6 },
    },
    navigation: {
        nextEl: '.swiper-brand-next',
        prevEl: '.swiper-brand-prev',
    },
});

const categorySwiper = new Swiper('.category-swiper', {
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 5 },
        1200: { slidesPerView: 6 },
    },
    navigation: {
        nextEl: '.swiper-category-next',
        prevEl: '.swiper-category-prev',
    },
});

const testimonialSwiper = new Swiper('.testimonial-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.testimonial-next',
        prevEl: '.testimonial-prev',
    },
    breakpoints: {
        768: { slidesPerView: 1 },
        992: { slidesPerView: 2 },
    },
});


</script>
@endpush
@push('scripts')
<script>
$(document).ready(function () {
    // Image preview in modal
    $('.previewable-image').on('click', function () {
        const imageUrl = $(this).data('image');
        $('#previewImage').attr('src', imageUrl);
        $('#categoryModal').modal('show');
    });
});
</script>

@endpush