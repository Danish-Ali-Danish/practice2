
<!-- Blog Preview -->
@if($blogPosts->count())
<section class="py-5  border-top">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Latest Blog Posts</h2>
        <div class="row g-4">
            @foreach($blogPosts as $post)
                <div class="col-md-4">
                    <div class="blog-card h-100 shadow border-0">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top  img-preview" alt="{{ $post->title }} "
                                style="height: 200px; object-fit: cover;" loading="lazy">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text text-muted small">{{ $post->created_at->format('M d, Y') }}</p>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-2">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
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
