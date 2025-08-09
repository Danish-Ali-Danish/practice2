<div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
    <div class="product-card text-center h-100 position-relative">
        <!-- Sale Badge -->
        @if($product->compare_price > $product->price)
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">Sale</span>
        @endif
        
        <!-- Wishlist Button -->
        <button class="btn-wishlist position-absolute top-0 end-0 m-2 bg-white rounded-circle p-2 border-0" 
                data-product-id="{{ $product->id }}">
            <i class="far fa-heart"></i>
        </button>

        <!-- Product Image -->
        <div class="product-image-container">
            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/no-image.png') }}"
                 data-image-preview="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/no-image.png') }}"
                 class="card-img-top"
                 alt="{{ $product->name }}"
                 loading="lazy">
        </div>

        <div class="card-body p-2">
            <!-- Product Name -->
            <h6 class="card-title mb-1 text-truncate">{{ $product->name }}</h6>
            
            <!-- Category -->
            <p class="small text-muted mb-1">
                {{ $product->Subcategory->name ?? 'Uncategorized' }}
            </p>

            <!-- Price -->
            <div class="price-container mb-2">
                @if($product->compare_price > $product->price)
                    <del class="small text-muted me-2">PKR {{ number_format($product->compare_price) }}</del>
                @endif
                <span class="fw-bold text-primary">PKR {{ number_format($product->price) }}</span>
            </div>

            <!-- Stock Indicator -->
            @if($product->stock <= 5)
                <div class="stock-indicator progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-warning" 
                         style="width: {{ ($product->stock / 5) * 100 }}%"
                         title="Only {{ $product->stock }} left!"></div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary flex-grow-1 quick-view-btn" 
                        data-product-id="{{ $product->id }}">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-primary add-to-cart-btn" 
                        data-product-id="{{ $product->id }}">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
</div>