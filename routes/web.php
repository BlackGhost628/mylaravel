<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController; // ← اضافه شد
use App\Http\Controllers\Admin\CommentController as AdminCommentController; // ← اضافه شد
use Illuminate\Support\Facades\Route;

// ========== صفحه اصلی ==========
Route::get('/', [ProductController::class, 'featured'])->name('home');

// ========== محصولات ==========
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ========== سبد خرید ==========
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart-page', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// ========== سفارش‌ها (با احراز هویت) ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// ========== صفحات عمومی ==========
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/team', function () { return view('team'); })->name('team');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ========== پروفایل ==========
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== پنل مدیریت (یک گروه واحد) ==========
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // داشبورد
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // مدیریت محصولات
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');
    
    // مدیریت پیام‌ها
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{id}', [AdminController::class, 'showContact'])->name('contacts.show');
    Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('contacts.delete');
    
    // مدیریت سفارش‌ها
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'adminShow'])->name('orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.delete');
    
    // مدیریت کاربران
    Route::get('/users', function () { return view('admin.users'); })->name('users');
    
    // ===== مدیریت مقالات =====
    // توجه: مسیرهای خاص (pending) قبل از مسیرهای عمومی ({id}) قرار می‌گیرند
    Route::get('/articles/pending', [ArticleController::class, 'pending'])->name('articles.pending');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::patch('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // ===== مدیریت نظرات (اضافه شده به گروه ادمین) =====
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/pending', [AdminCommentController::class, 'pending'])->name('comments.pending');
    Route::patch('/comments/{id}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

// ========== صفحات عمومی مقالات ==========
Route::get('/articles', [ArticleController::class, 'publicIndex'])->name('articles.public.index');
Route::get('/articles/{slug}', [ArticleController::class, 'publicShow'])->name('articles.public.show');

// ========== نظرات (عمومی - برای کاربران) ==========
Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// ========== داشبورد کاربری ==========
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
// ========== جستجوی مقالات (Ajax) ==========
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');


// ========== پیگیری سفارش ==========
Route::get('/track', [OrderController::class, 'trackForm'])->name('orders.track.form');
Route::get('/track/search', [OrderController::class, 'track'])->name('orders.track');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ========== احراز هویت ==========
require __DIR__.'/auth.php';