<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VariationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    // Products
    Route::post('/add-product', [ProductController::class, 'addProduct']);    
    Route::post('/delete-product/{id}', [ProductController::class, 'deleteProduct']);    
    Route::get('/all-product', [ProductController::class, 'allProducts']);    
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct']);   
    Route::get('/single-product/{id}', [ProductController::class, 'singleProduct']);   
    
    // Category
    Route::post('/add-category', [CategoryController::class, 'addCategory']); 
    Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);    
    Route::post('/edit-category/{id}', [CategoryController::class, 'editCategory']);    
    Route::get('/all-category', [CategoryController::class, 'allCategory']);    

    
    // Variation
    Route::post('/add-variation', [VariationController::class, 'addVariation']); 
    Route::post('/delete-variation/{id}', [VariationController::class, 'deleteVariation']);    
    Route::post('/edit-variation/{id}', [VariationController::class, 'editVariation']);    
    Route::get('/all-variation', [VariationController::class, 'allVariation']);    
   
});
