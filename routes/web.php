<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//LANDING
Route::get('/', 'App\Http\Controllers\WelcomeController@index');

//LOGIN
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');

//REGISTER
Route::get('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/registerProses', 'App\Http\Controllers\AuthController@registerProses');

//PRODUK DEPAN
Route::get('/produk-detail/{id}', 'App\Http\Controllers\ProdukController@detail');
Route::get('/produk', 'App\Http\Controllers\ProdukController@show');
// Route::get('/produk/search', 'App\Http\Controllers\ProdukController@show');

//PRODUK DEPAN
Route::get('/berita-detail/{id}', 'App\Http\Controllers\BeritaController@detail');
Route::get('/berita', 'App\Http\Controllers\BeritaController@show');

//DISKUSI DATA DEPAN
Route::get('/back/diskusi-produk/{id}', 'App\Http\Controllers\DiskusiProdukController@dataDetail');
Route::get('/back/diskusi-berita/{id}', 'App\Http\Controllers\DiskusiBeritaController@dataDetail');

//PROFIL DEPAN
Route::get('/profil/{id}', 'App\Http\Controllers\UserProfilController@show');


//GOOGLE SIGN IN
Route::get('/auth/redirect', 'App\Http\Controllers\AuthController@redirectToProvider');
Route::get('/auth/callback', 'App\Http\Controllers\AuthController@handleProviderCallback');

//BACKEND
Route::group(['middleware' => 'auth'], function () {

    //DASHBOARD
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

    Route::group(['middleware' => 'checkRole:Admin'], function () {

        //USER
        Route::get('/back/user', 'App\Http\Controllers\UserController@index');
        Route::get('/back/data-user', 'App\Http\Controllers\UserController@data');
        Route::post('/back/store-user', 'App\Http\Controllers\UserController@store');
        Route::post('/back/update-user', 'App\Http\Controllers\UserController@update');
        Route::post('/back/delete-user', 'App\Http\Controllers\UserController@delete');

        //SLIDER
        Route::get('/back/slider', 'App\Http\Controllers\SliderController@index');
        Route::get('/back/data-slider', 'App\Http\Controllers\SliderController@data');
        Route::post('/back/store-slider', 'App\Http\Controllers\SliderController@store');
        Route::post('/back/update-slider', 'App\Http\Controllers\SliderController@update');
        Route::post('/back/delete-slider', 'App\Http\Controllers\SliderController@delete');

        //PRODUCT
        Route::get('/back/product', 'App\Http\Controllers\ProdukController@index');
        Route::get('/back/data-product', 'App\Http\Controllers\ProdukController@data');
        Route::post('/back/store-product', 'App\Http\Controllers\ProdukController@store');
        Route::post('/back/update-product', 'App\Http\Controllers\ProdukController@update');
        Route::post('/back/delete-product', 'App\Http\Controllers\ProdukController@delete');
        Route::post('/back/pilihan-UKM-product', 'App\Http\Controllers\ProdukController@pilihanUKM');

        //DETAIL PRODUCT
        Route::get('/back/detail-product/{id}', 'App\Http\Controllers\DetailProdukController@index');
        Route::get('/back/data-detail-product/{id}', 'App\Http\Controllers\DetailProdukController@data');
        Route::get('/back/create-detail-product/{id}', 'App\Http\Controllers\DetailProdukController@create');
        Route::post('/back/store-detail-product/{id}', 'App\Http\Controllers\DetailProdukController@store');
        Route::get('/back/edit-detail-product/{id}', 'App\Http\Controllers\DetailProdukController@edit');
        Route::post('/back/update-detail-product/{id}', 'App\Http\Controllers\DetailProdukController@update');
        Route::post('/back/delete-detail-product', 'App\Http\Controllers\DetailProdukController@delete');

        Route::get('/back/get-content/{id}', 'App\Http\Controllers\DetailProdukController@getData');

        //BERITA
        Route::get('/back/beritas', 'App\Http\Controllers\BeritaController@index');
        Route::get('/back/data-berita', 'App\Http\Controllers\BeritaController@data');
        Route::get('/back/create-berita', 'App\Http\Controllers\BeritaController@create');
        Route::post('/back/store-berita', 'App\Http\Controllers\BeritaController@store');
        Route::get('/back/edit-berita/{id}', 'App\Http\Controllers\BeritaController@edit');
        Route::post('/back/update-berita', 'App\Http\Controllers\BeritaController@update');
        Route::post('/back/delete-berita', 'App\Http\Controllers\BeritaController@delete');

        //DISKUSI PRODUK
        Route::get('/back/diskusi-produk', 'App\Http\Controllers\DiskusiProdukController@index');
        Route::get('/back/data-diskusi-produk', 'App\Http\Controllers\DiskusiProdukController@data');
        Route::post('/back/update-diskusi-produk', 'App\Http\Controllers\DiskusiProdukController@update');
        Route::post('/back/delete-diskusi-produk', 'App\Http\Controllers\DiskusiProdukController@delete');

        //DISKUSI BERITA
        Route::get('/back/diskusi-berita', 'App\Http\Controllers\DiskusiBeritaController@index');
        Route::get('/back/data-diskusi-berita', 'App\Http\Controllers\DiskusiBeritaController@data');
        Route::post('/back/store-diskusi-berita', 'App\Http\Controllers\DiskusiBeritaController@store');
        Route::post('/back/update-diskusi-berita', 'App\Http\Controllers\DiskusiBeritaController@update');
        Route::post('/back/delete-diskusi-berita', 'App\Http\Controllers\DiskusiBeritaController@delete');

        //USER PROFIL
        Route::get('/back/profil-{id}', 'App\Http\Controllers\UserProfilController@detail');
        Route::post('/back/store-profil', 'App\Http\Controllers\UserProfilController@store');

        //CART
        Route::get('/back/cart', 'App\Http\Controllers\CartController@adminCart');

        //TAGIHAN
        Route::get('/back/tagihan', 'App\Http\Controllers\TagihanController@adminTagihan');
        Route::get('/back/bayar/{id}', 'App\Http\Controllers\TagihanController@bayarTagihan');
    });

    //DISKUSI
    Route::post('/back/store-diskusi-produk', 'App\Http\Controllers\DiskusiProdukController@store');

    //ACCOUNT
    Route::get('/account/{id}', 'App\Http\Controllers\AccountController@index');
    Route::post('/store-account', 'App\Http\Controllers\AccountController@store');

    //CART
    Route::get('/cart', 'App\Http\Controllers\CartController@index');
    Route::post('/store-cart', 'App\Http\Controllers\CartController@store');
    Route::get('/get-cart-notif', 'App\Http\Controllers\CartController@getCartNotif');
    Route::get('/get-cart-user', 'App\Http\Controllers\CartController@getCartUser');
    Route::post('/delete-cart', 'App\Http\Controllers\CartController@delete');
    
    //TRANSAKSI
    Route::get('/transaksi', 'App\Http\Controllers\TagihanController@index');
    Route::get('/data-transaksi-user', 'App\Http\Controllers\TagihanController@dataTransaksiUser');
    Route::get('/data-detail-transaksi-user/{id}', 'App\Http\Controllers\TagihanController@dataDetailTransaksiUser');
    Route::get('/print-invoice/{id}', 'App\Http\Controllers\TagihanController@printInvoice');
    Route::post('/store-tagihan', 'App\Http\Controllers\TagihanController@store');

    //USER PRODUK
    Route::get('/user-produk', 'App\Http\Controllers\UserProdukController@index');

    //BELAJAR
    Route::get('/belajar/{id}', 'App\Http\Controllers\BelajarController@index');

});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
