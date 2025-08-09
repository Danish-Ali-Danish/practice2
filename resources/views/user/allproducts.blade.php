<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - Product Showcase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    @import url('https://rsms.me/inter/inter.css');

html {
  font-family: 'Inter', sans-serif;
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

.product-card { 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    animation: scaleIn 0.3s ease-out; 
}
.product-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); 
}
.product-image { 
    transition: transform 0.5s ease; 
}
.product-card:hover .product-image { 
    transform: scale(1.1); 
}
.filter-section { 
    border-bottom: 1px solid #e5e7eb; 
    padding-bottom: 1.5rem; 
    padding-top: 1.5rem; 
}
.filter-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.filter-sidebar { 
    transition: transform 0.3s ease-in-out; 
}
.overlay { 
    transition: opacity 0.3s ease-in-out; 
}
.accent-blue-600 { 
    accent-color: #2563eb; 
}

/* Mobile Menu Panel Animation */
#mobileMenuPanel {
    transition: transform 0.3s ease-in-out;
}
#mobile-categories-toggle i {
    transition: transform 0.2s ease-in-out;
}
#mobile-categories-toggle.open i {
    transform: rotate(180deg);
}

/* Product Detail Modal */
.product-detail-modal {
    transition: all 0.3s ease-out;
}
.product-detail-modal-overlay {
    background-color: rgba(0, 0, 0, 0.7);
    transition: opacity 0.3s ease;
}
.product-detail-modal-content {
    max-height: 90vh;
    overflow-y: auto;
}
.product-gallery-thumbnail {
    transition: all 0.2s ease;
    border: 2px solid transparent;
}
.product-gallery-thumbnail:hover, .product-gallery-thumbnail.active {
    border-color: #2563eb;
}
.product-tabs-content {
    display: none;
}
.product-tabs-content.active {
    display: block;
    animation: fadeIn 0.3s ease-out;
}
.product-tab-button {
    transition: all 0.2s ease;
}
.product-tab-button.active {
    border-bottom: 2px solid #2563eb;
    color: #2563eb;
    font-weight: 600;
}
.sticky-add-to-cart {
    transition: all 0.3s ease;
    box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
}

</style>    
<script type="importmap">
{
  "imports": {
    "react": "https://esm.sh/react@^19.1.1",
    "react/": "https://esm.sh/react@^19.1.1/"
  }
}
</script>
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <!-- Main header bar -->
            <div class="flex items-center justify-between py-4">
                <!-- Logo and mobile menu toggle -->
                <div class="flex items-center">
                    <button id="mobileMenuBtn" aria-label="Open menu" class="md:hidden mr-4 text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="#" class="text-2xl font-bold text-indigo-600 flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        ShopNow
                    </a>
                </div>

                <!-- Desktop Search Bar -->
                <div class="hidden md:flex flex-1 mx-8">
                    <div class="relative w-full max-w-xl">
                        <input type="text" id="searchInput" placeholder="Search for products..." 
                               class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600" aria-label="Search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Navigation Icons -->
                <div class="flex items-center space-x-4 sm:space-x-6">
                    <div class="relative group hidden sm:block">
                        <button class="flex items-center text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-user-circle text-lg"></i>
                            <span class="hidden lg:inline ml-2">Account</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden group-hover:block border border-gray-200">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700"><i class="fas fa-user mr-2"></i> Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700"><i class="fas fa-box mr-2"></i> Orders</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700"><i class="fas fa-cog mr-2"></i> Settings</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="relative text-gray-700 hover:text-red-600" aria-label="Wishlist">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-indigo-600" aria-label="Shopping Cart">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span id="cart-count" class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="md:hidden px-4 pb-4">
                 <div class="relative w-full">
                    <input type="text" id="mobileSearchInput" placeholder="Search for products..." 
                           class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Desktop Navigation -->
        <nav class="bg-white border-t border-gray-200 hidden md:block">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center space-x-4">
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Home</a>
                        <div class="relative group">
                            <button class="flex items-center font-medium text-gray-800 hover:text-indigo-600 px-3 py-2 rounded-md">
                                <i class="fas fa-th-large mr-2"></i> Categories
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <div class="absolute left-0 mt-2 w-[700px] bg-white rounded-lg shadow-xl z-50 hidden group-hover:block border border-gray-200">
                               <div id="mega-menu-content" class="p-6 grid grid-cols-4 gap-6">
                                   <div class="text-center py-8 text-gray-500">Loading categories...</div>
                               </div>
                            </div>
                        </div>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Deals</a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">New Arrivals</a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">Trending</a>
                    </div>
                    <div>
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Track Order</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-[60] flex md:hidden hidden">
        <!-- Overlay -->
        <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50"></div>
        <!-- Menu Panel -->
        <div id="mobileMenuPanel" class="relative w-72 max-w-xs bg-white h-full p-4 overflow-y-auto shadow-xl transform -translate-x-full">
            <div class="flex justify-between items-center mb-8">
                 <a href="#" class="text-xl font-bold text-indigo-600 flex items-center">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    <span>ShopNow</span>
                </a>
                <button id="closeMobileMenuBtn" aria-label="Close menu" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">Home</a>
                 <div>
                     <button id="mobile-categories-toggle" class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">
                        <span>Categories</span>
                        <i class="fas fa-chevron-down text-sm transition-transform"></i>
                     </button>
                     <div id="mobile-categories-list" class="hidden pl-4 mt-1 space-y-1 border-l-2 ml-3">
                        <div class="py-2 text-gray-500">Loading...</div>
                     </div>
                 </div>
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">Deals</a>
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">New Arrivals</a>
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">Trending</a>
                 <div class="border-t border-gray-200 my-4"></div>
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md"><i class="fas fa-user-circle mr-2"></i> Account</a>
                 <a href="#" class="px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md">Track Order</a>
            </nav>
        </div>
    </div>

    <!-- Product Detail Modal -->
    <div id="productDetailModal" class="fixed inset-0 z-[100] hidden">
        <div id="productDetailModalOverlay" class="fixed inset-0 bg-black bg-opacity-70 product-detail-modal-overlay"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-full p-4">
                <div id="productDetailModalContent" class="bg-white rounded-xl shadow-2xl w-full max-w-6xl relative product-detail-modal-content">
                    <button id="closeProductDetailModal" class="absolute top-4 right-4 z-10 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                        <i class="fas fa-times text-gray-600"></i>
                    </button>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                        <!-- Product Gallery -->
                        <div class="product-gallery">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 h-96 mb-4">
                                <img id="mainProductImage" src="" alt="" class="w-full h-full object-contain transition-opacity duration-300">
                            </div>
                            <div id="productThumbnails" class="grid grid-cols-4 gap-3">
                                <!-- Thumbnails will be populated by JS -->
                            </div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="product-info">
                            <div class="sticky top-4">
                                <div class="mb-4">
                                    <span id="productBrand" class="text-sm font-medium text-indigo-600"></span>
                                    <h1 id="productTitle" class="text-3xl font-bold text-gray-900 mt-1"></h1>
                                    <div class="flex items-center mt-2">
                                        <div id="productRating" class="flex items-center">
                                            <!-- Stars will be populated by JS -->
                                        </div>
                                        <a href="#reviews" class="ml-2 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            <span id="productReviewCount"></span> reviews
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <div class="flex items-baseline space-x-3">
                                        <p id="productPrice" class="text-3xl font-bold text-gray-900"></p>
                                        <p id="productOriginalPrice" class="text-xl text-gray-500 line-through hidden"></p>
                                        <span id="productDiscountBadge" class="bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded hidden"></span>
                                    </div>
                                    <p id="productAvailability" class="mt-2 text-sm text-green-600 flex items-center">
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                        <span>In stock and ready to ship</span>
                                    </p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-sm font-medium text-gray-900">Description</h3>
                                    <p id="productDescription" class="mt-2 text-gray-600"></p>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-6 mb-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center">
                                            <button id="decrementQuantity" class="p-2 text-gray-600 hover:text-indigo-600">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input id="productQuantity" type="number" min="1" value="1" class="w-16 text-center border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 rounded-md mx-2">
                                            <button id="incrementQuantity" class="p-2 text-gray-600 hover:text-indigo-600">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <button id="addToCartDetail" class="flex-1 bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                            Add to Cart
                                        </button>
                                        <button id="addToWishlistDetail" class="p-3 text-gray-400 hover:text-red-500 rounded-full border border-gray-300 hover:border-red-300">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-6">
                                    <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
                                    <ul id="productHighlights" class="mt-2 space-y-2">
                                        <!-- Highlights will be populated by JS -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Tabs -->
                    <div class="border-t border-gray-200 px-6 pt-6 pb-12">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8">
                                <button data-tab="details" class="product-tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Product Details
                                </button>
                                <button data-tab="specs" class="product-tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Specifications
                                </button>
                                <button data-tab="reviews" class="product-tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Reviews
                                </button>
                                <button data-tab="shipping" class="product-tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Shipping & Returns
                                </button>
                            </nav>
                        </div>
                        
                        <div class="mt-6">
                            <div id="tab-details" class="product-tabs-content active">
                                <div id="productFullDescription" class="prose max-w-none">
                                    <!-- Full description will be populated by JS -->
                                </div>
                            </div>
                            
                            <div id="tab-specs" class="product-tabs-content">
                                <div class="overflow-hidden">
                                    <table id="productSpecs" class="min-w-full divide-y divide-gray-300">
                                        <tbody class="divide-y divide-gray-200">
                                            <!-- Specifications will be populated by JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div id="tab-reviews" class="product-tabs-content">
                                <div class="space-y-8">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            <div id="reviewSummaryStars" class="flex">
                                                <!-- Stars will be populated by JS -->
                                            </div>
                                            <p class="ml-2 text-sm text-gray-500">
                                                Based on <span id="reviewSummaryCount" class="font-medium text-gray-900"></span> reviews
                                            </p>
                                        </div>
                                        <button id="writeReviewBtn" class="ml-auto bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 text-sm font-medium">
                                            Write a review
                                        </button>
                                    </div>
                                    
                                    <div id="reviewList" class="space-y-8">
                                        <!-- Reviews will be populated by JS -->
                                    </div>
                                </div>
                            </div>
                            
                            <div id="tab-shipping" class="product-tabs-content">
                                <div class="prose max-w-none">
                                    <h3>Shipping Information</h3>
                                    <p>We offer free standard shipping on all orders over $50. Orders are typically processed within 1-2 business days and shipped via UPS or USPS. Delivery times vary by location but generally take 3-5 business days.</p>
                                    
                                    <h3 class="mt-6">Returns Policy</h3>
                                    <p>We accept returns within 30 days of purchase for a full refund. Items must be in original condition with all tags attached. To initiate a return, please contact our customer service team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Add to Cart (Mobile) -->
    <div id="stickyAddToCart" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg py-3 px-4 hidden md:hidden sticky-add-to-cart">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total</p>
                <p id="stickyProductPrice" class="text-lg font-bold text-gray-900"></p>
            </div>
            <button id="stickyAddToCartBtn" class="bg-indigo-600 text-white py-2 px-6 rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                Add to Cart
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-12" style="animation: fadeIn 0.8s ease-out;">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Discover Your Next Favorite Thing</h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">A unique collection of products, curated just for you.</p>
        </div>

        <div class="lg:grid lg:grid-cols-4 lg:gap-x-8 lg:items-start">
            <!-- Desktop & Mobile Sidebar Container -->
            <aside id="filterSidebar" class="fixed inset-y-0 left-0 w-72 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:static lg:transform-none lg:w-auto lg:col-span-1 lg:block lg:h-full z-50 filter-sidebar lg:bg-transparent lg:shadow-none">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between p-4 border-b lg:border-none">
                         <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-filter w-5 h-5 mr-2"></i>
                            Filters
                        </h2>
                        <button id="closeSidebar" aria-label="Close filters" class="p-2 hover:bg-gray-100 rounded-full lg:hidden">
                            <i class="fas fa-times w-6 h-6"></i>
                        </button>
                    </div>

                    <div class="flex-grow overflow-y-auto p-4 lg:p-6 lg:bg-white lg:rounded-xl lg:shadow-lg">
                        <button id="clearFilters" class="w-full mb-4 py-2 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-sm font-medium">Clear All Filters</button>
                        
                        <div id="filtersContainer">
                            <!-- Filters will be populated here by JS -->
                        </div>
                    </div>
                </div>
            </aside>
            <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden overlay"></div>

            <!-- Product Grid -->
            <div class="mt-6 lg:mt-0 lg:col-span-3">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-sm">
                     <div class="flex items-center mb-2 sm:mb-0">
                        <p class="text-sm text-gray-600">
                            Showing <span id="resultsCount" class="font-bold text-gray-900">0</span> results
                        </p>
                         <button id="filterBtn" class="lg:hidden flex items-center space-x-2 px-3 py-1.5 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 ml-4">
                            <i class="fas fa-filter w-4 h-4"></i>
                            <span class="text-sm font-medium">Filters</span>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <label for="sort-by" class="mr-2 text-sm font-medium text-gray-700">Sort by</label>
                        <select id="sort-by" name="sort-by" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="featured">Featured</option>
                            <option value="rating">Highest Rated</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div id="productsGrid" class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    <!-- Products will be populated here by JS -->
                </div>

                <div id="noResults" class="text-center py-16 hidden">
                    <i class="fas fa-search-minus mx-auto h-16 w-16 text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Products Found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your filters to see more results.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
*/

document.addEventListener('DOMContentLoaded', () => {

// --- DATA ---
const catalog = {
    categories: [
        { id: 'cat-1', name: 'Computing' },
        { id: 'cat-2', name: 'Mobile Devices' },
        { id: 'cat-3', name: 'Audio' },
        { id: 'cat-4', name: 'Accessories' }
    ],
    subcategories: [
        { id: 'sub-1', name: 'Laptops', categoryId: 'cat-1' },
        { id: 'sub-2', name: 'Desktops', categoryId: 'cat-1' },
        { id: 'sub-3', name: 'Monitors', categoryId: 'cat-1' },
        { id: 'sub-4', name: 'Smartphones', categoryId: 'cat-2' },
        { id: 'sub-5', name: 'Tablets', categoryId: 'cat-2' },
        { id: 'sub-6', name: 'Headphones', categoryId: 'cat-3' },
        { id: 'sub-7', name: 'Speakers', categoryId: 'cat-3' },
        { id: 'sub-8', name: 'Keyboards', categoryId: 'cat-4' },
        { id: 'sub-9', name: 'Mice', categoryId: 'cat-4' },
    ],
    brands: [
        { id: 'brand-1', name: 'TechNova' },
        { id: 'brand-2', name: 'Stellara' },
        { id: 'brand-3', name: 'ByteWorks' },
        { id: 'brand-4', name: 'EchoWave' },
        { id: 'brand-5', name: 'Aether Systems' },
    ],
    products: [
        { 
            id: 'p-1', 
            name: 'QuantumBook Pro 14"', 
            price: 1499, 
            brandId: 'brand-1', 
            subcategoryId: 'sub-1', 
            rating: 4.8, 
            reviews: 980, 
            description: "Ultimate performance for professionals on the go.", 
            originalPrice: 1799, 
            imageUrl: 'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=400',
            images: [
                'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/303383/pexels-photo-303383.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1181673/pexels-photo-1181673.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            fullDescription: `
                <p>The QuantumBook Pro 14" redefines professional computing with its cutting-edge technology and sleek design. Engineered for power users who demand performance without compromise, this laptop delivers exceptional speed, stunning visuals, and all-day battery life.</p>
                <h4>Key Features:</h4>
                <ul>
                    <li>14-inch Retina display with True Tone technology</li>
                    <li>12th Gen Intel Core i9 processor with 10 cores</li>
                    <li>32GB unified memory for seamless multitasking</li>
                    <li>1TB SSD storage with blazing-fast read/write speeds</li>
                    <li>Up to 18 hours of battery life</li>
                    <li>Advanced thermal system for sustained performance</li>
                    <li>Six-speaker sound system with spatial audio</li>
                    <li>1080p FaceTime HD camera with studio-quality mics</li>
                </ul>
            `,
            highlights: [
                "14-inch Liquid Retina XDR display",
                "M2 Pro or M2 Max chip for incredible performance",
                "Up to 96GB unified memory",
                "Up to 22 hours battery life",
                "ProRes video acceleration"
            ],
            specifications: [
                { name: "Processor", value: "Intel Core i9-12900H" },
                { name: "Memory", value: "32GB DDR5" },
                { name: "Storage", value: "1TB NVMe SSD" },
                { name: "Display", value: '14" 3024×1964 Liquid Retina XDR' },
                { name: "Graphics", value: "Intel Iris Xe Graphics" },
                { name: "Ports", value: "3 × Thunderbolt 4, HDMI, SDXC, MagSafe 3" },
                { name: "Wireless", value: "Wi-Fi 6E, Bluetooth 5.3" },
                { name: "Operating System", value: "Windows 11 Pro" },
                { name: "Dimensions", value: "12.31 × 8.71 × 0.61 inches" },
                { name: "Weight", value: "3.5 pounds" }
            ],
            reviews: [
                {
                    id: 'rev-1',
                    author: 'Alex Johnson',
                    rating: 5,
                    date: '2023-05-15',
                    title: 'Perfect for creative work',
                    content: 'This laptop handles everything I throw at it - 4K video editing, 3D rendering, you name it. The display is absolutely stunning and the battery life is incredible.'
                },
                {
                    id: 'rev-2',
                    author: 'Sarah Miller',
                    rating: 4,
                    date: '2023-04-22',
                    title: 'Great but gets warm',
                    content: 'Performance is outstanding, though it does get quite warm under heavy load. The fans can get loud but they do keep the temperature in check.'
                },
                {
                    id: 'rev-3',
                    author: 'Michael Chen',
                    rating: 5,
                    date: '2023-06-10',
                    title: 'Worth every penny',
                    content: 'Upgraded from a 3-year-old model and the difference is night and day. The keyboard is a joy to type on and the new processors are blazing fast.'
                }
            ]
        },
        { 
            id: 'p-2', 
            name: 'Stellara Vision 27" 4K', 
            price: 699, 
            brandId: 'brand-2', 
            subcategoryId: 'sub-3', 
            rating: 4.7, 
            reviews: 750, 
            description: "Crisp, vibrant colors for creative work and gaming.", 
            imageUrl: 'https://images.pexels.com/photos/1029757/pexels-photo-1029757.jpeg?auto=compress&cs=tinysrgb&w=400',
            images: [
                'https://images.pexels.com/photos/1029757/pexels-photo-1029757.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/2760242/pexels-photo-2760242.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1229861/pexels-photo-1229861.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            fullDescription: `
                <p>The Stellara Vision 27" 4K monitor delivers stunning visuals with its ultra-high-definition display, perfect for creative professionals, gamers, and anyone who appreciates crystal-clear imagery.</p>
                <h4>Key Features:</h4>
                <ul>
                    <li>27-inch 4K UHD (3840 x 2160) IPS display</li>
                    <li>99% sRGB and 95% DCI-P3 color gamut</li>
                    <li>HDR400 support for enhanced contrast and color</li>
                    <li>144Hz refresh rate with 1ms response time</li>
                    <li>AMD FreeSync Premium Pro technology</li>
                    <li>Ergonomic stand with height, tilt, swivel, and pivot adjustment</li>
                    <li>Multiple connectivity options including HDMI 2.1, DisplayPort 1.4, and USB-C</li>
                </ul>
            `,
            highlights: [
                "27-inch 4K UHD IPS display",
                "144Hz refresh rate with 1ms response",
                "HDR400 support",
                "AMD FreeSync Premium Pro",
                "Ergonomic stand with full adjustability"
            ],
            specifications: [
                { name: "Screen Size", value: "27 inches" },
                { name: "Resolution", value: "3840 × 2160 (4K UHD)" },
                { name: "Panel Type", value: "IPS" },
                { name: "Refresh Rate", value: "144Hz" },
                { name: "Response Time", value: "1ms (GTG)" },
                { name: "Contrast Ratio", value: "100"},
            ],
            reviews: [
                {
                    id: 'rev-4',
                    author: 'David Wilson',
                    rating: 5,
                    date: '2023-03-18',
                    title: 'Best monitor Ive ever owned',
                    content: 'The colors are incredibly accurate and the 144Hz refresh rate makes gaming buttery smooth. The stand is very sturdy and adjustable.'
                },
                {
                    id: 'rev-5',
                    author: 'Emily Rodriguez',
                    rating: 4,
                    date: '2023-02-05',
                    title: 'Great for photo editing',
                    content: 'As a photographer, color accuracy is crucial. This monitor delivers excellent color reproduction right out of the box. Only wish it had built-in calibration.'
                }
            ]
        },
        { 
            id: 'p-3', 
            name: 'ByteWorks PowerStation', 
            price: 1999, 
            brandId: 'brand-3', 
            subcategoryId: 'sub-2', 
            rating: 4.9, 
            reviews: 430, 
            description: "A powerhouse desktop for demanding tasks.", 
            imageUrl: 'https://images.pexels.com/photos/1779487/pexels-photo-1779487.jpeg?auto=compress&cs=tinysrgb&w=400',
            images: [
                'https://images.pexels.com/photos/1779487/pexels-photo-1779487.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1148820/pexels-photo-1148820.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            fullDescription: `
                <p>The ByteWorks PowerStation is a high-performance desktop computer designed for professionals who need uncompromising power for 3D rendering, video editing, scientific computing, and other intensive workloads.</p>
                <h4>Key Features:</h4>
                <ul>
                    <li>Intel Core i9-13900K 24-core processor</li>
                    <li>NVIDIA RTX 4090 with 24GB GDDR6X memory</li>
                    <li>64GB DDR5 RAM (expandable to 128GB)</li>
                    <li>2TB NVMe SSD + 4TB HDD storage</li>
                    <li>Liquid cooling system with RGB lighting</li>
                    <li>1000W 80+ Platinum power supply</li>
                    <li>Wi-Fi 6E and 2.5G Ethernet</li>
                    <li>Multiple USB ports including Thunderbolt 4</li>
                </ul>
            `,
            highlights: [
                "Intel Core i9-13900K 24-core processor",
                "NVIDIA RTX 4090 graphics",
                "64GB DDR5 RAM",
                "Liquid cooling system",
                "Dual storage: 2TB NVMe + 4TB HDD"
            ],
            specifications: [
                { name: "Processor", value: "Intel Core i9-13900K (24 cores, 32 threads)" },
                { name: "Memory", value: "64GB DDR5 5600MHz" },
                { name: "Graphics", value: "NVIDIA GeForce RTX 4090 (24GB GDDR6X)" },
                { name: "Primary Storage", value: "2TB NVMe PCIe 4.0 SSD" },
                { name: "Secondary Storage", value: "4TB 7200RPM HDD" },
                { name: "Cooling", value: "240mm RGB liquid cooling" },
                { name: "Power Supply", value: "1000W 80+ Platinum" },
                { name: "Operating System", value: "Windows 11 Pro" },
                { name: "Dimensions", value: "18.9 × 8.6 × 18.3 inches" },
                { name: "Weight", value: "28.6 pounds" }
            ],
            reviews: [
                {
                    id: 'rev-6',
                    author: 'Robert Taylor',
                    rating: 5,
                    date: '2023-06-28',
                    title: 'Absolute beast of a machine',
                    content: 'Renders my 3D animations in half the time of my old system. The RTX 4090 is a game-changer for real-time ray tracing.'
                },
                {
                    id: 'rev-7',
                    author: 'Jennifer Kim',
                    rating: 5,
                    date: '2023-05-12',
                    title: 'Perfect for 8K video editing',
                    content: 'Handles 8K footage like it was nothing. No lag or stuttering even with multiple effects applied. Worth every penny for professional video editors.'
                }
            ]
        },
        // ... (other products with similar detailed data)
    ]
};

const brandMap = new Map(catalog.brands.map(b => [b.id, b.name]));
const subcategoryMap = new Map(catalog.subcategories.map(s => [s.id, s]));
const categoryMap = new Map(catalog.categories.map(c => [c.id, c.name]));
const maxPrice = Math.ceil(Math.max(...catalog.products.map(p => p.price)) / 100) * 100;

// --- STATE ---
let state = {
    searchTerm: '',
    selectedCategory: null,
    selectedSubcategory: null,
    selectedBrands: [],
    price: maxPrice,
    sortBy: 'featured',
};

// --- DOM ELEMENTS ---
const DOMElements = {
    searchInput: document.getElementById('searchInput'),
    mobileSearchInput: document.getElementById('mobileSearchInput'),
    sortSelect: document.getElementById('sort-by'),
    filtersContainer: document.getElementById('filtersContainer'),
    productsGrid: document.getElementById('productsGrid'),
    resultsCount: document.getElementById('resultsCount'),
    noResults: document.getElementById('noResults'),
    clearFiltersBtn: document.getElementById('clearFilters'),
    filterBtn: document.getElementById('filterBtn'),
    closeSidebarBtn: document.getElementById('closeSidebar'),
    sidebar: document.getElementById('filterSidebar'),
    sidebarOverlay: document.getElementById('sidebarOverlay'),
    mobileMenuBtn: document.getElementById('mobileMenuBtn'),
    closeMobileMenuBtn: document.getElementById('closeMobileMenuBtn'),
    mobileMenu: document.getElementById('mobileMenu'),
    mobileMenuOverlay: document.getElementById('mobileMenuOverlay'),
    mobileMenuPanel: document.getElementById('mobileMenuPanel'),
    megaMenuContent: document.getElementById('mega-menu-content'),
    mobileCategoriesToggle: document.getElementById('mobile-categories-toggle'),
    mobileCategoriesList: document.getElementById('mobile-categories-list'),
    productDetailModal: document.getElementById('productDetailModal'),
    productDetailModalOverlay: document.getElementById('productDetailModalOverlay'),
    productDetailModalContent: document.getElementById('productDetailModalContent'),
    closeProductDetailModal: document.getElementById('closeProductDetailModal'),
    mainProductImage: document.getElementById('mainProductImage'),
    productThumbnails: document.getElementById('productThumbnails'),
    productBrand: document.getElementById('productBrand'),
    productTitle: document.getElementById('productTitle'),
    productRating: document.getElementById('productRating'),
    productReviewCount: document.getElementById('productReviewCount'),
    productPrice: document.getElementById('productPrice'),
    productOriginalPrice: document.getElementById('productOriginalPrice'),
    productDiscountBadge: document.getElementById('productDiscountBadge'),
    productAvailability: document.getElementById('productAvailability'),
    productDescription: document.getElementById('productDescription'),
    productHighlights: document.getElementById('productHighlights'),
    productFullDescription: document.getElementById('productFullDescription'),
    productSpecs: document.getElementById('productSpecs'),
    reviewSummaryStars: document.getElementById('reviewSummaryStars'),
    reviewSummaryCount: document.getElementById('reviewSummaryCount'),
    reviewList: document.getElementById('reviewList'),
    writeReviewBtn: document.getElementById('writeReviewBtn'),
    decrementQuantity: document.getElementById('decrementQuantity'),
    incrementQuantity: document.getElementById('incrementQuantity'),
    productQuantity: document.getElementById('productQuantity'),
    addToCartDetail: document.getElementById('addToCartDetail'),
    addToWishlistDetail: document.getElementById('addToWishlistDetail'),
    stickyAddToCart: document.getElementById('stickyAddToCart'),
    stickyProductPrice: document.getElementById('stickyProductPrice'),
    stickyAddToCartBtn: document.getElementById('stickyAddToCartBtn')
};

// --- UTILS ---
const debounce = (func, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
};

const createStarRating = (rating) => {
    return Array.from({ length: 5 }, (_, i) => 
        `<svg class="w-5 h-5 ${i < Math.round(rating) ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>`
    ).join('');
};

// --- RENDER FUNCTIONS ---
const renderMegaMenu = () => {
    if (!DOMElements.megaMenuContent) return;
    DOMElements.megaMenuContent.innerHTML = catalog.categories.map(category => {
        const subcats = catalog.subcategories.filter(s => s.categoryId === category.id);
        return `
            <div>
                <h6 class="font-bold text-indigo-600 mb-2">${category.name}</h6>
                <ul class="space-y-1">
                    ${subcats.map(subcat => `
                        <li>
                            <a href="#" data-cat-id="${category.id}" data-subcat-id="${subcat.id}" 
                            class="mega-menu-link block py-1 px-2 text-sm text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 rounded transition-colors">
                                ${subcat.name}
                            </a>
                        </li>
                    `).join('')}
                </ul>
            </div>
        `;
    }).join('');
};

const renderMobileCategories = () => {
    if (!DOMElements.mobileCategoriesList) return;
    DOMElements.mobileCategoriesList.innerHTML = catalog.categories.map(category => {
        const subcats = catalog.subcategories.filter(s => s.categoryId === category.id);
        return `
            <div class="py-1">
                <h4 class="font-semibold text-gray-800 py-1 text-sm">${category.name}</h4>
                <div class="pl-2 flex flex-col items-start">
                ${subcats.map(subcat => `
                    <a href="#" data-cat-id="${category.id}" data-subcat-id="${subcat.id}" class="mobile-menu-link block py-1 text-gray-600 hover:text-indigo-600 text-sm">${subcat.name}</a>
                `).join('')}
                </div>
            </div>
        `;
    }).join('');
};

const renderFilters = (availableBrands) => {
    const visibleSubcategories = state.selectedCategory
        ? catalog.subcategories.filter(s => s.categoryId === state.selectedCategory)
        : [];
    
    if (!DOMElements.filtersContainer) return;
    
    DOMElements.filtersContainer.innerHTML = `
        <div class="filter-section">
            <h3 class="font-semibold text-gray-900 mb-3">Category</h3>
            <div class="space-y-2" id="categoryFilters">
                 <label class="flex items-center cursor-pointer hover:bg-gray-50 p-1 rounded-md">
                    <input type="radio" name="category" value="all" ${!state.selectedCategory ? 'checked' : ''} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <span class="ml-3 text-sm ${!state.selectedCategory ? 'text-blue-700 font-semibold' : 'text-gray-600'}">All Categories</span>
                </label>
                ${catalog.categories.map(cat => `
                    <label class="flex items-center cursor-pointer hover:bg-gray-50 p-1 rounded-md">
                        <input type="radio" name="category" value="${cat.id}" ${state.selectedCategory === cat.id ? 'checked' : ''} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-3 text-sm ${state.selectedCategory === cat.id ? 'text-blue-700 font-semibold' : 'text-gray-600'}">${cat.name}</span>
                    </label>
                `).join('')}
            </div>
        </div>
        
        ${visibleSubcategories.length > 0 ? `
        <div class="filter-section">
            <h3 class="font-semibold text-gray-900 mb-3">Subcategory</h3>
            <div class="space-y-2" id="subcategoryFilters">
                ${visibleSubcategories.map(sub => `
                    <button data-subcat-id="${sub.id}" class="w-full text-left text-sm px-2 py-1.5 rounded-md transition-colors ${state.selectedSubcategory === sub.id ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-100'}">
                        ${sub.name}
                    </button>
                `).join('')}
            </div>
        </div>
        ` : ''}

        ${availableBrands.length > 0 ? `
        <div class="filter-section">
            <h3 class="font-semibold text-gray-900 mb-3">Brand</h3>
            <div class="space-y-3 max-h-48 overflow-y-auto pr-2" id="brandFilters">
               ${availableBrands.map(brand => `
                    <div class="flex items-center">
                        <input id="brand-${brand.id}" type="checkbox" data-brand-id="${brand.id}" ${state.selectedBrands.includes(brand.id) ? 'checked' : ''} class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="brand-${brand.id}" class="ml-3 text-sm text-gray-600 cursor-pointer">${brand.name}</label>
                    </div>
               `).join('')}
            </div>
        </div>
        ` : ''}

        <div class="filter-section">
             <h3 class="font-semibold text-gray-900 mb-3">Price</h3>
             <div class="space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium text-gray-900"></span>
                    <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                    Up to $<span id="priceValue">${state.price}</span>
                    </span>
                </div>
                <input type="range" id="priceRange" min="0" max="${maxPrice}" value="${state.price}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>$0</span>
                    <span>$${maxPrice}</span>
                </div>
            </div>
        </div>
    `;
    addFilterEventListeners();
}

const renderProducts = (products) => {
    if (!DOMElements.resultsCount || !DOMElements.productsGrid || !DOMElements.noResults) return;
    
    DOMElements.resultsCount.textContent = products.length.toString();
    if (products.length === 0) {
        DOMElements.productsGrid.classList.add('hidden');
        DOMElements.noResults.classList.remove('hidden');
    } else {
        DOMElements.productsGrid.classList.remove('hidden');
        DOMElements.noResults.classList.add('hidden');
        DOMElements.productsGrid.innerHTML = products.map(p => createProductCard(p)).join('');
    }
};

const createProductCard = (product) => {
    const brandName = brandMap.get(product.brandId) || 'Unknown Brand';
    const isOnSale = product.originalPrice && product.originalPrice > product.price;
    const discount = isOnSale ? Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100) : 0;
    const subcategory = subcategoryMap.get(product.subcategoryId);
    const categoryName = subcategory ? categoryMap.get(subcategory.categoryId) : 'Uncategorized';
    const ratingStars = Array.from({ length: 5 }, (_, i) => 
        `<svg class="w-4 h-4 ${i < Math.round(product.rating) ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>`
    ).join('');

    return `
        <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white product-card">
            <div class="aspect-w-1 aspect-h-1 bg-gray-200 sm:aspect-none relative h-60 overflow-hidden">
                <img src="${product.imageUrl}" alt="${product.name}" class="h-full w-full object-cover object-center product-image" loading="lazy">
                ${isOnSale ? `<div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">-${discount}%</div>` : ''}
            </div>
            <div class="flex flex-1 flex-col p-4 space-y-2">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">${categoryName}</p>
                <h3 class="text-base font-semibold text-gray-800 flex-grow min-h-[40px]"><a href="#" data-product-id="${product.id}" class="product-link hover:text-indigo-600 stretched-link">${product.name}</a></h3>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center" aria-label="Rating: ${product.rating} out of 5 stars">${ratingStars}<span class="ml-2 text-gray-500">(${product.reviews})</span></div>
                    <p class="italic text-gray-500">${brandName}</p>
                </div>
                <div class="flex items-baseline justify-end space-x-2 pt-2">
                    ${isOnSale ? `<span class="text-md text-gray-500 line-through">$${product.originalPrice.toFixed(2)}</span>` : ''}
                    <p class="text-xl font-bold text-gray-900">$${product.price.toFixed(2)}</p>
                </div>
                 <div class="mt-auto pt-4 flex items-center space-x-2 z-10 relative">
                    <button data-action="add-to-cart" data-product-id="${product.id}" class="flex-grow bg-blue-600 text-white text-sm font-semibold py-2 px-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Add to Cart
                    </button>
                    <button data-action="add-to-wishlist" data-product-id="${product.id}" class="p-2 text-gray-400 rounded-full hover:bg-gray-100 hover:text-red-500 transition-colors" title="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
};

const renderProductDetails = (product) => {
    if (!product) return;
    
    const isOnSale = product.originalPrice && product.originalPrice > product.price;
    const discount = isOnSale ? Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100) : 0;
    const brandName = brandMap.get(product.brandId) || 'Unknown Brand';
    
    // Set basic product info
    DOMElements.productBrand.textContent = brandName;
    DOMElements.productTitle.textContent = product.name;
    DOMElements.productDescription.textContent = product.description;
    DOMElements.productPrice.textContent = `$${product.price.toFixed(2)}`;
    DOMElements.productRating.innerHTML = createStarRating(product.rating);
    DOMElements.productReviewCount.textContent = product.reviews;
    
    // Handle sale price display
    if (isOnSale) {
        DOMElements.productOriginalPrice.textContent = `$${product.originalPrice.toFixed(2)}`;
        DOMElements.productOriginalPrice.classList.remove('hidden');
        DOMElements.productDiscountBadge.textContent = `${discount}% off`;
        DOMElements.productDiscountBadge.classList.remove('hidden');
    } else {
        DOMElements.productOriginalPrice.classList.add('hidden');
        DOMElements.productDiscountBadge.classList.add('hidden');
    }
    
    // Set sticky cart price
    DOMElements.stickyProductPrice.textContent = `$${product.price.toFixed(2)}`;
    
    // Render product images
    if (product.images && product.images.length > 0) {
        DOMElements.mainProductImage.src = product.images[0];
        DOMElements.mainProductImage.alt = product.name;
        
        DOMElements.productThumbnails.innerHTML = product.images.map((img, index) => `
            <button class="product-gallery-thumbnail ${index === 0 ? 'active' : ''}" data-image-index="${index}">
                <img src="${img}" alt="${product.name} thumbnail ${index + 1}" class="w-full h-full object-cover rounded-md">
            </button>
        `).join('');
    }
    
    // Render highlights
    if (product.highlights && product.highlights.length > 0) {
        DOMElements.productHighlights.innerHTML = product.highlights.map(highlight => `
            <li class="flex items-start">
                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-gray-600">${highlight}</span>
            </li>
        `).join('');
    }
    
    // Render full description
    if (product.fullDescription) {
        DOMElements.productFullDescription.innerHTML = product.fullDescription;
    }
    
    // Render specifications
    if (product.specifications && product.specifications.length > 0) {
        DOMElements.productSpecs.innerHTML = product.specifications.map(spec => `
            <tr class="hover:bg-gray-50">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${spec.name}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">${spec.value}</td>
            </tr>
        `).join('');
    }
    
    // Render reviews
    if (product.reviews && product.reviews.length > 0) {
        DOMElements.reviewSummaryStars.innerHTML = createStarRating(product.rating);
        DOMElements.reviewSummaryCount.textContent = product.reviews;
        
        DOMElements.reviewList.innerHTML = product.reviews.map(review => `
            <div class="review">
                <div class="flex items-center">
                    <div class="flex items-center">
                        ${createStarRating(review.rating)}
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-bold text-gray-900">${review.title}</h4>
                        <p class="text-xs text-gray-500">By ${review.author} on ${new Date(review.date).toLocaleDateString()}</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    <p>${review.content}</p>
                </div>
            </div>
        `).join('');
    }
};

const openProductDetail = (productId) => {
    const product = catalog.products.find(p => p.id === productId);
    if (!product) return;
    
    renderProductDetails(product);
    
    // Show modal
    DOMElements.productDetailModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Show sticky add to cart on mobile
    if (window.innerWidth < 768) {
        DOMElements.stickyAddToCart.classList.remove('hidden');
    }
};

const closeProductDetail = () => {
    DOMElements.productDetailModal.classList.add('hidden');
    document.body.style.overflow = '';
    DOMElements.stickyAddToCart.classList.add('hidden');
};

// --- LOGIC ---
const update = () => {
    let products = [...catalog.products];
    
    const subcategoryIdsInCategory = state.selectedCategory ? catalog.subcategories.filter(s => s.categoryId === state.selectedCategory).map(s => s.id) : [];
    if (state.selectedSubcategory) {
        products = products.filter(p => p.subcategoryId === state.selectedSubcategory);
    } else if (state.selectedCategory) {
        products = products.filter(p => subcategoryIdsInCategory.includes(p.subcategoryId));
    }

    const availableBrandIds = new Set(products.map(p => p.brandId));
    const availableBrands = catalog.brands.filter(b => availableBrandIds.has(b.id));

    if (state.selectedBrands.length > 0) {
        products = products.filter(p => state.selectedBrands.includes(p.brandId));
    }

    products = products.filter(p => p.price <= state.price);

    if (state.searchTerm) {
        const lowerCaseSearch = state.searchTerm.toLowerCase();
        products = products.filter(p => p.name.toLowerCase().includes(lowerCaseSearch));
    }

    products.sort((a, b) => {
        switch (state.sortBy) {
            case 'price-low': return a.price - b.price;
            case 'price-high': return b.price - a.price;
            case 'rating': return b.rating - a.rating;
            default: return (b.originalPrice ? 1 : 0) - (a.originalPrice ? 1 : 0) || b.rating - a.rating;
        }
    });
    
    renderFilters(availableBrands);
    renderProducts(products);
};

const debouncedUpdate = debounce(update, 250);

// --- EVENT LISTENERS ---
const addFilterEventListeners = () => {
    document.querySelectorAll('input[name="category"]').forEach(radio => radio.addEventListener('change', (e) => {
        state.selectedCategory = e.target.value === 'all' ? null : e.target.value;
        state.selectedSubcategory = null;
        update();
    }));

    document.querySelectorAll('button[data-subcat-id]').forEach(btn => btn.addEventListener('click', (e) => {
        const subId = e.currentTarget.dataset.subcatId;
        state.selectedSubcategory = state.selectedSubcategory === subId ? null : subId;
        update();
    }));

    document.querySelectorAll('input[data-brand-id]').forEach(checkbox => checkbox.addEventListener('change', (e) => {
        const brandId = e.currentTarget.dataset.brandId;
        state.selectedBrands = e.target.checked
            ? [...state.selectedBrands, brandId]
            : state.selectedBrands.filter(id => id !== brandId);
        update();
    }));

    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    if(priceRange && priceValue) {
        priceRange.addEventListener('input', (e) => {
            state.price = Number(e.target.value);
            priceValue.textContent = state.price.toString();
        });
        priceRange.addEventListener('change', debouncedUpdate);
    }
};

const handleSearchInput = (e) => {
    const value = e.target.value;
    state.searchTerm = value;
    // Sync both search inputs
    if (e.target.id === 'searchInput') {
        DOMElements.mobileSearchInput.value = value;
    } else {
        DOMElements.searchInput.value = value;
    }
    debouncedUpdate();
};

const closeMobileSidebar = () => {
    DOMElements.sidebar.classList.add('-translate-x-full');
    DOMElements.sidebarOverlay.classList.add('hidden');
}

const openMobileMenu = () => {
    DOMElements.mobileMenu.classList.remove('hidden');
    requestAnimationFrame(() => {
        DOMElements.mobileMenuPanel.classList.remove('-translate-x-full');
        DOMElements.mobileMenuOverlay.classList.remove('opacity-0');
    });
};

const closeMobileMenu = () => {
    DOMElements.mobileMenuPanel.classList.add('-translate-x-full');
    DOMElements.mobileMenuOverlay.classList.add('opacity-0');
    DOMElements.mobileMenu.addEventListener('transitionend', (e) => {
        if (e.target === DOMElements.mobileMenuOverlay) {
             DOMElements.mobileMenu.classList.add('hidden');
        }
    }, { once: true });
};

const setupGlobalEventListeners = () => {
    DOMElements.searchInput.addEventListener('input', handleSearchInput);
    DOMElements.mobileSearchInput.addEventListener('input', handleSearchInput);
    
    DOMElements.sortSelect.addEventListener('change', (e) => {
        state.sortBy = e.target.value;
        update();
    });
    
    DOMElements.clearFiltersBtn.addEventListener('click', () => {
        state = { searchTerm: '', selectedCategory: null, selectedSubcategory: null, selectedBrands: [], price: maxPrice, sortBy: 'featured' };
        DOMElements.searchInput.value = '';
        DOMElements.mobileSearchInput.value = '';
        DOMElements.sortSelect.value = 'featured';
        closeMobileSidebar();
        update();
    });
    
    DOMElements.filterBtn.addEventListener('click', () => {
        DOMElements.sidebar.classList.remove('-translate-x-full');
        DOMElements.sidebarOverlay.classList.remove('hidden');
    });
    DOMElements.closeSidebarBtn.addEventListener('click', closeMobileSidebar);
    DOMElements.sidebarOverlay.addEventListener('click', closeMobileSidebar);

    DOMElements.mobileMenuBtn.addEventListener('click', openMobileMenu);
    DOMElements.closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
    DOMElements.mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    
    DOMElements.mobileCategoriesToggle.addEventListener('click', () => {
        DOMElements.mobileCategoriesList.classList.toggle('hidden');
        DOMElements.mobileCategoriesToggle.classList.toggle('open');
    });
    
    // Product detail modal events
    DOMElements.closeProductDetailModal.addEventListener('click', closeProductDetail);
    DOMElements.productDetailModalOverlay.addEventListener('click', closeProductDetail);
    
    // Product thumbnail navigation
    DOMElements.productThumbnails.addEventListener('click', (e) => {
        const thumbnail = e.target.closest('.product-gallery-thumbnail');
        if (!thumbnail) return;
        
        const index = thumbnail.dataset.imageIndex;
        const productId = DOMElements.productTitle.dataset.productId;
        const product = catalog.products.find(p => p.id === productId);
        
        if (product && product.images[index]) {
            DOMElements.mainProductImage.src = product.images[index];
            
            // Update active thumbnail
            document.querySelectorAll('.product-gallery-thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }
    });
    
    // Product tab navigation
    document.querySelectorAll('.product-tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.dataset.tab;
            
            // Update active tab button
            document.querySelectorAll('.product-tab-button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Show corresponding tab content
            document.querySelectorAll('.product-tabs-content').forEach(content => content.classList.remove('active'));
            document.getElementById(`tab-${tabId}`).classList.add('active');
        });
    });
    
    // Quantity controls
    DOMElements.decrementQuantity.addEventListener('click', () => {
        const current = parseInt(DOMElements.productQuantity.value);
        if (current > 1) {
            DOMElements.productQuantity.value = current - 1;
        }
    });
    
    DOMElements.incrementQuantity.addEventListener('click', () => {
        const current = parseInt(DOMElements.productQuantity.value);
        DOMElements.productQuantity.value = current + 1;
    });
    
    // Add to cart buttons
    [DOMElements.addToCartDetail, DOMElements.stickyAddToCartBtn].forEach(button => {
        if (button) {
            button.addEventListener('click', () => {
                const productId = DOMElements.productTitle.dataset.productId;
                const quantity = parseInt(DOMElements.productQuantity.value);
                console.log(`Added ${quantity} of product ${productId} to cart`);
                // Future: Add actual cart logic here
            });
        }
    });
    
    // Add to wishlist button
    DOMElements.addToWishlistDetail.addEventListener('click', () => {
        const productId = DOMElements.productTitle.dataset.productId;
        console.log(`Added product ${productId} to wishlist`);
        // Future: Add actual wishlist logic here
    });
    
    // Write review button
    DOMElements.writeReviewBtn.addEventListener('click', () => {
        console.log('Open review form');
        // Future: Implement review form
    });
    
    // Handle product clicks
    document.body.addEventListener('click', (e) => {
        // Category navigation
        const target = e.target.closest('.mega-menu-link, .mobile-menu-link');
        if (target) {
            e.preventDefault();
            state.selectedCategory = target.dataset.catId || null;
            state.selectedSubcategory = target.dataset.subcatId || null;
            if (target.matches('.mobile-menu-link')) {
                closeMobileMenu();
            }
            // Reset search and other filters for cleaner navigation
            state.searchTerm = '';
            DOMElements.searchInput.value = '';
            DOMElements.mobileSearchInput.value = '';
            update();
            return;
        }
        
        // Product detail view
        const productLink = e.target.closest('.product-link');
        if (productLink) {
            e.preventDefault();
            openProductDetail(productLink.dataset.productId);
            return;
        }
        
        // Product action buttons
        const button = e.target.closest('button[data-action]');
        if (!button) return;

        const { action, productId } = button.dataset;

        if (action === 'add-to-cart') {
            console.log(`Added to cart: ${productId}`);
            // Future: Add cart logic here
        } else if (action === 'add-to-wishlist') {
            console.log(`Added to cart: ${productId}`);
                        // Future: Add wishlist logic here
        }
    });

    // Handle window resize to show/hide sticky add to cart
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            DOMElements.stickyAddToCart.classList.add('hidden');
        } else if (!DOMElements.productDetailModal.classList.contains('hidden')) {
            DOMElements.stickyAddToCart.classList.remove('hidden');
        }
    });
};

// --- INITIALIZATION ---
const init = () => {
    renderMegaMenu();
    renderMobileCategories();
    setupGlobalEventListeners();
    update();
};

init();
});

    </script>
</body>
</html>

