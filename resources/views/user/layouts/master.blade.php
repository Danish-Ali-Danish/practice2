<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - Everything You Need, All in One Place</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .category-card:hover .category-img {
            transform: scale(1.05);
        }
        .product-card:hover .product-actions {
            opacity: 1;
            bottom: 20px;
        }
        .deal-countdown {
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
          /* Simple loading spinner */
    .spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border-left-color: #09f;
      animation: spin 1s ease infinite;
    }
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    .view-container {
      display: none;
    }
    .view-container.active {
      display: block;
    }
  
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
@include('user.layouts.navbar')
@yield('content')
@include('user.layouts.footer')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Add this to your existing script section
        const limitedEditionSwiper = new Swiper('.limited-edition-swiper', {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
            }
        });
        // Hotspot hover effect
        document.querySelectorAll('.relative button').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.querySelector('span').classList.add('opacity-100');
            });
            button.addEventListener('mouseleave', function() {
                this.querySelector('span').classList.remove('opacity-100');
            });
        });
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Initialize Swiper sliders
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        const flashSaleSwiper = new Swiper('.flash-sale-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            }
        });

        const testimonialsSwiper = new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });

        // Back to top button
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Mobile menu toggle
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const openMobileMenu = document.querySelector('header button.md\\:hidden');

        openMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });

        closeMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });

        // Deal countdown timer
        function updateCountdown() {
            const countdown = document.querySelector('.deal-countdown');
            if (!countdown) return;

            // Set the date we're counting down to (24 hours from now)
            const countDownDate = new Date();
            countDownDate.setHours(countDownDate.getHours() + 12);
            countDownDate.setMinutes(countDownDate.getMinutes() + 45);
            countDownDate.setSeconds(countDownDate.getSeconds() + 30);

            // Update the countdown every 1 second
            const x = setInterval(function() {
                // Get today's date and time
                const now = new Date().getTime();
                
                // Find the distance between now and the countdown date
                const distance = countDownDate - now;
                
                // Time calculations for hours, minutes and seconds
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                // Display the result
                const timeElements = countdown.querySelectorAll('div');
                timeElements[0].textContent = Math.floor(hours).toString().padStart(2, '0');
                timeElements[1].textContent = Math.floor(minutes).toString().padStart(2, '0');
                timeElements[2].textContent = Math.floor(seconds).toString().padStart(2, '0');
                
                // If the countdown is finished, clear interval
                if (distance < 0) {
                    clearInterval(x);
                    countdown.innerHTML = "DEAL EXPIRED";
                }
            }, 1000);
        }

        updateCountdown();

        // Search suggestions toggle
        const searchInput = document.querySelector('.search-box input');
        const searchSuggestions = document.querySelector('.search-suggestions');
        
        if (searchInput && searchSuggestions) {
            searchInput.addEventListener('focus', () => {
                searchSuggestions.classList.remove('d-none');
                searchSuggestions.classList.add('block');
            });
            
            searchInput.addEventListener('blur', () => {
                setTimeout(() => {
                    searchSuggestions.classList.remove('block');
                    searchSuggestions.classList.add('d-none');
                }, 200);
            });
        }
    </script>
    
    <script>
        // --- DATA ---
const CATEGORIES = [
  { id: 'electronics', name: 'Electronics', imageUrl: 'https://picsum.photos/seed/electronics/200/200',
    subcategories: [
      { id: 'smartphones', name: 'Smartphones', categoryId: 'electronics' },
      { id: 'laptops', name: 'Laptops', categoryId: 'electronics' },
      { id: 'headphones', name: 'Headphones', categoryId: 'electronics' },
      { id: 'tvs', name: 'TVs', categoryId: 'electronics' },
    ]
  },
  { id: 'fashion', name: 'Fashion', imageUrl: 'https://picsum.photos/seed/fashion/200/200',
    subcategories: [
      { id: 'mens-clothing', name: 'Men\'s Clothing', categoryId: 'fashion' },
      { id: 'womens-clothing', name: 'Women\'s Clothing', categoryId: 'fashion' },
      { id: 'shoes', name: 'Shoes', categoryId: 'fashion' },
    ]
  },
  { id: 'home-goods', name: 'Home Goods', imageUrl: 'https://picsum.photos/seed/home/200/200',
    subcategories: [
      { id: 'furniture', name: 'Furniture', categoryId: 'home-goods' },
      { id: 'kitchenware', name: 'Kitchenware', categoryId: 'home-goods' },
      { id: 'lighting', name: 'Lighting', categoryId: 'home-goods' },
    ]
  },
  { id: 'sports', name: 'Sports', imageUrl: 'https://picsum.photos/seed/sports/200/200',
    subcategories: [
      { id: 'fitness', name: 'Fitness Gear', categoryId: 'sports' },
      { id: 'soccer', name: 'Soccer', categoryId: 'sports' },
    ]
  },
];

const BRANDS = [
  { id: 'apple', name: 'Apple' }, { id: 'samsung', name: 'Samsung' },
  { id: 'nike', name: 'Nike' }, { id: 'adidas', name: 'Adidas' },
  { id: 'ikea', name: 'IKEA' }, { id: 'sony', name: 'Sony' },
];

const PRODUCTS = [
  { id: 1, name: 'Smartphone Pro X', price: 999, subcategory: 'smartphones', brand: 'apple', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product1/200/200' },
  { id: 2, name: 'Running Shoes 2.0', price: 120, subcategory: 'shoes', brand: 'nike', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product2/200/200' },
  { id: 3, name: 'Bookshelf "Billy"', price: 89, subcategory: 'furniture', brand: 'ikea', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product3/200/200' },
  { id: 4, name: 'Galaxy Tablet S9', price: 750, subcategory: 'smartphones', brand: 'samsung', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product4/200/200' },
  { id: 5, name: 'Yoga Mat Premium', price: 45, subcategory: 'fitness', brand: 'adidas', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product5/200/200' },
  { id: 6, name: 'Wireless Headphones Pro', price: 199, subcategory: 'headphones', brand: 'sony', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product6/200/200' },
  { id: 7, name: 'Classic T-Shirt', price: 25, subcategory: 'mens-clothing', brand: 'adidas', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product7/200/200' },
  { id: 8, name: '4K Smart TV', price: 1200, subcategory: 'tvs', brand: 'samsung', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product13/200/200' },
  { id: 9, name: 'Soccer Ball Champion', price: 30, subcategory: 'soccer', brand: 'nike', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product9/200/200' },
  { id: 10, name: 'Desk Lamp LED', price: 55, subcategory: 'lighting', brand: 'ikea', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product10/200/200' },
  { id: 11, name: 'Laptop Pro 14"', price: 1800, subcategory: 'laptops', brand: 'apple', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product11/200/200' },
  { id: 12, name: 'Air Max Sneakers', price: 150, subcategory: 'shoes', brand: 'nike', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product12/200/200' },
  { id: 14, name: 'Cookware Set Pro', price: 250, subcategory: 'kitchenware', brand: 'ikea', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product14/200/200' },
  { id: 15, name: 'Dumbbell Set 20kg', price: 80, subcategory: 'fitness', brand: 'adidas', isFeatured: false, imageUrl: 'https://picsum.photos/seed/product15/200/200' },
  { id: 16, name: 'Blouse Elegant', price: 60, subcategory: 'womens-clothing', brand: 'adidas', isFeatured: true, imageUrl: 'https://picsum.photos/seed/product16/200/200' },
];

const PRODUCTS_PER_PAGE = 12;

// --- STATE ---
const state = {
  currentView: 'categories', // 'categories', 'subcategories', 'products'
  selectedCategoryId: null,
  selectedSubcategoryId: null,
  products: PRODUCTS,
  filteredProducts: [],
  currentPage: 1,
  filters: {
    brands: [],
    minPrice: 0,
    maxPrice: 10000,
    sort: 'name_asc',
  },
};


// --- DOM ELEMENTS ---
const DOMElements = {
  app: document.getElementById('app'),
  breadcrumbContainer: document.getElementById('breadcrumb-container'),
  categoryView: document.getElementById('category-view'),
  categoryGrid: document.getElementById('category-grid'),
  subcategoryView: document.getElementById('subcategory-view'),
  subcategoryTitle: document.getElementById('subcategory-title'),
  subcategoryGrid: document.getElementById('subcategory-grid'),
  productView: document.getElementById('product-view'),
  productListTitle: document.getElementById('product-list-title'),
  productGrid: document.getElementById('product-grid'),
  brandFilters: document.getElementById('brand-filters'),
  minPriceInput: document.getElementById('min-price'),
  maxPriceInput: document.getElementById('max-price'),
  sortSelect: document.getElementById('sort-select'),
  paginationContainer: document.getElementById('pagination-container'),
  loader: document.getElementById('loader'),
};

// --- RENDER FUNCTIONS ---

const renderBreadcrumbs = () => {
    let html = `
        <li class="flex items-center">
          <a href="/home" data-view="categories" class="breadcrumb-link hover:text-blue-600 hover:underline">Home</a>
        </li>
    `;
    const chevron = `
        <li class="flex items-center">
          <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
        </li>
    `;

    if (state.selectedCategoryId) {
        const category = CATEGORIES.find(c => c.id === state.selectedCategoryId);
        html += chevron;
        if (state.currentView === 'products') {
             html += `
                <li class="flex items-center">
                    <a href="" data-view="subcategories" data-category-id="${category.id}" class="breadcrumb-link hover:text-blue-600 hover:underline">${category.name}</a>
                </li>`;
        } else {
             html += `<li class="flex items-center"><span class="font-medium text-gray-700">${category.name}</span></li>`;
        }
    }

    if (state.selectedSubcategoryId) {
        const category = CATEGORIES.find(c => c.id === state.selectedCategoryId);
        const subcategory = category.subcategories.find(sc => sc.id === state.selectedSubcategoryId);
        html += chevron;
        html += `<li class="flex items-center"><span class="font-medium text-gray-700">${subcategory.name}</span></li>`;
    }
    DOMElements.breadcrumbContainer.innerHTML = html;
};

const renderCategoriesView = () => {
    DOMElements.categoryGrid.innerHTML = CATEGORIES.map(category => `
        <div data-category-id="${category.id}" class="category-card group flex flex-col items-center text-center shadow-sm border p-4 rounded-xl cursor-pointer transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl border-gray-200 bg-white">
            <div class="w-full h-32 bg-gray-100 rounded-lg overflow-hidden mb-4">
                <img src="${category.imageUrl}" alt="${category.name}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
            </div>
            <h3 class="text-lg font-semibold text-gray-800">${category.name}</h3>
        </div>
    `).join('');
};

const renderSubcategoriesView = () => {
    const category = CATEGORIES.find(c => c.id === state.selectedCategoryId);
    if (!category) return;

    DOMElements.subcategoryTitle.textContent = `Shop in ${category.name}`;
    DOMElements.subcategoryGrid.innerHTML = category.subcategories.map(sc => `
        <div data-subcategory-id="${sc.id}" class="subcategory-card group flex flex-col items-center text-center shadow-sm border p-4 rounded-xl cursor-pointer transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border-gray-200 bg-white">
            <h3 class="text-md font-semibold text-gray-700">${sc.name}</h3>
        </div>
    `).join('');
};

const renderProductListView = () => {
    const category = CATEGORIES.find(c => c.id === state.selectedCategoryId);
    const subcategory = category.subcategories.find(sc => sc.id === state.selectedSubcategoryId);
    DOMElements.productListTitle.textContent = subcategory.name;

    // Filter relevant brands for the sidebar
    const productsInSubcategory = PRODUCTS.filter(p => p.subcategory === state.selectedSubcategoryId);
    const relevantBrandIds = [...new Set(productsInSubcategory.map(p => p.brand))];
    const relevantBrands = BRANDS.filter(b => relevantBrandIds.includes(b.id));

    DOMElements.brandFilters.innerHTML = relevantBrands.map(brand => `
        <div class="flex items-center">
            <input id="brand-${brand.id}" name="brand" type="checkbox" value="${brand.id}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 filter-checkbox">
            <label for="brand-${brand.id}" class="ml-3 text-sm text-gray-600">${brand.name}</label>
        </div>
    `).join('');

    // Reset filters for new view
    DOMElements.minPriceInput.value = 0;
    DOMElements.maxPriceInput.value = 10000;
    DOMElements.sortSelect.value = 'name_asc';
    state.filters.brands = [];
    state.filters.minPrice = 0;
    state.filters.maxPrice = 10000;
    state.filters.sort = 'name_asc';

    applyFiltersAndRender();
};

function renderProductCard(product) {
  const featuredBadge = product.isFeatured
    ? `<span class="absolute top-2 right-2 bg-yellow-400 text-yellow-900 text-xs font-semibold px-2 py-1 rounded-full">Featured</span>`
    : '';

  return `
    <div class="group flex flex-col h-full bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
      <div class="relative pt-[100%] bg-gray-50">
        <img class="absolute top-0 left-0 w-full h-full object-contain p-4" src="${product.imageUrl}" alt="${product.name}" />
        ${featuredBadge}
      </div>
      <div class="p-3 flex flex-col flex-grow">
        <h3 class="text-sm font-semibold text-gray-800 truncate" title="${product.name}">${product.name}</h3>
        <p class="mt-1 text-xs text-gray-500 uppercase">${product.brand}</p>
        <div class="mt-auto pt-2">
            <p class="text-base font-bold text-gray-900">$${product.price.toFixed(2)}</p>
            <button class="mt-2 w-full text-center bg-blue-600 text-white text-xs font-semibold py-2 px-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
            Add to Cart
            </button>
        </div>
      </div>
    </div>
  `;
}

function renderProducts() {
  const paginatedProducts = state.filteredProducts.slice(
    (state.currentPage - 1) * PRODUCTS_PER_PAGE,
    state.currentPage * PRODUCTS_PER_PAGE
  );
  
  DOMElements.loader.style.display = 'none';
  DOMElements.productGrid.classList.remove('hidden');

  if (paginatedProducts.length === 0) {
    DOMElements.productGrid.innerHTML = `
      <div class="text-center py-16 col-span-full">
        <h3 class="text-xl font-semibold text-gray-700">No Products Found</h3>
        <p class="text-gray-500 mt-2">Try adjusting your filters to find what you're looking for.</p>
      </div>
    `;
    return;
  }
  
  DOMElements.productGrid.innerHTML = paginatedProducts.map(renderProductCard).join('');
}

function renderPagination() {
  const totalPages = Math.ceil(state.filteredProducts.length / PRODUCTS_PER_PAGE);
  if (totalPages <= 1) {
    DOMElements.paginationContainer.innerHTML = '';
    return;
  }

  let paginationHTML = `
    <div class="flex-1 flex justify-start">
      <button data-page="${state.currentPage - 1}" class="pagination-btn relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ${state.currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}" ${state.currentPage === 1 ? 'disabled' : ''}>
        Previous
      </button>
    </div>
    <div class="hidden md:flex justify-center">`;

    const maxPagesToShow = 5;
    let startPage = Math.max(1, state.currentPage - Math.floor(maxPagesToShow / 2));
    let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);
    if (endPage - startPage + 1 < maxPagesToShow) {
        startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }
    
    if (startPage > 1) {
        paginationHTML += `<button data-page="1" class="pagination-btn relative inline-flex items-center px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</button>`;
        if (startPage > 2) {
            paginationHTML += `<span class="relative inline-flex items-center px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `
        <button data-page="${i}" class="pagination-btn relative inline-flex items-center px-4 py-2 border-t border-b border-gray-300 text-sm font-medium ${state.currentPage === i ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50'}">
            ${i}
        </button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationHTML += `<span class="relative inline-flex items-center px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>`;
        }
        paginationHTML += `<button data-page="${totalPages}" class="pagination-btn relative inline-flex items-center px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">${totalPages}</button>`;
    }
  paginationHTML += `
    </div>
    <div class="flex-1 flex justify-end">
      <button data-page="${state.currentPage + 1}" class="pagination-btn ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ${state.currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}" ${state.currentPage === totalPages ? 'disabled' : ''}>
        Next
      </button>
    </div>
  `;
  DOMElements.paginationContainer.innerHTML = paginationHTML;
}

// --- LOGIC ---

function applyFiltersAndRender() {
  DOMElements.productGrid.classList.add('hidden');
  DOMElements.loader.style.display = 'flex';

  setTimeout(() => {
    // 1. Get base products for the current subcategory
    let productsToFilter = state.products.filter(p => p.subcategory === state.selectedSubcategoryId);

    // 2. Get filter values from DOM
    state.filters.brands = Array.from(document.querySelectorAll('#brand-filters input[name="brand"]:checked')).map(el => el.value);
    state.filters.minPrice = Number(DOMElements.minPriceInput.value);
    state.filters.maxPrice = Number(DOMElements.maxPriceInput.value);
    state.filters.sort = DOMElements.sortSelect.value;
    
    // 3. Apply filters
    if (state.filters.brands.length > 0) {
      productsToFilter = productsToFilter.filter(p => state.filters.brands.includes(p.brand));
    }
    productsToFilter = productsToFilter.filter(p => p.price >= state.filters.minPrice && p.price <= state.filters.maxPrice);

    // 4. Sort
    productsToFilter.sort((a, b) => {
      switch (state.filters.sort) {
        case 'price_asc': return a.price - b.price;
        case 'price_desc': return b.price - a.price;
        case 'name_desc': return b.name.localeCompare(a.name);
        case 'name_asc': default: return a.name.localeCompare(b.name);
      }
    });
    
    state.filteredProducts = productsToFilter;
    state.currentPage = 1; // Reset to page 1 whenever filters change

    // 5. Render everything
    renderProducts();
    renderPagination();
  }, 300);
}

const updateView = () => {
    // Hide all views
    Object.values(DOMElements).forEach(el => {
        if (el && el.classList.contains('view-container')) {
            el.classList.remove('active');
        }
    });

    renderBreadcrumbs();

    switch(state.currentView) {
        case 'subcategories':
            renderSubcategoriesView();
            DOMElements.subcategoryView.classList.add('active');
            break;
        case 'products':
            renderProductListView();
            DOMElements.productView.classList.add('active');
            break;
        case 'categories':
        default:
            renderCategoriesView();
            DOMElements.categoryView.classList.add('active');
            break;
    }
};


// --- EVENT LISTENERS ---

function addEventListeners() {
    DOMElements.app.addEventListener('click', (e) => {
        const categoryCard = e.target.closest('.category-card');
        const subcategoryCard = e.target.closest('.subcategory-card');
        const breadcrumbLink = e.target.closest('.breadcrumb-link');
        const paginationBtn = e.target.closest('.pagination-btn');

        if (categoryCard) {
            state.selectedCategoryId = categoryCard.dataset.categoryId;
            state.selectedSubcategoryId = null;
            state.currentView = 'subcategories';
            updateView();
        } else if (subcategoryCard) {
            state.selectedSubcategoryId = subcategoryCard.dataset.subcategoryId;
            state.currentView = 'products';
            updateView();
        } else if (breadcrumbLink) {
            e.preventDefault();
            const view = breadcrumbLink.dataset.view;
            if (view === 'categories') {
                state.selectedCategoryId = null;
                state.selectedSubcategoryId = null;
            } else if (view === 'subcategories') {
                 state.selectedSubcategoryId = null;
            }
            state.currentView = view;
            updateView();
        } else if (paginationBtn && !paginationBtn.disabled) {
            state.currentPage = Number(paginationBtn.dataset.page);
            renderProducts();
            renderPagination();
            window.scrollTo(0, DOMElements.productView.offsetTop);
        }
    });

    // Event listeners for product view filters
    const productFilterHandler = () => {
        state.currentPage = 1;
        applyFiltersAndRender();
    };
    
    DOMElements.brandFilters.addEventListener('change', productFilterHandler);
    DOMElements.minPriceInput.addEventListener('change', productFilterHandler);
    DOMElements.maxPriceInput.addEventListener('change', productFilterHandler);
    DOMElements.sortSelect.addEventListener('change', productFilterHandler);
}

// --- INITIALIZATION ---
document.addEventListener('DOMContentLoaded', () => {
  addEventListeners();
  updateView(); // Initial render
});

    </script>
</body>
</html>