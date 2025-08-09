<div class="col-lg-6">
                <div class="hero-image-wrapper position-relative rounded-4 overflow-hidden shadow-lg">
                    @isset($featuredProducts)
                        @if($featuredProducts->count())
                        <div class="swiper hero-swiper">
                            <div class="swiper-wrapper">
                                @foreach($featuredProducts as $product)
                                <div class="swiper-slide">
                                    <div class="position-relative" style="height: 500px;">
                                        <img src="{{ $product->main_image ? asset('storage/'.$product->main_image) : asset('images/default-product.png') }}" 
                                             alt="{{ $product->name }}"
                                             class="img-fluid h-100 w-100 object-fit-cover">
                                        <div class="hero-image-overlay"></div>
                                        <div class="product-info position-absolute bottom-0 start-0 p-4 text-white">
                                            <h5 class="fw-bold">{{ $product->name }}</h5>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rating me-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= ($product->rating ?? 0) ? 'text-warning' : 'text-white-50' }}"></i>
                                                    @endfor
                                                </div>
                                                <small>({{ $product->reviews_count ?? 0 }})</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h4 class="fw-bold mb-0 me-2">${{ number_format($product->price, 2) }}</h4>
                                                @if($product->compare_price > 0)
                                                    <small class="text-decoration-line-through opacity-75">${{ number_format($product->compare_price, 2) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        @else
                        <div class="placeholder-image d-flex align-items-center justify-content-center" style="height: 500px; background: rgba(255,255,255,0.1);">
                            <div class="text-center text-white p-4">
                                <i class="fas fa-box-open fa-4x mb-3 opacity-50"></i>
                                <h4>No Featured Products</h4>
                                <p class="mb-0">Check back later for featured items</p>
                            </div>
                        </div>
                        @endif
                    @else
                    <div class="placeholder-image d-flex align-items-center justify-content-center" style="height: 500px; background: rgba(255,255,255,0.1);">
                        <div class="text-center text-white p-4">
                            <i class="fas fa-cog fa-spin fa-4x mb-3"></i>
                            <h4>Loading Products...</h4>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>