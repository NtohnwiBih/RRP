<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SubscriptionController;
use App\Http\Controllers\Backend\User\AdminController;
use App\Http\Controllers\Backend\LandController;
use App\Http\Controllers\Backend\HouseController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\StudioController;
use App\Http\Controllers\Backend\ApartmentController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\BikeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\FavoriteController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;

Route::get('/', [FrontendController::class, 'index'])->name('home'); 
Route::get('about', [FrontendController::class, 'about'])->name('about'); 
Route::get('properties/rent', [FrontendController::class, 'rent'])->name('properties.rent'); 
Route::get('properties/buy', [FrontendController::class, 'buy'])->name('properties.buy');
Route::get('properties/{type}', [FrontendController::class, 'showPropertiesByType'])->name('properties.type');
Route::get('properties/house/{type}', [FrontendController::class, 'showPropertiesByHouseType'])->name('properties.house.type');
Route::get('properties/vehicle/{type}', [FrontendController::class, 'showPropertiesByVehicleType'])->name('properties.vehicle.type');
Route::get('properties/{city}', [FrontendController::class, 'showPropertiesByCity'])->name('properties.city');
Route::get('property/{id}', [FrontendController::class, 'propertyDetail'])->name('propertyDetail');
Route::post('property/search', [SearchController::class, 'index'])->name('search');
Route::get('blog', [FrontendController::class, 'blog'])->name('blog'); 
Route::get('blog/{id}', [FrontendController::class, 'blogDetail'])->name('blogDetail');

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::prefix('admin')->group(function (){  
    /**
     * Auth
     */
    Route::get('/', [AuthenticationController::class, 'auth'])->name('login');
    Route::post('login', [AuthenticationController::class, 'store'])->name('authenticate');
    Route::get('logout', [AuthenticationController::class, "logout"])->name('logout');

    /**
     * Register
     */
    Route::get('/check-username', [RegistrationController::class, 'checkUsername']);
    Route::get('register', [RegistrationController::class, 'register'])->name('register');
    Route::post('register', [RegistrationController::class, 'registerUser'])->name('register-user');

    /**
     * Subscription
     */
    Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('payment/basic', [SubscriptionController::class, 'paymentBasic'])->name('paymentBasic');
    Route::get('payment/premuim', [SubscriptionController::class, 'paymentPremuim'])->name('paymentPremuim');
    Route::post('payment', [SubscriptionController::class, 'paymentStore'])->name('paymentStore');

    Route::middleware('auth')->group(function () {
        Route::get('language/{locale}', function ($locale) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        });
        // profile
        Route::get('profile', [AdminController::class, 'adminProfile'])->name('profile');
        Route::post('profile/update_info', [AdminController::class, 'updateInfo'])->name('profile-info-update');
        Route::post('profile/update_image', [AdminController::class, 'updateImage'])->name('profile-image-update');
        Route::post('profile/update_password', [AdminController::class, 'updatePassword'])->name('profile-password-update');

              //properties
            Route::get('properties', [PropertyController::class, 'index'])->name('favorite.index');
            Route::resource('land', LandController::class);
            Route::get('house', [HouseController::class, 'index'])->name('house.index');
            Route::get('house/create', [HouseController::class, 'create'])->name('house.create');
            Route::get('house/edit', [HouseController::class, 'edit'])->name('house.edit');
            Route::resource('room', RoomController::class);
            Route::resource('studio', StudioController::class);
            Route::resource('apartment', ApartmentController::class);
            Route::get('vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
            Route::get('vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
            Route::get('vehicle/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
            Route::resource('car', CarController::class);
            Route::resource('bike', BikeController::class);
            Route::post('activate_property', [PropertyController::class, 'propertyActivate'])->name('activate-property');
            Route::post('remove_property', [PropertyController::class, 'propertyRemove'])->name('property-remove');
        /**
         * Admin routes
         */
        Route::middleware('auth.role:admin')->group(function (){
            Route::get('language/{locale}', function ($locale) {
                app()->setLocale($locale);
                session()->put('locale', $locale);
                return redirect()->back();
            });
            Route::get('properties', [FavoriteController::class, 'index'])->name('property.index')->middleware('admin');
            Route::resource('post', PostController::class);
            Route::post('activate_post', [PostController::class, 'postActivate'])->name('activate-post');
            Route::controller(AdminController::class)->group(function (){

                // agents
                Route::view('agents', 'admin.all_agents', ['data' => User::where('role', '=', 'vendor')->get()])->name('agent-list');
                Route::post('activate_agent', 'agentActivate')->name('activate-agent');
                Route::post('remove_agent', 'userRemove')->name('agent-remove');
            });
        });
    });
});