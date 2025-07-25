<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\FeatureController;
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

// Feature Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('features', FeatureController::class);
    Route::post('features/bulk-delete', [FeatureController::class, 'bulkDelete'])->name('features.bulkDelete');
});

// Promo
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('promos', PromoController::class);
    Route::post('promos/bulk-delete', [PromoController::class, 'bulkDelete'])->name('promos.bulkDelete');
});

// Testimonial Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('testimonials', TestimonialController::class);
    Route::post('/testimonials/bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonials.bulkDelete');
});

// Blog Post Routes
Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::resource('blog-posts', BlogPostController::class);
});

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 */
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/categories', [SearchController::class, 'categories'])->name('search.categories');

// Add these ID-based routes if not already added
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/subcategory/{id}', [SubcategoryController::class, 'show']);
Route::get('/brand/{id}', [BrandController::class, 'show']);

Route::get('/product/{id}', [ProductController::class, 'show']);

// 🔎 Used in HomeSearchController
// =====================

Route::get('/category/{slug}', [FrontendController::class, 'productsByCategory'])->name('category.products');

Route::get('/brand/{slug}', [FrontendController::class, 'productsByBrand'])->name('brand.products');

// =========================
// 🔐 Authentication Routes
// =========================
Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// 🔐 Protected Routes (Authenticated Users Only)
// ===============================
Route::middleware(['auth'])->group(function () {
    // =====================
    // 🧭 Dashboard Routes
    // =====================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', fn() => redirect()->route('dashboard'));

    // =====================
    // 🛠️ Admin Routes
    // =====================use App\Http\Controllers\BrandController;

    // routes/web.php (admin section)

    Route::prefix('admin')->group(function () {
        Route::resource('brands', BrandController::class)->except(['show']);
        Route::get('brands/list', [BrandController::class, 'list'])->name('brands.list');
        Route::post('brands/{brand}/toggle-popular', [BrandController::class, 'togglePopular'])->name('brands.toggle-popular');
        Route::post('brands/bulk-actions', [BrandController::class, 'bulkActions'])->name('brands.bulk-actions');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('products', ProductController::class);
    Route::post('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulkDelete');
    // Featured Products Logic
    Route::post('/products/save-featured', [ProductController::class, 'saveFeatured'])->name('products.saveFeatured');
    Route::prefix('admin')->group(function () {
        Route::get('/products/featured', [ProductController::class, 'featuredProducts'])->name('products.featured');
    });
    Route::post('/products/unfeature', [ProductController::class, 'unfeature'])->name('products.unfeature');

    // ... other routes ...
    // 🛍️ Frontend User Routes (Protected)
    // =====================

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/allproducts', action: [PageController::class, 'allproducts'])->name('allproducts');
    Route::get('/get-brands-by-categories', [PageController::class, 'getBrandsByCategories'])->name('get.brands.by.categories');

    Route::get('/product/{id}', [PageController::class, 'productDetails'])->name('product.details');
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [PageController::class, 'orders'])->name('orders');
    Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

    // =====================
    // 📂 Categories & Brands (Frontend)
    // =====================
    Route::get('/cate', [FrontendController::class, 'allCate'])->name('allcate');
    Route::get('/cate/preview/{id}', [FrontendController::class, 'preview']);
    Route::get('/all-brands', [FrontendController::class, 'allBrands'])->name('allbrands');
    Route::get('/brand-preview/{id}', [FrontendController::class, 'previewBrand']);

    // 🧪 Optional fallback or test
    Route::get('/welcome', fn() => view('welcome'))->name('welcome');
});
