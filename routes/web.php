<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminDashController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductSubCategoryController;

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

Route::get('/', function () {return view('index');});
Route::get('/single', function () {return view('single');});
Route::get('/shop', function () {return view('shop');});
Route::get('/gallery', function () {return view('gallery');});

Route::group(['prefix' => 'admin'],function(){
    
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });
    
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard', [AdminDashController::class,'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminDashController::class,'logout'])->name('admin.logout');

        //category routes
        Route::get('/categories',[CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create',[CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/',[CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}',[CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}',[CategoryController::class, 'destroy'])->name('admin.categories.delete');

        //subcategory routes
        Route::get('/subcategories',[SubCategoryController::class, 'index'])->name('admin.subcategories.index');
        Route::get('/subcategories/create',[SubCategoryController::class, 'create'])->name('admin.subcategories.create');
        Route::post('/subcategories/',[SubCategoryController::class, 'store'])->name('admin.subcategories.store');
        Route::get('/subcategories/{subcategory}/edit',[SubCategoryController::class, 'edit'])->name('admin.subcategories.edit');
        Route::put('/subcategories/{subcategory}',[SubCategoryController::class, 'update'])->name('admin.subcategories.update');
        Route::delete('/subcategories/{subcategory}',[SubCategoryController::class, 'destroy'])->name('admin.subcategories.delete');
        
        //brand routes
        Route::get('/brands/',[BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/brands/create',[BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands/',[BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/{brand}/edit',[BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/brands/{brand}',[BrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/{brand}',[BrandController::class, 'destroy'])->name('admin.brands.delete');

        //product routes
        Route::get('/products/create',[ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products/',[ProductController::class, 'store'])->name('admin.products.store');

        //product sub-categories route
        Route::get('/product-subcategories/',[ProductSubCategoryController::class, 'index'])->name('admin.product-subcategories.index');

        //temp-images.create's route
        Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');
        
        //getSlug 
        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);

        })->name('getSlug');


    });
});