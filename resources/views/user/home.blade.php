@extends('user.layouts.master')
@section('content')

@include('user.homepart.herosection')

  <div id="app" class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
<!-- Breadcrumbs -->
 <nav aria-label="breadcrumb" class="mb-8">
      <ol id="breadcrumb-container" class="flex items-center space-x-2 text-sm text-gray-500">
        <!-- Breadcrumbs will be injected here -->
      </ol>
    </nav>

    <main class="py-5">
      <!-- Category View -->
      <div id="category-view" class="view-container">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Shop by Category</h2>
        <div id="category-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <!-- Category cards will be injected here -->
        </div>
      </div>
      
      <!-- SubCategory View -->
      <div id="subcategory-view" class="view-container">
        <h2 id="subcategory-title" class="text-3xl font-bold text-gray-800 mb-8 text-center"></h2>
        <div id="subcategory-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <!-- SubCategory cards will be injected here -->
        </div>
      </div>
      
      <!-- Product View -->
      <div id="product-view" class="view-container">
        <div class="flex flex-col lg:flex-row gap-12">
          <!-- Sidebar -->
          <aside class="lg:w-1/4">
            <div class="lg:sticky lg:top-8 space-y-8">
              <!-- Brand Filter -->
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Brands</h3>
                <div id="brand-filters" class="space-y-2">
                  <!-- Brand checkboxes will be injected here -->
                </div>
              </div>

              <!-- Price Filter -->
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Price Range</h3>
                <div class="flex items-center space-x-2">
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-sm text-gray-500">$</span>
                    <input type="number" name="minPrice" id="min-price" value="0"
                      class="w-full pl-7 pr-2 py-2 text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Min" />
                  </div>
                  <span class="text-gray-400">-</span>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-sm text-gray-500">$</span>
                    <input type="number" name="maxPrice" id="max-price" value="10000"
                      class="w-full pl-7 pr-2 py-2 text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Max" />
                  </div>
                </div>
              </div>
            </div>
          </aside>

          <!-- Product Listing -->
          <div class="lg:w-3/4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
               <h2 id="product-list-title" class="text-2xl font-bold text-gray-800">Products</h2>
              <select id="sort-select"
                class="w-full md:w-auto text-sm border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="name_asc">Sort By: Name A-Z</option>
                <option value="name_desc">Sort By: Name Z-A</option>
                <option value="price_asc">Sort By: Price Low to High</option>
                <option value="price_desc">Sort By: Price High to Low</option>
              </select>
            </div>

            <!-- Product Grid -->
            <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
              <!-- Products will be injected here -->
            </div>
             <div id="loader" class="flex flex-col justify-center items-center h-96 hidden">
                  <div class="spinner"></div>
                  <span class="text-lg text-gray-600 mt-4">Loading Products...</span>
              </div>


            <!-- Pagination -->
            <nav id="pagination-container" class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 mt-8 pt-4">
              <!-- Pagination will be injected here -->
            </nav>
          </div>
        </div>
      </div>
    </main>
  </div>
      <!-- Flash Sale Section -->
    <section class="py-12 bg-indigo-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between mb-8" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Flash Sale</h2>
                    <p class="text-gray-600">Limited time offers. Don't miss out!</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex items-center bg-white rounded-full px-6 py-3 shadow-sm">
                        <span class="text-gray-700 mr-3">Ends in:</span>
                        <div class="deal-countdown flex items-center space-x-2">
                            <div class="bg-indigo-600 text-white rounded px-2 py-1 font-bold">12</div>
                            <span>:</span>
                            <div class="bg-indigo-600 text-white rounded px-2 py-1 font-bold">45</div>
                            <span>:</span>
                            <div class="bg-indigo-600 text-white rounded px-2 py-1 font-bold">30</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flash Sale Products -->
            <div class="swiper flash-sale-swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper pb-10">
                    <!-- Product 1 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80" 
                                     alt="Smart Watch" class="w-full h-48 object-cover">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">-30%</div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-1">Smart Watch Series 5</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-gray-500 text-xs ml-1">(142)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-600 font-bold">$199.99</span>
                                        <span class="text-gray-500 text-sm line-through ml-2">$249.99</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="Running Shoes" class="w-full h-48 object-cover">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">-25%</div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-1">Pro Running Shoes</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-xs ml-1">(89)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-600 font-bold">$74.99</span>
                                        <span class="text-gray-500 text-sm line-through ml-2">$99.99</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1099&q=80" 
                                     alt="Wireless Headphones" class="w-full h-48 object-cover">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">-40%</div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-1">Wireless Headphones</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-xs ml-1">(256)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-600 font-bold">$89.99</span>
                                        <span class="text-gray-500 text-sm line-through ml-2">$149.99</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1560343090-f0409e92791a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80" 
                                     alt="Blender" class="w-full h-48 object-cover">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">-35%</div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-1">Professional Blender</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-gray-500 text-xs ml-1">(67)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-600 font-bold">$129.99</span>
                                        <span class="text-gray-500 text-sm line-through ml-2">$199.99</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" 
                                     alt="Perfume" class="w-full h-48 object-cover">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">-20%</div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-1">Luxury Perfume</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-xs ml-1">(112)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-600 font-bold">$59.99</span>
                                        <span class="text-gray-500 text-sm line-through ml-2">$74.99</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Featured Products</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover our carefully curated selection of premium products</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
                <!-- Product 1 -->
                <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 relative">
                    <div class="p-4">
                        <div class="relative overflow-hidden rounded-lg mb-4 h-48">
                            <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=736&q=80" 
                                 alt="Smartphone" class="w-full h-full object-cover">
                            <div class="product-actions absolute left-0 right-0 -bottom-10 opacity-0 flex justify-center space-x-4 transition-all duration-300">
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-gray-800 font-medium hover:text-indigo-600">Premium Smartphone X</a>
                            <div class="flex items-center justify-center mt-2 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-500 text-xs ml-1">(342)</span>
                            </div>
                            <span class="text-indigo-600 font-bold">$899.99</span>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 relative">
                    <div class="p-4">
                        <div class="relative overflow-hidden rounded-lg mb-4 h-48">
                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80" 
                                 alt="Smart Watch" class="w-full h-full object-cover">
                            <div class="product-actions absolute left-0 right-0 -bottom-10 opacity-0 flex justify-center space-x-4 transition-all duration-300">
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-gray-800 font-medium hover:text-indigo-600">Smart Watch Series 5</a>
                            <div class="flex items-center justify-center mt-2 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-xs ml-1">(512)</span>
                            </div>
                            <span class="text-indigo-600 font-bold">$249.99</span>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 relative">
                    <div class="p-4">
                        <div class="relative overflow-hidden rounded-lg mb-4 h-48">
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1099&q=80" 
                                 alt="Headphones" class="w-full h-full object-cover">
                            <div class="product-actions absolute left-0 right-0 -bottom-10 opacity-0 flex justify-center space-x-4 transition-all duration-300">
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-gray-800 font-medium hover:text-indigo-600">Wireless Headphones Pro</a>
                            <div class="flex items-center justify-center mt-2 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-500 text-xs ml-1">(289)</span>
                            </div>
                            <span class="text-indigo-600 font-bold">$149.99</span>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 relative">
                    <div class="p-4">
                        <div class="relative overflow-hidden rounded-lg mb-4 h-48">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Running Shoes" class="w-full h-full object-cover">
                            <div class="product-actions absolute left-0 right-0 -bottom-10 opacity-0 flex justify-center space-x-4 transition-all duration-300">
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-indigo-600 hover:text-white">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-gray-800 font-medium hover:text-indigo-600">Ultra Running Shoes</a>
                            <div class="flex items-center justify-center mt-2 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-xs ml-1">(176)</span>
                            </div>
                            <span class="text-indigo-600 font-bold">$99.99</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full font-medium transition-colors">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Deal of the Day -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Deal of the Day</h2>
                    <p class="text-gray-600 mb-6">Don't miss this exclusive offer available for a limited time only!</p>
                    
                    <div class="bg-white rounded-xl shadow-md p-6 inline-block">
                        <div class="text-center mb-4">
                            <div class="text-5xl font-bold text-indigo-600 mb-2">$599</div>
                            <div class="text-gray-500 line-through">$799</div>
                        </div>
                        
                        <div class="flex justify-center mb-6">
                            <div class="text-center px-4">
                                <div class="text-2xl font-bold text-gray-800">12</div>
                                <div class="text-gray-500 text-sm">Hours</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-2xl font-bold text-gray-800">45</div>
                                <div class="text-gray-500 text-sm">Minutes</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-2xl font-bold text-gray-800">30</div>
                                <div class="text-gray-500 text-sm">Seconds</div>
                            </div>
                        </div>
                        
                        <a href="#" class="block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-3 px-6 rounded-full font-medium transition-colors">Shop Now</a>
                    </div>
                </div>
                
                <div class="md:w-1/2" data-aos="fade-left">
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Laptop" class="w-full h-96 object-cover">
                            <div class="absolute top-0 right-0 bg-red-600 text-white text-sm font-bold px-3 py-1 m-2 rounded-full">-25%</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Ultra Slim Laptop Pro</h3>
                            <p class="text-gray-600 mb-4">Powerful performance in a sleek design with 16GB RAM and 1TB SSD storage.</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-600 font-bold text-xl">$599.99</span>
                                    <span class="text-gray-500 text-sm line-through ml-2">$799.99</span>
                                </div>
                                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full transition-colors">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trending Now - Social Proof Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Trending Now</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Products loved by our community this week</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product with Social Proof -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 relative">
                <div class="p-4">
                    <div class="relative overflow-hidden rounded-lg mb-4 h-48">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1099&q=80" 
                             alt="Wireless Headphones" class="w-full h-full object-cover">
                        <div class="absolute top-2 right-2 bg-pink-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            <i class="fas fa-heart mr-1"></i> 1.2K
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="text-gray-800 font-medium hover:text-indigo-600">Pro Wireless Headphones</a>
                        <div class="flex flex-col items-center mt-3">
                            <div class="flex items-center bg-green-50 text-green-600 text-xs px-2 py-1 rounded-full mb-2">
                                <i class="fas fa-bolt mr-1"></i> 532 bought this week
                            </div>
                            <div class="text-indigo-600 font-bold">$129.99</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More products... -->
        </div>

        <div class="mt-10 text-center">
            <a href="#" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                View all trending products
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Limited Edition - Scarcity Section -->
<section class="py-12 bg-gradient-to-r from-purple-900 to-indigo-800 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
                <span class="bg-white text-purple-900 text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">EXCLUSIVE</span>
                <h2 class="text-3xl font-bold mb-4">Limited Edition Collection</h2>
                <p class="text-purple-200 mb-6">Only 23 items left at this price. Once they're gone, they're gone!</p>
                
                <div class="w-full bg-black bg-opacity-30 rounded-full h-4 mb-6">
                    <div class="bg-yellow-400 h-4 rounded-full" style="width: 35%"></div>
                </div>
                
                <div class="flex items-center space-x-6 mb-8">
                    <div>
                        <div class="text-2xl font-bold">23</div>
                        <div class="text-sm text-purple-300">Items Left</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">87%</div>
                        <div class="text-sm text-purple-300">Sold Out</div>
                    </div>
                </div>
                
                <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-purple-900 px-8 py-3 rounded-full font-bold transition-colors">
                    Shop The Collection
                </a>
            </div>
            
            <div class="md:w-1/2" data-aos="fade-left">
                <div class="swiper limited-edition-swiper">
                    <div class="swiper-wrapper">
                        <!-- Product 1 -->
                        <div class="swiper-slide">
                            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" 
                                         alt="Luxury Watch" class="w-full h-64 object-contain">
                                    <div class="absolute top-0 left-0 bg-black bg-opacity-70 text-yellow-400 text-xs font-bold px-2 py-1 rounded">
                                        LAST 5 ITEMS
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h3 class="font-bold text-lg">Golden Era Watch</h3>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-yellow-400 font-bold">$499.99</span>
                                        <span class="text-purple-300 text-sm line-through">$799.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- More products... -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop The Look - Inspirational Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Shop The Look</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Get inspired by our stylish collections</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Look 1 -->
            <div class="relative rounded-xl overflow-hidden shadow-lg group" data-aos="fade-up">
                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     alt="Summer Outfit" class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Summer Vibes Collection</h3>
                    <p class="mb-4">Complete your warm weather wardrobe</p>
                    <a href="#" class="inline-flex items-center font-medium">
                        Shop This Look
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <!-- Hotspots -->
                <button class="absolute top-1/4 left-1/4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-indigo-600 hover:text-white transition-all">
                    <span class="absolute -top-6 -left-6 bg-white text-gray-800 text-xs px-2 py-1 rounded whitespace-nowrap shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">Sunglasses $49</span>
                    <i class="fas fa-plus text-xs"></i>
                </button>
                <!-- More hotspots... -->
            </div>

            <!-- Look 2 -->
            <div class="relative rounded-xl overflow-hidden shadow-lg group" data-aos="fade-up" data-aos-delay="100">
                <img src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                     alt="Work From Home" class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Work From Home Essentials</h3>
                    <p class="mb-4">Comfort meets productivity</p>
                    <a href="#" class="inline-flex items-center font-medium">
                        Shop This Look
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <!-- Hotspots -->
                <button class="absolute top-1/3 left-1/3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-indigo-600 hover:text-white transition-all">
                    <span class="absolute -top-6 -left-6 bg-white text-gray-800 text-xs px-2 py-1 rounded whitespace-nowrap shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">Desk Lamp $89</span>
                    <i class="fas fa-plus text-xs"></i>
                </button>
                <!-- More hotspots... -->
            </div>
        </div>
    </div>
</section>

<!-- Illustrated Features -->
<section class="py-16 bg-gradient-to-r from-indigo-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Feature 1 -->
            <div class="flex flex-col items-center text-center">
                <svg class="w-20 h-20 mb-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Secure Payments</h3>
                <p class="text-gray-600 max-w-xs">Industry-standard 256-bit encryption keeps your transactions safe</p>
            </div>

            <!-- Feature 2 -->
            <div class="flex flex-col items-center text-center">
                <svg class="w-20 h-20 mb-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Fast Delivery</h3>
                <p class="text-gray-600 max-w-xs">Get your order in 2-3 business days with tracked shipping</p>
            </div>

            <!-- Feature 3 -->
            <div class="flex flex-col items-center text-center">
                <svg class="w-20 h-20 mb-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-3">24/7 Support</h3>
                <p class="text-gray-600 max-w-xs">Our team is always ready to help via chat, email or phone</p>
            </div>
        </div>
    </div>
</section>
    <!-- Testimonials -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">What Our Customers Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Trusted by thousands of happy customers worldwide</p>
            </div>

            <div class="swiper testimonials-swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper pb-10">
                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-xl p-8 h-full">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">"I've been shopping with ShopNow for years and they never disappoint. Fast shipping, great prices, and excellent customer service!"</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah J." class="w-12 h-12 rounded-full object-cover mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">Sarah J.</h4>
                                    <p class="text-gray-500 text-sm">Verified Buyer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-xl p-8 h-full">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">"The quality of products is always top-notch. I recently bought a smartwatch and it exceeded my expectations. Will definitely shop again!"</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael T." class="w-12 h-12 rounded-full object-cover mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">Michael T.</h4>
                                    <p class="text-gray-500 text-sm">Verified Buyer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-xl p-8 h-full">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">"Excellent shopping experience. The website is easy to navigate and the checkout process was smooth. My order arrived earlier than expected."</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily R." class="w-12 h-12 rounded-full object-cover mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">Emily R.</h4>
                                    <p class="text-gray-500 text-sm">Verified Buyer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-xl p-8 h-full">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">"I love the variety of products available. From electronics to home essentials, ShopNow has everything I need in one place."</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="David K." class="w-12 h-12 rounded-full object-cover mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">David K.</h4>
                                    <p class="text-gray-500 text-sm">Verified Buyer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Trusted Brands</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We partner with the best brands to bring you quality products</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/samsung.com" alt="Samsung" class="h-8 object-contain">
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/apple.com" alt="Apple" class="h-8 object-contain">
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/sony.com" alt="Sony" class="h-8 object-contain">
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/nike.com" alt="Nike" class="h-8 object-contain">
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/adidas.com" alt="Adidas" class="h-8 object-contain">
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://logo.clearbit.com/lg.com" alt="LG" class="h-8 object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-12 bg-indigo-600 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
                    <h2 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h2>
                    <p class="text-indigo-100">Get the latest updates on new products, upcoming sales, and exclusive offers.</p>
                </div>
                <div class="md:w-1/2" data-aos="fade-left">
                    <form class="flex flex-col sm:flex-row gap-4">
                        <input type="email" placeholder="Your email address" 
                               class="flex-grow px-4 py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-300 text-gray-800">
                        <button type="submit" class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium whitespace-nowrap">Subscribe</button>
                    </form>
                    <p class="text-indigo-100 text-sm mt-2">We respect your privacy. Unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-indigo-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobileMenu" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden">
        <div class="bg-white h-full w-4/5 max-w-sm p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <a href="#" class="text-xl font-bold text-indigo-600 flex items-center">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    ShopNow
                </a>
                <button id="closeMobileMenu" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="mb-8">
                <div class="relative">
                    <input type="text" placeholder="Search for products..." 
                           class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <nav class="space-y-4">
                <a href="#" class="block py-2 text-gray-800 hover:text-indigo-600 font-medium">Home</a>
                <div class="relative">
                    <button class="flex items-center justify-between w-full py-2 text-gray-800 hover:text-indigo-600 font-medium">
                        Categories <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div class="pl-4 mt-2 space-y-3 hidden">
                        <a href="#" class="block py-1 text-gray-600 hover:text-indigo-600">Electronics</a>
                        <a href="#" class="block py-1 text-gray-600 hover:text-indigo-600">Fashion</a>
                        <a href="#" class="block py-1 text-gray-600 hover:text-indigo-600">Home & Kitchen</a>
                        <a href="#" class="block py-1 text-gray-600 hover:text-indigo-600">Beauty</a>
                        <a href="#" class="block py-1 text-gray-600 hover:text-indigo-600">Groceries</a>
                    </div>
                </div>
                <a href="#" class="block py-2 text-gray-800 hover:text-indigo-600 font-medium">Deals</a>
                <a href="#" class="block py-2 text-gray-800 hover:text-indigo-600 font-medium">New Arrivals</a>
                <a href="#" class="block py-2 text-gray-800 hover:text-indigo-600 font-medium">Trending</a>
                <a href="#" class="block py-2 text-gray-800 hover:text-indigo-600 font-medium">Track Order</a>
            </nav>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 relative">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection