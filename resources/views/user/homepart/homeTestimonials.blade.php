

@if($testimonials->count())
<section class="py-5 ">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">What Our Customers Say</h2>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($testimonials as $index => $testimonial)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="testimonial-swiper card shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                            class="rounded-circle mb-4 img-preview" width="100" height="100"
                                            style="object-fit: cover;" alt="Customer photo">
                                        <p class="fs-5 fst-italic">"{{ $testimonial->message }}"</p>
                                        <h5 class="fw-bold mt-3">{{ $testimonial->name }}</h5>
                                        <small class="text-muted">{{ $testimonial->designation }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

@endif

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0 text-center">
        <img id="previewModalImg" src="" alt="Preview" class="img-fluid rounded" />
      </div>
    </div>
  </div>
</div>
@push(section: 'scripts')
<script>
    $(document).on('click', '.img-preview', function () {
        const imgSrc = $(this).attr('src');
        $('#previewModalImg').attr('src', imgSrc);
        $('#imagePreviewModal').modal('show');
    });
</script>
@endpush

@push('scripts')
<script>
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