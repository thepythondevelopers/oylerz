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

/*Route::get('/', function () {
    return view('frontend.modules.dashboard');
});*/

Route::get('/service', 'Frontend\DashboardController@service')->name('frontend.service');


Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle')->name('google.auth');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook')->name('facebook.auth');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');


Route::get('/mail-test', 'Frontend\DashboardController@testemail')->name('mail.test');
Route::get('/tax', 'Frontend\DashboardController@check')->name('check');


Route::get('/', 'Frontend\DashboardController@dashboard')->name('dashboard');
Route::post('/frontend-step1', 'Frontend\DashboardController@step1')->name('frontend.step1');
Route::post('/frontend-step2', 'Frontend\DashboardController@step2')->name('frontend.step2');
Route::post('/frontend-step3', 'Frontend\DashboardController@step3')->name('frontend.step3');
Route::post('/frontend-step4', 'Frontend\DashboardController@step4')->name('frontend.step4');
Route::post('/frontend-step5', 'Frontend\DashboardController@step5')->name('frontend.step5');
Route::post('/frontend-step6', 'Frontend\DashboardController@step6')->name('frontend.step6');
Route::post('/frontend-coupon-check', 'Frontend\DashboardController@coupon_check')->name('frontend.coupon.check');

Route::post('/frontend-vendor_service/{id}', 'Frontend\DashboardController@vendor_service')->name('frontend.vendor_service');
Route::post('/frontend-schedule-save', 'Frontend\DashboardController@schedule_save')->name('frontend.schedule.save');

Route::get('/contact', 'Frontend\DashboardController@contact')->name('contact');
Route::post('/contact-save', 'Frontend\DashboardController@contact_save')->name('contact.save');
Route::get('/about', 'Frontend\DashboardController@about')->name('about');


Route::get('/store', 'Frontend\DashboardController@store')->name('store');
Route::post('/store-search', 'Frontend\DashboardController@store_search')->name('store.search');

Route::get('/blog', 'Frontend\DashboardController@blog')->name('blog');
Route::get('/blog-single/{slug}', 'Frontend\DashboardController@blog_slug')->name('blog-single');
Route::get('/coupon', 'Frontend\DashboardController@coupon')->name('coupon');
Route::post('/blog-comment/{id}', 'Frontend\DashboardController@blog_comment')->name('blog-comment');


Route::post('/blog-subscribe', 'Frontend\DashboardController@blog_subscribe')->name('blog.subscribe');

Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test', 'TestController@test')->name('frontend');
Route::get('/back-end', 'TestController@backend')->name('backend');
Route::get('/booking', 'TestController@booking')->name('booking');
Route::get('/garage', 'TestController@garage')->name('garage');

//====================================================
// User Routes
//===================================================
Route::post('/user-register', 'User\Auth\RegisterController@register')->name('user.register');
Route::post('/user-login', 'User\Auth\LoginController@login')->name('user.login');
//===================================================================
// Admin Routes Start
//===================================================================
Route::group(['prefix' => 'admin'], function () {
   Route::get('/login', 'Admin\Auth\LoginController@index')->name('admin.index');
   Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
   Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
   
   
});
Route::group(['middleware' => ['admin'],'prefix' => 'admin'], function () {
   Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
   Route::get('/dashboard-chart', 'Admin\DashboardController@get_chart')->name('admin.dashboard.chart');

   Route::get('/profile', 'Admin\DashboardController@profile')->name('admin.profile');
   Route::post('/profile-save', 'Admin\DashboardController@profile_save')->name('admin.profile.save');

   //Service Section Start//
   Route::get('/services', 'Admin\ServiceController@index')->name('admin.services');
   Route::post('/service-save', 'Admin\ServiceController@save')->name('admin.service.save');
   Route::get('/service-edit/{id}', 'Admin\ServiceController@edit')->name('admin.services.edit');
   Route::post('/service-update/{id}', 'Admin\ServiceController@update')->name('admin.services.update');
   Route::get('/sub-service-edit/{id}', 'Admin\ServiceController@sub_edit')->name('admin.services.sub.edit');
   Route::post('/sub-service-update/{id}', 'Admin\ServiceController@sub_update')->name('admin.services.sub.update');
   Route::post('/sub-service-delete/{id}', 'Admin\ServiceController@sub_delete')->name('admin.services.sub.delete');
   Route::get('/service-view/{id}', 'Admin\ServiceController@view')->name('admin.services.view');
   Route::delete('/service/{id}', 'Admin\ServiceController@delete')->name('admin.services.delete');    
   Route::post('/service/delete-all', 'Admin\ServiceController@bulk_delete')->name('admin.services.delete.all');    
   //Service Section End//

   //Profile Section Start//
   Route::get('/vendors', 'Admin\ProfileController@index')->name('admin.profiles');
   // Route::get('/profile-add', 'Admin\ProfileController@add')->name('admin.profile.add');
   Route::post('/vendor-save', 'Admin\ProfileController@save')->name('admin.profile.save');
   // Route::get('/profile-edit/{id}', 'Admin\ProfileController@edit')->name('admin.profile.edit');
   // Route::post('/profile-update/{id}', 'Admin\ProfileController@update')->name('admin.profile.update');
   Route::get('/vendor-view/{id}', 'Admin\ProfileController@view')->name('admin.profile.view');
   Route::post('/vendor-status/{id}', 'Admin\ProfileController@status')->name('admin.profile.status');
   Route::delete('/vendor/{id}', 'Admin\ProfileController@delete')->name('admin.profile.delete');    
   Route::post('/vendor/delete-all', 'Admin\ProfileController@bulk_delete')->name('admin.profile.delete.all');    
   //Profile Section End//



   //User Section Start//
   Route::get('/users', 'Admin\UserController@index')->name('admin.users');
   Route::get('/user-view/{id}', 'Admin\UserController@view')->name('admin.user.view');
   //User Section End//

      Route::get('/booking', 'Admin\BookingController@index')->name('admin.booking');
      Route::get('/booking-view/{id}', 'Admin\BookingController@view')->name('admin.booking.view');
   
      //Setting Section Start//
   Route::get('/setting', 'Admin\SettingController@index')->name('admin.setting');   
   Route::post('/setting-save', 'Admin\SettingController@save')->name('admin.setting.save');

         //Cms Section Start//
   Route::get('/cms', 'Admin\CmsController@index')->name('admin.cms');
   Route::get('/cms-edit/{id}', 'Admin\CmsController@edit')->name('admin.cms.edit');
   Route::post('/cms-update/{id}', 'Admin\CmsController@update')->name('admin.cms.update');

   //Blog Section Start//
   Route::get('/blog', 'Admin\BlogController@index')->name('admin.blog');    
   Route::get('/blog-add', 'Admin\BlogController@add')->name('admin.blog.add');
   Route::post('/blog-save', 'Admin\BlogController@save')->name('admin.blog.save'); 

   Route::get('/blog-edit/{id}', 'Admin\BlogController@edit')->name('admin.blog.edit');
   Route::post('/blog-update/{id}', 'Admin\BlogController@update')->name('admin.blog.update'); 

   Route::get('/blog-view/{id}', 'Admin\BlogController@view')->name('admin.blog.view');
    Route::delete('/blog/{id}', 'Admin\BlogController@delete')->name('admin.blog.delete');    
   Route::post('/blog/delete-all', 'Admin\BlogController@bulk_delete')->name('admin.blog.delete.all'); 

      //Cars Section Start//
   Route::get('/car', 'Admin\CarController@index')->name('admin.car');    
   Route::get('/car-add', 'Admin\CarController@add')->name('admin.car.add');
   Route::post('/car-save', 'Admin\CarController@save')->name('admin.car.save'); 

   Route::get('/car-edit/{id}', 'Admin\CarController@edit')->name('admin.car.edit');
   Route::post('/car-update/{id}', 'Admin\CarController@update')->name('admin.car.update'); 

   Route::get('/car-view/{id}', 'Admin\CarController@view')->name('admin.car.view');
    Route::delete('/car/{id}', 'Admin\CarController@delete')->name('admin.car.delete');    
   Route::post('/car/delete-all', 'Admin\CarController@bulk_delete')->name('admin.car.delete.all'); 

      //Coupon Section Start//
   Route::get('/coupon', 'Admin\CouponController@index')->name('admin.coupon');    
   Route::get('/coupon-add', 'Admin\CouponController@add')->name('admin.coupon.add');
   Route::post('/coupon-save', 'Admin\CouponController@save')->name('admin.coupon.save'); 

   // Route::get('/coupon-edit/{id}', 'Admin\CouponController@edit')->name('admin.coupon.edit');
   // Route::post('/coupon-update/{id}', 'Admin\CouponController@update')->name('admin.coupon.update'); 

   Route::get('/coupon-view/{id}', 'Admin\CouponController@view')->name('admin.coupon.view');
    Route::delete('/coupon/{id}', 'Admin\CouponController@delete')->name('admin.coupon.delete');    
   Route::post('/coupon/delete-all', 'Admin\CouponController@bulk_delete')->name('admin.coupon.delete.all'); 

   //Blog Subscribe
   Route::get('/blog-subscribe', 'Admin\DashboardController@blog_subscribe')->name('admin.blog.subscribe');
});
Route::get('/profile-email-check', 'Admin\ProfileController@email_check')->name('admin.profile.email.check');
Route::get('/profile-email-check-edit/{id}', 'Admin\ProfileController@email_check_edit')->name('admin.profile.email.check.edit');
//===================================================================
// Admin Routes Ends
//===================================================================


//===================================================================
// Vendor Routes Start
//===================================================================

Route::group(['middleware' => ['vendor'],'prefix' => 'vendor'], function () {
    Route::get('/dashboard', 'Vendor\DashboardController@index')->name('vendor.dashboard');
    Route::get('/dashboard-chart', 'Vendor\DashboardController@get_chart')->name('vendor.dashboard.chart');

   
   Route::get('/profile', 'Vendor\DashboardController@profile')->name('vendor.profile');
   Route::post('/profile-save', 'Vendor\DashboardController@profile_save')->name('vendor.profile.save');

   Route::get('/service', 'Vendor\ServiceController@index')->name('vendor.service');
   Route::get('/service-add', 'Vendor\ServiceController@add')->name('vendor.service.add');
   Route::post('/service-save', 'Vendor\ServiceController@save')->name('vendor.service.save');
   Route::get('/service-edit/{id}', 'Vendor\ServiceController@edit')->name('vendor.service.edit');
   Route::post('/service-update/{id}', 'Vendor\ServiceController@update')->name('vendor.service.update');

   Route::get('/booking', 'Vendor\BookingController@index')->name('vendor.booking');
   Route::get('/booking-email', 'Vendor\BookingController@email_modal')->name('vendor.booking.email');
   Route::post('/booking-email', 'Vendor\BookingController@email_check')->name('vendor.booking.email.check');
   Route::post('/booking-save', 'Vendor\BookingController@book_save')->name('vendor.booking.save');
   Route::post('/booking-guest-save', 'Vendor\BookingController@guest_booking_save')->name('vendor.booking.guest.save');

   Route::post('/booking-coupon-apply', 'Vendor\BookingController@coupon_apply')->name('vendor.coupon.apply');

   Route::get('/booking-view/{id}', 'Vendor\BookingController@view')->name('vendor.booking.view');
   Route::post('/booking-status/{id}', 'Vendor\BookingController@status')->name('vendor.booking.status');

   Route::get('/location', 'Vendor\LocationController@index')->name('vendor.location');
   Route::post('/location-save', 'Vendor\LocationController@save')->name('vendor.location.save');
   Route::get('/location-edit/{id}', 'Vendor\LocationController@edit')->name('vendor.location.edit');
   Route::post('/location-update/{id}', 'Vendor\LocationController@update')->name('vendor.location.update');
   Route::get('/location-view/{id}', 'Vendor\LocationController@view')->name('vendor.location.view');

   Route::get('/time-slot', 'Vendor\TimeSlotController@index')->name('vendor.timeslot');
   Route::post('/time-slot-save', 'Vendor\TimeSlotController@save')->name('vendor.timeslot.save');
});    

//===================================================================
//
//===================================================================

Route::group(['middleware' => ['user'],'prefix' => 'user'], function () {
   Route::get('/dashboard', 'User\DashboardController@index')->name('user.dashboard');
   Route::get('/dashboard-chart', 'User\DashboardController@get_chart')->name('user.dashboard.chart');

   Route::get('/profile', 'User\DashboardController@profile')->name('user.profile');
   Route::post('/profile-save', 'User\DashboardController@profile_save')->name('user.profile.save');

   Route::get('/garage', 'User\GarageController@index')->name('user.garage');
   Route::get('/garage-add', 'User\GarageController@add')->name('user.garage.add');
   Route::post('/garage-save', 'User\GarageController@save')->name('user.garage.save');
   Route::get('/garage-edit/{id}', 'User\GarageController@edit')->name('user.garage.edit');
   Route::post('/garage-update/{id}', 'User\GarageController@update')->name('user.garage.update');
   Route::get('/garage-view/{id}', 'User\GarageController@view')->name('user.garage.view');
   Route::delete('/garage/{id}', 'User\GarageController@delete')->name('user.garage.delete');    
   Route::post('/garage/delete-all', 'User\GarageController@bulk_delete')->name('user.garage.delete.all');    

   Route::get('/booking', 'User\BookingController@index')->name('user.booking');
   Route::get('/booking-view/{id}', 'User\BookingController@view')->name('user.booking.view');
   Route::get('/booking-reschedule/{id}', 'User\BookingController@reschedule')->name('user.booking.reschedule');
   Route::post('/booking-reschedule-save/{id}', 'User\BookingController@reschedule_save')->name('user.booking.reschedule.save');
});