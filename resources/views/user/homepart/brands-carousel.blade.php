<!-- Swiper Brands Carousel -->
<section class="my-5">
    <div class="container">
        <!-- Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Shop by Brand</h2>
            <a href="{{ route('allbrands') }}" class="btn btn-outline-primary btn-sm">View All Brands</a>
        </div>

        <!-- Swiper Container -->
        <div class="swiper brand-swiper">
            <div class="swiper-wrapper">
                @foreach ($brands as $brand)
                    <div class="swiper-slide">
                        <a href="{{ route('allproducts', ['brand' => $brand->id]) }}" class="text-decoration-none">
                            <div class=" category-card text-center shadow border-0 h-100">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-3" style="height: 120px;">
                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                        alt="{{ $brand->name }}"
                                        class="img-fluid img-preview"
                                        style="max-height: 100%; object-fit: contain;"
                                        loading="lazy">
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-bold text-dark mb-1">{{ $brand->name }}</h6>
                                    <small class="text-muted">{{ $brand->subcategory->name ?? 'N/A' }}</small>
                                    <a href="{{ route('allproducts', ['brand' => $brand->id]) }}"
                                   class="btn btn-outline-primary btn-sm w-100">Explore</a>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            <div class="d-flex justify-content-center mt-4 gap-3">
                <button class="btn btn-outline-primary btn-sm rounded-circle shadow brand-prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-circle shadow brand-next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-body p-0 text-center">
                <img id="previewModalImg" src="" alt="Preview" class="img-fluid rounded" />
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Image preview click
    $(document).on('click', '.img-preview', function (e) {
        e.preventDefault();
        const imgSrc = $(this).attr('src');
        $('#previewModalImg').attr('src', imgSrc);
        $('#imagePreviewModal').modal('show');
    });

    // Initialize Brand Swiper
    const brandContainer = document.querySelector('.brand-swiper');
    if (brandContainer) {
        new Swiper(brandContainer, {
            slidesPerView: 5,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.brand-next',
                prevEl: '.brand-prev',
            },
            breakpoints: {
                320: { slidesPerView: 2, spaceBetween: 10 },
                576: { slidesPerView: 3, spaceBetween: 15 },
                768: { slidesPerView: 4, spaceBetween: 15 },
                992: { slidesPerView: 5, spaceBetween: 20 }
            }
        });
    }
});
</script>
@endpush
