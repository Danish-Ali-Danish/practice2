    <!-- Top Announcement Bar -->
    <div class="bg-indigo-900 text-white text-sm py-2 px-4 text-center">
        🎉 Free shipping on orders over $50 | Use code SHOPNOW10 for 10% off your first order 🎉
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-indigo-600 flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        ShopNow
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 mx-8">
                    <div class="relative w-full max-w-xl">
                        <input type="text" placeholder="Search for products..." 
                               class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Navigation Icons -->
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
                            <a href="{{ url('/orders') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
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
                <a href="{{ url('/wishlist') }}" class="relative text-gray-700 hover:text-red-600">
                    <i class="fas fa-heart text-lg"></i>
                    <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>

                <!-- Cart -->
                <a href="{{ url('/cart') }}" class="relative text-gray-700 hover:text-indigo-600">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span id="cart-count" class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </a>
                </div>
            </div>
        </div>

        <!-- Mobile Search (hidden on desktop) -->
        <div class="md:hidden px-4 pb-4">
            <div class="relative">
                <input type="text" placeholder="Search for products..." 
                       class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-white border-t border-gray-100">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-3">
                    <div class="flex items-center space-x-1">
                        <button class="md:hidden text-gray-700">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Home</a>
                        <div class="relative group">
                            <button class="flex items-center font-bold text-gray-800 hover:text-indigo-600 px-3 py-2 rounded-md">
                                <i class="fas fa-th-large mr-2"></i> Categories
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            
                            <!-- Mega Dropdown -->
                            <div class="absolute left-0 mt-2 w-[700px] bg-white rounded-lg shadow-xl z-50 hidden group-hover:block border border-gray-200">
                                <div class="p-4 grid grid-cols-4 gap-4">
                                    @foreach($categories as $category)
                                        <div class="mb-4">
                                            <h6 class="font-bold text-indigo-600 mb-2">{{ $category->name }}</h6>
                                            <ul class="space-y-1">
                                                @foreach($category->subcategories as $subcat)
                                                    <li>
                                                        <a href="{{ route('subcategory.products', $subcat->id) }}" 
                                                        class="block py-1 px-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 rounded transition-colors">
                                                            {{ $subcat->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Deals</a>
                        <a href="/allproducts" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Products</a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">New Arrivals</a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Trending</a>
                    </div>
                    <div class="hidden md:block">
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Track Order</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
