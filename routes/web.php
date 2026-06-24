<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ListUserController;
use App\Http\Controllers\Admin\ListProductController;
use App\Http\Controllers\Admin\HistoryController;


// Frontend Controllers
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BlogMemberController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\AccountConTroller;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\MailController;

// Auth Controller
use App\Http\Controllers\Auth\LoginController;
Auth::routes(['reset' => true]);
// ==================== FRONTEND AUTH ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

// ==================== ADMIN AUTH ====================
Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

// ==================== ADMIN (cần guard admin) ====================
Route::prefix('admin')->middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'GetDashboard'])->name('dashboard');

    // Profile
    Route::get('/page-profile', [ProfileController::class, 'GetUsers'])->name('page-profile');
    Route::post('/page-profile', [ProfileController::class, 'update'])->name('page-profile.update');

    // Country
    Route::get('/country', [CountryController::class, 'list'])->name('country');
    Route::get('/addcountry', [CountryController::class, 'add'])->name('country.add');
    Route::post('/addcountry', [CountryController::class, 'create'])->name('country.create');
    Route::get('/editcountry/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::post('/editcountry/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::get('/deletecountry/{id}', [CountryController::class, 'delete'])->name('country.delete');

    // Blog
    Route::get('/blog', [BlogController::class, 'GetBlog'])->name('blog.list');
    Route::get('/addblog', [BlogController::class, 'AddBlog'])->name('blog.add');
    Route::post('/addblog', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/editblog/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/editblog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/deleteblog/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    // Category
    Route::get('/category', [CategoryController::class, 'showCategory'])->name('category.list');
    Route::get('/addcategory', [CategoryController::class, 'addCategory'])->name('category.add');
    Route::post('/createcategory', [CategoryController::class, 'createCategory'])->name('category.create');
    Route::get('/editcategory/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/editcategory/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/deletecategory/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // Brand
    Route::get('/brand', [BrandController::class, 'showBrand'])->name('brand.list');
    Route::get('/addbrand', [BrandController::class, 'add'])->name('brand.add');
    Route::post('/addbrand', [BrandController::class, 'create'])->name('brand.create');
    Route::get('/editbrand/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/editbrand/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/deletebrand/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    //List-User
    Route::get('/list-user',[ListUserController::class,'listUser'])->name('list-user');
    Route::get('/edit-list/{id}',[ListUserController::class,'edit'])->name('edit.list-user');
    Route::post('/edit-list/{id}',[ListUserController::class,'update'])->name('update.list-user');
    Route::get('/deleteUser/{id}',[ListUserController::class,'delete'])->name('delete.list-user');

    //List-Product
    Route::get('/products', [ListProductController::class, 'listProduct'])->name('product.list');
    Route::delete('/products/{id}', [ListProductController::class, 'delete'])->name('product.delete');
    Route::get('/products/{id}/edit', [ListProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}/update', [ListProductController::class, 'update'])->name('product.update');

    //History
    Route::get('/history',[HistoryController::class,'historyList'])->name('history.list');

});

// ==================== FRONTEND ====================
Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
Route::get('/shop', [ShopController::class, 'shoplist'])->name('frontend.shop');

// Blog
Route::get('/blog', [BlogMemberController::class, 'getblog'])->name('member.blog.list');
Route::get('/blog-detail/{id}', [BlogMemberController::class, 'getblogDetail'])->name('member.blog.detail');
Route::post('/blog/rate', [BlogController::class, 'rate'])->name('blog.rate')->middleware('auth');

// Comment
Route::post('/comment', [CommentController::class, 'storeComment'])->name('comment.store')->middleware('auth');

// Product
Route::get('/product-detail/{id}', [ProductDetailController::class, 'detail'])->name('product.detail');

// Cart (public)
Route::get('/cart/index', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');

// Cần đăng nhập member
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountConTroller::class, 'showAccount'])->name('account');
    Route::post('/account/update', [AccountConTroller::class, 'updateAccount'])->name('account.update');

    Route::get('/my-product', [ProductController::class, 'showProduct'])->name('myproduct');
    Route::get('/addproduct', [ProductController::class, 'showCreate'])->name('product.create');
    Route::post('/addproduct', [ProductController::class, 'update'])->name('member.product.update');
    Route::delete('/deleteproduct/{id}', [ProductController::class, 'delete'])->name('member.product.delete');
    Route::get('/editproduct/{id}', [ProductController::class, 'showEdit'])->name('member.product.edit');
    Route::post('/editproduct/{id}', [ProductController::class, 'edit'])->name('member.product.edit.update');

    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/order/send', [MailController::class, 'sendOrder'])->name('order.send');
});

Route::get('/mail', [MailController::class, 'sendOrder'])->name('mail.notify');