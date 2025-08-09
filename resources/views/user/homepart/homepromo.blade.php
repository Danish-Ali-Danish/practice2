<section class="container px-0 mb-5">
    <div class="swiper promo-swiper ">
        <div class="swiper-wrapper">
            @foreach($promos as $promo)
                <div class="swiper-slide">
                    <div class="position-relative" style="aspect-ratio: 16 / 6; background: url('{{ asset('storage/' . $promo->image) }}') center center / cover no-repeat;">
                        <div class="promo-overlay position-absolute bottom-0 start-0 translate-middle-y px-5 text-white">
                            <h2 class="promo-title">{{ $promo->title }}</h2>
                            @if($promo->button_text && $promo->button_link)
                                <a href="{{ $promo->button_link }}" class="btn btn-outline-light bg-black promo-btn mt-3">{{ $promo->button_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination Dots -->
        <div class="swiper-pagination"></div>
    </div>
</section>


@push('scripts')
<script>
    // Image preview click
    $(document).on('click', '.img-preview .swiper-slide', function () {
        const imgSrc = $(this).find('div[style*="background"]').css('background-image')
            .replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
        $('#previewModalImg').attr('src', imgSrc);
        $('#imagePreviewModal').modal('show');
    });

    // Swiper initialization with arrows & dots
    var promoSwiper = new Swiper('.promo-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
@endpush
