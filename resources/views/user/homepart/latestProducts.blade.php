<section class="container py-5">
    <h2 class="fw-bold mb-4">New Arrivals Products</h2>
    <div class="row g-4">
        @forelse($products as $product)
            @include('user.homepart.product-card', ['product' => $product])
        @empty
            <div class="col-12 text-center text-muted">No products found.</div>
        @endforelse
    </div>
</section>

