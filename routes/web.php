<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrganizationController as UserOrganizationController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Organization_Admin\DashboardController;
use App\Http\Controllers\Organization_Admin\OrganizationAdminController;
use App\Http\Controllers\Organization_Admin\ProductController as OrgProductController;
use App\Http\Controllers\Organization_Admin\EventController as OrgEventController;
use App\Http\Controllers\Organization_Admin\ArticleController as OrgArticleController;
use App\Http\Controllers\Organization_Admin\OrganizationInvoiceController;

// Authentication Routes
Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Products
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    // Categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Organizations
    Route::get('/admin/organizations', [AdminOrganizationController::class, 'index'])->name('admin.organizations.index');
    Route::get('/admin/organizations/create', [AdminOrganizationController::class, 'create'])->name('admin.organizations.create');
    Route::post('/admin/organizations', [AdminOrganizationController::class, 'store'])->name('admin.organizations.store');
    Route::get('/admin/organizations/{id}/edit', [AdminOrganizationController::class, 'edit'])->name('admin.organizations.edit');
    Route::put('/admin/organizations/{id}', [AdminOrganizationController::class, 'update'])->name('admin.organizations.update');
    Route::delete('/admin/organizations/{id}', [AdminOrganizationController::class, 'destroy'])->name('admin.organizations.destroy');

    // Events
    Route::get('/admin/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/admin/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/admin/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/admin/events/{id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/admin/events/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


    // Articles
    Route::get('/admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/admin/articles/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/admin/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/admin/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/admin/articles/{id}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/admin/articles/{id}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');
});


// User Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', function () {return view('user.dashboard');})->name('user.dashboard');
    
    Route::get('/organizations', [UserOrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/organizations/{id}', [UserOrganizationController::class, 'show'])->name('organizations.show');
    
    Route::get('/events/{id}', [UserEventController::class, 'show'])->name('events.show');
    Route::get('/articles/{id}', [UserArticleController::class, 'show'])->name('articles.show');
    
    Route::get('/organizations/{organizationId}/catalog', [ProductController::class, 'catalog'])->name('organizations.catalog');
    
    Route::get('/user/cart', [CartController::class, 'cart'])->name('user.cart');
    Route::post('/user/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::post('/user/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');
    
    
    Route::post('/user/checkout', [CheckoutController::class, 'checkout'])->name('user.checkout');
    Route::post('/user/checkout/process', [CheckoutController::class, 'processCheckout'])->name('user.checkout.process');
    Route::get('/user/checkout/view', [CheckoutController::class, 'viewCheckout'])->name('user.checkout.view');
    
    Route::get('/user/invoice/{id}', [CheckoutController::class, 'invoice'])->name('user.invoice');
    Route::get('/user/history', [CheckoutController::class, 'history'])->name('user.history');
});


Route::middleware(['auth', 'organization_admin'])->group(function () {
    Route::get('/organization_admin/dashboard', [OrganizationAdminController::class, 'dashboard'])
        ->name('organization_admin.dashboard');
    Route::get('/organization/profile/edit', [OrganizationAdminController::class, 'editProfile'])->name('organization_admin.profile.edit');
    Route::post('/organization/profile/update', [OrganizationAdminController::class, 'updateProfile'])->name('organization_admin.profile.update');
    
    // Products
    Route::get('/organization/products', [OrgProductController::class, 'index'])->name('organization_admin.products.index');
    Route::get('/organization/products/create', [OrgProductController::class, 'create'])->name('organization_admin.products.create');
    Route::post('/organization/products', [OrgProductController::class, 'store'])->name('organization_admin.products.store');
    Route::get('/organization/products/{id}/edit', [OrgProductController::class, 'edit'])->name('organization_admin.products.edit');
    Route::put('/organization/products/{id}', [OrgProductController::class, 'update'])->name('organization_admin.products.update');
    Route::delete('/organization/products/{id}', [OrgProductController::class, 'destroy'])->name('organization_admin.products.destroy');

    // Events
    Route::get('/organization/events', [OrgEventController::class, 'index'])->name('organization_admin.events.index');
    Route::get('/organization/events/create', [OrgEventController::class, 'create'])->name('organization_admin.events.create');
    Route::post('/organization/events', [OrgEventController::class, 'store'])->name('organization_admin.events.store');
    Route::get('/organization/events/{id}/edit', [OrgEventController::class, 'edit'])->name('organization_admin.events.edit');
    Route::put('/organization/events/{id}', [OrgEventController::class, 'update'])->name('organization_admin.events.update');
    Route::delete('/organization/events/{id}', [OrgEventController::class, 'destroy'])->name('organization_admin.events.destroy');

    // Articles
    Route::get('/organization/articles', [OrgArticleController::class, 'index'])->name('organization_admin.articles.index');
    Route::get('/organization/articles/create', [OrgArticleController::class, 'create'])->name('organization_admin.articles.create');
    Route::post('/organization/articles', [OrgArticleController::class, 'store'])->name('organization_admin.articles.store');
    Route::get('/organization/articles/{id}/edit', [OrgArticleController::class, 'edit'])->name('organization_admin.articles.edit');
    Route::put('/organization/articles/{id}', [OrgArticleController::class, 'update'])->name('organization_admin.articles.update');
    Route::delete('/organization/articles/{id}', [OrgArticleController::class, 'destroy'])->name('organization_admin.articles.destroy');

    // Invoices
    Route::get('/organization/invoices', [OrganizationInvoiceController::class, 'index'])->name('organization_admin.invoices.index');
    Route::get('/organization/invoices/{id}', [OrganizationInvoiceController::class, 'show'])->name('organization_admin.invoices.show');
});