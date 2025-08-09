<!-- resources/views/components/hero-section.blade.php -->
<section class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Left Content -->
            <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Discover Amazing Products</h1>
                <p class="text-xl mb-8">Everything you need, all in one place. Shop the latest trends with exclusive discounts.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium text-center">Shop Now</a>
                    <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-indigo-600 px-6 py-3 rounded-full font-medium text-center">Explore Deals</a>
                </div>
                <div class="mt-8 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-300"></i>
                        <span>Free Shipping</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-300"></i>
                        <span>Secure Payments</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-300"></i>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
    
            <!-- Swiper Slider -->
            <div class="md:w-1/2" data-aos="fade-left">
                <div class="swiper hero-swiper rounded-xl overflow-hidden shadow-2xl relative">
                    <div class="swiper-wrapper">
                        @foreach($heroSlides as $slide)
                            <div class="swiper-slide relative">
                                <img src="{{ asset('storage/' . $slide->image) }}" 
                                     alt="{{ $slide->title }}" 
                                     class="w-full h-96 object-cover">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                                    <h3 class="text-2xl font-bold text-white">{{ $slide->title }}</h3>
                                    @if($slide->subtitle)
                                        <p class="text-white mb-3">{{ $slide->subtitle }}</p>
                                    @endif
                                    @if($slide->button_text && $slide->button_link)
                                        <a href="{{ $slide->button_link }}" class="inline-block bg-white text-indigo-600 px-4 py-2 rounded-full font-medium">
                                            {{ $slide->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
