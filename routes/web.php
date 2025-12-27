<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BerandaController::class, 'berandaFrontend'])->name('beranda');

Route::get('/login', [BerandaController::class, 'loginPage'])->name('login');

Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

Route::get('/keranjang', [CartController::class, 'view'])->name('cart.view');
Route::post('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/beli/{id}', [CheckoutController::class, 'checkout'])->name('checkout.page')->middleware('auth');
Route::post('/beli/proses', [CheckoutController::class, 'process'])->name('checkout.process')->middleware('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');

Route::get('/admin', [AdminController::class, 'admin'])->name('admin')->middleware('auth');
Route::get('/admin/pesanan', [AdminController::class, 'orders'])->name('admin.orders')->middleware('auth');
Route::get('/admin/produk', [AdminController::class, 'produk'])->name('admin.produk')->middleware('auth');

Route::get('/admin/produk/add', [AdminController::class, 'create'])->name('admin.produk.create')->middleware('auth');
Route::post('/admin/produk/store', [AdminController::class, 'store'])->name('admin.produk.store')->middleware('auth');
Route::get('/admin/produk/edit/{id}', [AdminController::class, 'edit'])->name('admin.produk.edit')->middleware('auth');
Route::put('/admin/produk/update/{id}', [AdminController::class, 'update'])->name('admin.produk.update')->middleware('auth');
Route::delete('/admin/produk/remove/{id}', [AdminController::class, 'remove'])->name('admin.produk.remove')->middleware('auth');

Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');

Route::get('/syarat-ketentuan', [BerandaController::class, 'syaratketentuan'])->name('syarat-ketentuan');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

Route::middleware('auth')->group(function() {
    Route::get('/admin/pelanggan', [AdminController::class, 'pelanggan'])->name('admin.pelanggan');
    Route::get('/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/pdf', [OrderController::class, 'pdf'])->name('orders.pdf');

    Route::get('/likes', [ProdukController::class, 'liked'])->name('likes.index');
    Route::post('/produk/{id}/like', [ProdukController::class, 'like'])->name('product.like');

    Route::post('/produk/{id}/rating', [ProdukController::class, 'rating'])->name('produk.rating');
    
    Route::get('/admin/ratings', [RatingController::class, 'index'])->name('admin.ratings.index');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('kategori', KategoriController::class)
        ->names('admin.kategori');
});




Route::post('/logout', function(){
    Auth::logout();
    return redirect()->route('beranda');
})->name('logout');