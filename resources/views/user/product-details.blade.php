<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details | StoreHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .product-gallery-image { transition: transform 0.3s ease; }
        .product-gallery-image:hover { transform: scale(1.05); }
        .thumbnail { transition: all 0.2s ease; }
        .thumbnail:hover { border-color: #2563eb; }
        .thumbnail.active { border-color: #2563eb; border-width: 2px; }
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.5s ease; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center">
                    <a href="index.html" class="text-2xl font-bold text-indigo-600 flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        ShopNow
                    </a>
                </div>

                <div class="hidden md:flex flex-1 mx-8">
                    <div class="relative w-full max-w-xl">
                        <input type="text" placeholder="Search for products..." 
                               class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="relative group">
                        <button class="flex items-center text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-user-circle mr-2"></i> Account
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden group-hover:block border border-gray-200">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
                                    <i class="fas fa-box mr-2"></i> Orders
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="wishlist.html" class="relative text-gray-700 hover:text-red-600">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    <a href="cart.html" class="relative text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Search -->
        <div class="md:hidden px-4 pb-4">
            <div class="relative">
                <input type="text" placeholder="Search for products..." 
                       class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Breadcrumbs -->
        <nav class="bg-gray-100 border-t border-gray-200 py-3">
            <div class="container mx-auto px-4">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="index.html" class="text-indigo-600 hover:text-indigo-800">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li><a href="category.html" class="text-indigo-600 hover:text-indigo-800">Electronics</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li><a href="subcategory.html" class="text-indigo-600 hover:text-indigo-800">Laptops</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">QuantumBook Pro 14"</li>
                </ol>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Product Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="relative mb-4 rounded-lg overflow-hidden bg-gray-100" style="padding-bottom: 75%;">
                        <img id="mainImage" src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                             alt="QuantumBook Pro 14" class="absolute h-full w-full object-contain product-gallery-image">
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <button class="thumbnail active" data-image="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                            <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=400" 
                                 alt="Thumbnail 1" class="h-20 w-full object-cover rounded border-2 border-indigo-500">
                        </button>
                        <button class="thumbnail" data-image="https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                            <img src="https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=400" 
                                 alt="Thumbnail 2" class="h-20 w-full object-cover rounded border border-gray-200">
                        </button>
                        <button class="thumbnail" data-image="https://images.pexels.com/photos/303383/pexels-photo-303383.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                            <img src="https://images.pexels.com/photos/303383/pexels-photo-303383.jpeg?auto=compress&cs=tinysrgb&w=400" 
                                 alt="Thumbnail 3" class="h-20 w-full object-cover rounded border border-gray-200">
                        </button>
                        <button class="thumbnail" data-image="https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                            <img src="https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg?auto=compress&cs=tinysrgb&w=400" 
                                 alt="Thumbnail 4" class="h-20 w-full object-cover rounded border border-gray-200">
                        </button>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">QuantumBook Pro 14"</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600 text-sm">(980 reviews)</span>
                        <span class="mx-2 text-gray-400">|</span>
                        <span class="text-green-600 text-sm font-medium">In Stock</span>
                    </div>

                    <div class="mb-6">
                        <span class="text-3xl font-bold text-gray-900">$1,499.00</span>
                        <span class="ml-2 text-xl text-gray-500 line-through">$1,799.00</span>
                        <span class="ml-2 bg-red-100 text-red-800 text-sm font-semibold px-2 py-1 rounded">17% OFF</span>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-700 mb-4">Ultimate performance for professionals on the go. The QuantumBook Pro 14" features a stunning Retina display, powerful M2 chip, and all-day battery life in a compact design.</p>
                        
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">14.2-inch Liquid Retina XDR display</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">M2 chip with 8-core CPU, 10-core GPU</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">16GB unified memory</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">1TB SSD storage</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-gray-700">Up to 17 hours battery life</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center mb-3">
                            <span class="text-gray-700 font-medium mr-3">Color:</span>
                            <div class="flex space-x-2">
                                <button class="w-8 h-8 rounded-full bg-gray-800 border-2 border-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"></button>
                                <button class="w-8 h-8 rounded-full bg-gray-200 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"></button>
                                <button class="w-8 h-8 rounded-full bg-blue-500 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"></button>
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <span class="text-gray-700 font-medium mr-3">Storage:</span>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-indigo-50 hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">256GB</button>
                                <button class="px-3 py-1 border border-indigo-500 bg-indigo-50 rounded-md text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">512GB</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-indigo-50 hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">1TB</button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <button class="px-3 py-2 text-gray-600 hover:text-indigo-600 focus:outline-none">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="px-4 py-1 text-gray-900">1</span>
                                <button class="px-3 py-2 text-gray-600 hover:text-indigo-600 focus:outline-none">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md font-medium transition-colors">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                            </button>
                            <button class="p-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-heart text-red-500"></i>
                            </button>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-truck mr-2"></i>
                            <span>Free shipping on orders over $50</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mt-2">
                            <i class="fas fa-undo mr-2"></i>
                            <span>30-day return policy</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="border-t border-gray-200">
                <div class="flex overflow-x-auto">
                    <button class="tab-button active px-6 py-4 font-medium text-indigo-600 border-b-2 border-indigo-600 whitespace-nowrap" data-tab="description">
                        Description
                    </button>
                    <button class="tab-button px-6 py-4 font-medium text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="specifications">
                        Specifications
                    </button>
                    <button class="tab-button px-6 py-4 font-medium text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="reviews">
                        Reviews (980)
                    </button>
                    <button class="tab-button px-6 py-4 font-medium text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="shipping">
                        Shipping & Returns
                    </button>
                </div>

                <div class="p-6">
                    <div id="description" class="tab-content active">
                        <h3 class="text-xl font-semibold mb-4">Product Description</h3>
                        <p class="text-gray-700 mb-4">The QuantumBook Pro 14" redefines what a professional laptop can be. With its stunning 14.2-inch Liquid Retina XDR display, the most advanced M2 chip, and a compact design that travels anywhere, it's the ultimate tool for creative professionals and power users.</p>
                        <p class="text-gray-700 mb-4">Experience incredible performance with the 8-core CPU and 10-core GPU that handles demanding workflows effortlessly. The 16GB of unified memory keeps everything fast and fluid, while the 1TB SSD provides ample storage for large projects.</p>
                        <p class="text-gray-700">With up to 17 hours of battery life, you can work all day without needing to recharge. The advanced thermal system sustains breakthrough performance, while the six-speaker sound system with force-cancelling woofers delivers immersive audio.</p>
                    </div>

                    <div id="specifications" class="tab-content">
                        <h3 class="text-xl font-semibold mb-4">Technical Specifications</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Display</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>14.2-inch Liquid Retina XDR display</li>
                                    <li>3024×1964 native resolution at 254 pixels per inch</li>
                                    <li>XDR (Extreme Dynamic Range)</li>
                                    <li>1,000,000:1 contrast ratio</li>
                                    <li>ProMotion technology with adaptive refresh rates up to 120Hz</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Processor</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>M2 chip</li>
                                    <li>8-core CPU with 4 performance cores and 4 efficiency cores</li>
                                    <li>10-core GPU</li>
                                    <li>16-core Neural Engine</li>
                                    <li>100GB/s memory bandwidth</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Memory & Storage</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>16GB unified memory</li>
                                    <li>1TB SSD storage</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Battery & Power</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>Up to 17 hours wireless web</li>
                                    <li>Up to 21 hours movie playback</li>
                                    <li>70-watt-hour lithium-polymer battery</li>
                                    <li>96W USB-C Power Adapter</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="reviews" class="tab-content">
                        <h3 class="text-xl font-semibold mb-4">Customer Reviews</h3>
                        <div class="flex items-center mb-6">
                            <div class="mr-4">
                                <span class="text-4xl font-bold">4.8</span>
                                <span class="text-gray-500">/5</span>
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <span class="w-12 text-sm text-gray-600">5 stars</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mx-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">832</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <span class="w-12 text-sm text-gray-600">4 stars</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mx-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 10%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">98</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <span class="w-12 text-sm text-gray-600">3 stars</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mx-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 3%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">29</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <span class="w-12 text-sm text-gray-600">2 stars</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mx-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">10</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-12 text-sm text-gray-600">1 star</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-2 mx-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">11</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-600 text-sm">John D. - Verified Buyer</span>
                                </div>
                                <h4 class="font-medium text-gray-900 mb-1">Perfect for creative work</h4>
                                <p class="text-gray-700 mb-2">This laptop handles everything I throw at it - 4K video editing, 3D rendering, and graphic design work. The display is absolutely stunning and the performance is incredible.</p>
                                <span class="text-gray-500 text-sm">Posted on October 15, 2023</span>
                            </div>

                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-gray-600 text-sm">Sarah M. - Verified Buyer</span>
                                </div>
                                <h4 class="font-medium text-gray-900 mb-1">Almost perfect</h4>
                                <p class="text-gray-700 mb-2">Love everything about this laptop - the design, performance, and battery life are all excellent. My only minor complaint is that it can get warm under heavy load, but that's expected with this much power in a small package.</p>
                                <span class="text-gray-500 text-sm">Posted on September 28, 2023</span>
                            </div>

                            <button class="mt-4 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50">
                                See all 980 reviews
                            </button>
                        </div>
                    </div>

                    <div id="shipping" class="tab-content">
                        <h3 class="text-xl font-semibold mb-4">Shipping & Returns</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Shipping Information</h4>
                                <ul class="text-gray-700 space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-truck text-indigo-500 mt-1 mr-2"></i>
                                        <span>Free standard shipping on all orders over $50</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-clock text-indigo-500 mt-1 mr-2"></i>
                                        <span>Processing time: 1-2 business days</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-box-open text-indigo-500 mt-1 mr-2"></i>
                                        <span>Estimated delivery: 3-5 business days</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-globe text-indigo-500 mt-1 mr-2"></i>
                                        <span>International shipping available to select countries</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Return Policy</h4>
                                <ul class="text-gray-700 space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-undo text-indigo-500 mt-1 mr-2"></i>
                                        <span>30-day return policy for unused items in original packaging</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-exchange-alt text-indigo-500 mt-1 mr-2"></i>
                                        <span>Free return shipping for defective items</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-credit-card text-indigo-500 mt-1 mr-2"></i>
                                        <span>Refunds processed within 5 business days of return receipt</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-indigo-500 mt-1 mr-2"></i>
                                        <span>Some exclusions apply (see full policy for details)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">You May Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative h-48 bg-gray-100">
                        <img src="https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=400" 
                             alt="Stellara Vision 27" class="h-full w-full object-contain">
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">Stellara Vision 27" 4K</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-sm">(750 reviews)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-900">$699.00</span>
                            <button class="text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative h-48 bg-gray-100">
                        <img src="https://images.pexels.com/photos/3825586/pexels-photo-3825586.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="EchoWave Buds Pro" class="h-full w-full object-contain">
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">EchoWave Buds Pro</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm">(3100 reviews)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-900">$179.00</span>
                            <button class="text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative h-48 bg-gray-100">
                        <img src="https://images.pexels.com/photos/2115257/pexels-photo-2115257.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="ByteWorks Mechanical Pro" class="h-full w-full object-contain">
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">ByteWorks Mechanical Pro</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm">(880 reviews)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-900">$119.00</span>
                            <span class="text-sm text-gray-500 line-through">$149.00</span>
                            <button class="text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative h-48 bg-gray-100">
                        <img src="https://images.pexels.com/photos/1092644/pexels-photo-1092644.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="Stellara Galaxy S23" class="h-full w-full object-contain">
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">Stellara Galaxy S23</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-sm">(1500 reviews)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-900">$899.00</span>
                            <button class="text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">ShopNow</h3>
                    <p class="text-gray-400 mb-4">Your one-stop shop for all the latest tech gadgets and accessories.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Shop</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">All Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Featured</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">New Arrivals</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sale Items</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Gift Cards</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Customer Service</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQs</a></li>
                        <li><                        <li><a href="#" class="text-gray-400 hover:text-white">Shipping Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Returns & Exchanges</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Order Tracking</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">About</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Our Story</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 ShopNow. All rights reserved.</p>
                <div class="flex space-x-6">
                    <img src="https://via.placeholder.com/40x25" alt="Visa" class="h-6">
                    <img src="https://via.placeholder.com/40x25" alt="Mastercard" class="h-6">
                    <img src="https://via.placeholder.com/40x25" alt="American Express" class="h-6">
                    <img src="https://via.placeholder.com/40x25" alt="PayPal" class="h-6">
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Product Gallery Image Switching
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Remove active class from all thumbnails
                document.querySelectorAll('.thumbnail').forEach(t => {
                    t.classList.remove('active');
                    t.querySelector('img').classList.remove('border-indigo-500', 'border-2');
                    t.querySelector('img').classList.add('border-gray-200', 'border');
                });
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
                this.querySelector('img').classList.remove('border-gray-200', 'border');
                this.querySelector('img').classList.add('border-indigo-500', 'border-2');
                
                // Change main image
                const newImage = this.getAttribute('data-image');
                document.getElementById('mainImage').src = newImage;
            });
        });

        // Product Tabs
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and content
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active', 'text-indigo-600', 'border-indigo-600');
                    btn.classList.add('text-gray-500', 'hover:text-gray-700');
                });
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active', 'text-indigo-600', 'border-indigo-600');
                this.classList.remove('text-gray-500', 'hover:text-gray-700');
                
                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Quantity Selector
        const minusBtn = document.querySelector('.quantity-selector button:first-child');
        const plusBtn = document.querySelector('.quantity-selector button:last-child');
        const quantityDisplay = document.querySelector('.quantity-selector span');
        
        minusBtn.addEventListener('click', function() {
            let quantity = parseInt(quantityDisplay.textContent);
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            let quantity = parseInt(quantityDisplay.textContent);
            quantity++;
            quantityDisplay.textContent = quantity;
        });
    </script>
</body>
</html>