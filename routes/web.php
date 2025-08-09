<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Public Routes
 * |--------------------------------------------------------------------------
 */
Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Search
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/categories', [SearchController::class, 'categories'])->name('search.categories');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Frontend Product/Brand/Category Routes
Route::get('/category/{slug}', [FrontendController::class, 'productsByCategory'])->name('category.products');
Route::get('/brand/{slug}', [FrontendController::class, 'productsByBrand'])->name('brand.products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/subcategory/{slug}', [SubcategoryController::class, 'show'])->name('subcategory.show');

/*
 * |--------------------------------------------------------------------------
 * | Authenticated Routes
 * |--------------------------------------------------------------------------
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    /*
     * |--------------------------------------------------------------------------
     * | Admin Routes (All under /admin)
     * |--------------------------------------------------------------------------
     */
    Route::prefix('admin')->group(function () {
        // Features
        Route::resource('features', FeatureController::class);
        Route::post('features/bulk-delete', [FeatureController::class, 'bulkDelete'])->name('features.bulkDelete');

        // Promos
        Route::resource('promos', PromoController::class);
        Route::post('promos/bulk-delete', [PromoController::class, 'bulkDelete'])->name('promos.bulkDelete');

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);
        Route::post('testimonials/bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonials.bulkDelete');

        // Blog Posts
        Route::resource('blog-posts', BlogPostController::class);

        // Brands
        Route::resource('brands', BrandController::class)->except(['show']);
        Route::get('brands/list', [BrandController::class, 'list'])->name('brands.list');
        Route::post('brands/{brand}/toggle-popular', [BrandController::class, 'togglePopular'])->name('brands.toggle-popular');
        Route::post('brands/bulk-actions', [BrandController::class, 'bulkActions'])->name('brands.bulk-actions');

        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/list', [ProductController::class, 'list'])->name('list');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}', [ProductController::class, 'show'])->name('show');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
            Route::post('/update-status', [ProductController::class, 'updateStatus'])->name('updateStatus');
            Route::post('/bulk-delete', [ProductController::class, 'bulkDelete'])->name('bulk-delete');
            Route::get('/featured', [ProductController::class, 'featured'])->name('featured');
            Route::post('/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('toggle-featured');
        });

        // Categories/Subcategories
        Route::resource('categories', CategoryController::class);
        Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
        Route::resource('subcategories', SubcategoryController::class);
        Route::get('subcategories/{subcategory}/products', [ProductController::class, 'subcategoryProducts'])
            ->name('subcategory.products');
    });

    /*
     * |--------------------------------------------------------------------------
     * | Frontend User Pages (Authenticated)
     * |--------------------------------------------------------------------------
     */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/allproducts', [PageController::class, 'allproducts'])->name('allproducts');
    Route::get('/get-brands-by-categories', [PageController::class, 'getBrandsByCategories'])->name('get.brands.by.categories');
    Route::get('/product/{id}', [PageController::class, 'productDetails'])->name('productdetails');
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [PageController::class, 'orders'])->name('orders');
    Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

    /*
     * |--------------------------------------------------------------------------
     * | Frontend Preview Routes
     * |--------------------------------------------------------------------------
     */
    Route::get('/cate', [FrontendController::class, 'allCate'])->name('allcate');
    Route::get('/cate/preview/{id}', [FrontendController::class, 'preview']);
    Route::get('/all-brands', [FrontendController::class, 'allBrands'])->name('allbrands');
    Route::get('/brand-preview/{id}', [FrontendController::class, 'previewBrand']);
    Route::get('/welcome', fn() => view('welcome'))->name('welcome');
});
