
<main class="py-5">
    <!-- Breadcrumbs -->
    <div class="container px-4 mx-auto mb-6">
        <ol id="breadcrumb-container" class="flex items-center space-x-2 text-sm">
            <!-- Dynamic breadcrumbs will be injected here -->
        </ol>
    </div>
    
    <!-- Category View -->
    <div id="category-view" class="view-container">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Shop by Category</h2>
        <div id="category-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <div data-category-id="{{ $category->id }}" class="category-card group flex flex-col items-center text-center shadow-sm border p-4 rounded-xl cursor-pointer transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl border-gray-200 bg-white">
                <div class="w-full h-32 bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                </div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $category->name }}</h3>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- SubCategory View -->
    <div id="subcategory-view" class="view-container hidden">
        <h2 id="subcategory-title" class="text-3xl font-bold text-gray-800 mb-8 text-center"></h2>
        <div id="subcategory-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- SubCategory cards will be injected here -->
        </div>
    </div>
    
    <!-- Product View -->
    <div id="product-view" class="view-container hidden">
        <!-- Your existing product view HTML -->
    </div>
</main>



@push('scripts')
<script>
  $(document).ready(function() {
    <!-- // State management -->
    const state = {
        currentView: 'categories',
        selectedCategory: null,
        selectedSubcategory: null
    };

    <!-- // Initialize views -->
    function initViews() {
        $('.view-container').hide();
        $(`#${state.currentView}-view`).show();
    }

    <!-- // Render breadcrumbs -->
    function renderBreadcrumbs() {
        let html = `
            <li class="flex items-center">
                <a href="#" data-view="categories" class="breadcrumb-link hover:text-blue-600 hover:underline">Home</a>
            </li>
        `;
        
        const chevron = `
            <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
        `;

        if (state.selectedCategory) {
            html += chevron;
            if (state.currentView === 'products') {
                html += `
                    <li class="flex items-center">
                        <a href="#" data-view="subcategories" data-category-id="${state.selectedCategory.id}" class="breadcrumb-link hover:text-blue-600 hover:underline">${state.selectedCategory.name}</a>
                    </li>`;
            } else {
                html += `<li class="flex items-center"><span class="font-medium text-gray-700">${state.selectedCategory.name}</span></li>`;
            }
        }

        if (state.selectedSubcategory) {
            html += chevron;
            html += `<li class="flex items-center"><span class="font-medium text-gray-700">${state.selectedSubcategory.name}</span></li>`;
        }
        
        $('#breadcrumb-container').html(html);
    }

    <!-- // Handle category click -->
    $(document).on('click', '.category-card', function() {
        const categoryId = $(this).data('category-id');
        
        $.ajax({
            url: `/categories/${categoryId}`,
            method: 'GET',
            success: function(response) {
                state.selectedCategory = response.category;
                state.selectedSubcategory = null;
                state.currentView = 'subcategories';
                
                <!-- // Render subcategories -->
                $('#subcategory-title').text(`Shop in ${response.category.name}`);
                $('#subcategory-grid').html(
                    response.subcategories.map(subcategory => `
                        <div data-subcategory-id="${subcategory.id}" class="subcategory-card group flex flex-col items-center text-center shadow-sm border p-4 rounded-xl cursor-pointer transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border-gray-200 bg-white">
                            <h3 class="text-md font-semibold text-gray-700">${subcategory.name}</h3>
                        </div>
                    `).join('')
                );
                
                initViews();
                renderBreadcrumbs();
            },
            error: function(error) {
                console.error('Error loading category:', error);
            }
        });
    });

    <!-- // Handle subcategory click -->
    $(document).on('click', '.subcategory-card', function() {
        const subcategoryId = $(this).data('subcategory-id');
        
        $.ajax({
            url: `/subcategories/${subcategoryId}/products`,
            method: 'GET',
            success: function(response) {
                state.selectedSubcategory = response.subcategory;
                state.currentView = 'products';
                
                <!-- // Render products -->
                $('#product-list-title').text(response.subcategory.name);
                
                <!-- // Render brand filters -->
                $('#brand-filters').html(
                    response.brands.map(brand => `
                        <div class="flex items-center">
                            <input id="brand-${brand.id}" name="brand" type="checkbox" value="${brand.id}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 filter-checkbox">
                            <label for="brand-${brand.id}" class="ml-3 text-sm text-gray-600">${brand.name}</label>
                        </div>
                    `).join('')
                );
                
                <!-- // Render products -->
                renderProducts(response.products);
                
                initViews();
                renderBreadcrumbs();
            },
            error: function(error) {
                console.error('Error loading subcategory:', error);
            }
        });
    });

    <!-- // Handle breadcrumb navigation -->
    $(document).on('click', '.breadcrumb-link', function(e) {
        e.preventDefault();
        const targetView = $(this).data('view');
        
        state.currentView = targetView;
        if (targetView === 'categories') {
            state.selectedCategory = null;
            state.selectedSubcategory = null;
        } else if (targetView === 'subcategories') {
            state.selectedSubcategory = null;
        }
        
        initViews();
        renderBreadcrumbs();
    });

    <!-- // Product rendering function -->
    function renderProducts(products) {
        $('#product-grid').html(
            products.map(product => `
                <div class="group flex flex-col h-full bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative pt-[100%] bg-gray-50">
                        <img class="absolute top-0 left-0 w-full h-full object-contain p-4" src="${product.image_url}" alt="${product.name}" />
                        ${product.is_featured ? '<span class="absolute top-2 right-2 bg-yellow-400 text-yellow-900 text-xs font-semibold px-2 py-1 rounded-full">Featured</span>' : ''}
                    </div>
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="text-sm font-semibold text-gray-800 truncate" title="${product.name}">${product.name}</h3>
                        <p class="mt-1 text-xs text-gray-500 uppercase">${product.brand.name}</p>
                        <div class="mt-auto pt-2">
                            <p class="text-base font-bold text-gray-900">$${product.price.toFixed(2)}</p>
                            <button class="mt-2 w-full text-center bg-blue-600 text-white text-xs font-semibold py-2 px-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            `).join('')
        );
    }

    <!-- // Initialize the app -->
    initViews();
});
</script>
@endpush