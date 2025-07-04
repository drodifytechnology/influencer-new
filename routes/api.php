<?php

use App\Http\Controllers\Api as Api;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/sign-in', [Api\Auth\AuthController::class, 'login']);
    Route::post('/social/login', [Api\Auth\AuthController::class, 'socialLogin']);
    Route::post('/submit-otp', [Api\Auth\AuthController::class, 'submitOtp']);
    Route::post('/sign-up', [Api\Auth\AuthController::class, 'signUp']);
    Route::post('/resend-otp', [Api\Auth\AuthController::class, 'resendOtp']);

    Route::post('/send-reset-code',[Api\Auth\AcnooForgotPasswordController::class, 'sendResetCode']);
    Route::post('/verify-reset-code',[Api\Auth\AcnooForgotPasswordController::class, 'verifyResetCode']);
    Route::post('/password-reset',[Api\Auth\AcnooForgotPasswordController::class, 'resetPassword']);

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::get('dashboard', [Api\DashboardController::class, 'index']);
        Route::apiResource('categories', Api\AcnooServiceCategoryController::class)->only('index');

        Route::apiResource('coupons', Api\CouponController::class)->only('index');
        Route::apiResource('orders', Api\AcnooOrderController::class)->only('index', 'store', 'show');
        Route::post('orders/reject/{id}', [Api\AcnooOrderController::class,'reject']);
        Route::post('orders/approve/{id}', [Api\AcnooOrderController::class,'approve']);
        Route::post('orders/delivery/{id}', [Api\AcnooOrderController::class,'order_delivery']);
        Route::get('orders/file/{id}', [Api\AcnooOrderController::class, 'file_download']);
        Route::get('ongoing-project', [Api\AcnooOrderController::class, 'ongoingProject']);
        Route::post('orders/cancel/{id}', [Api\AcnooOrderController::class,'client_cancel']);
        Route::post('orders/client-approve/{id}', [Api\AcnooOrderController::class,'client_approve']);
        Route::get('orders/delivered-file/{id}', [Api\AcnooOrderController::class, 'delivered_file']);
        
        // Banner
        Route::resource('banners', Api\AcnooBannerController::class)->only('index');
        
        //bussiness Profile
        Route::get('business-profile', [Api\BusinessProfileController::class, 'index']);
        Route::post('business-profile', [Api\BusinessProfileController::class,'store']);

        //kyc
        Route::post('kyc/offline', [Api\KYCController::class, 'uploadOfflineKYC']);

        //ticket
        Route::post('ticket/create', [TicketController::class, 'create']);
        Route::get('ticket/list', [TicketController::class, 'list']);
        Route::get('ticket/{ticket_id}', [TicketController::class, 'show']);

        

        // Transaction
        Route::apiResource('transactions', Api\AcnooTransactionController::class)->only('index');

        Route::apiResource('services', Api\AcnooServiceController::class)->except('edit', 'create');
        Route::get('service/{id}', [Api\AcnooServiceController::class, 'status']);
        Route::apiResource('service-charge', Api\AcnooServiceChargeController::class)->only('index');
        Route::apiResource('blogs', Api\AcnooBlogController::class)->only('index', 'show');
        Route::apiResource('about-us', Api\AcnooAboutUsController::class)->only('index');
        Route::apiResource('term-conditions', Api\AcnooTermConditionController::class)->only('index');
        Route::apiResource('help-supports', Api\AcnooHelpSupportController::class)->only('index');
        Route::apiResource('profile', Api\AcnooProfileController::class)->only('index', 'store', 'update');
        Route::apiResource('supports', Api\AcnooSupportController::class)->only('index','store','update', 'show');

        Route::post('change-password', [Api\AcnooProfileController::class, 'changePassword']);

        Route::get('/sign-out', [Api\Auth\AuthController::class, 'signOut']);
        Route::get('/refresh-token', [Api\Auth\AuthController::class, 'refreshToken']);

        //Wishlist for package route
        Route::apiResource('wishlist', Api\AcnooWishlistController::class)->only('index', 'store', 'destroy');
        
        //wishlist for influencer
        Route::get('influencer-wishlist', [ Api\AcnooWishlistController::class , 'influencerWishlist']);
        Route::post('influencer-wishlist',[ Api\AcnooWishlistController::class , 'storeInfluencerWishlist']);
        


        // Payment Method
        Route::apiResource('withdraw-methods', Api\WithdrawMethodController::class);
        Route::get('setup-methods', [Api\WithdrawMethodController::class, 'setup_methods']);

        // Withdraw
        Route::apiResource('withdraws', Api\AcnooWithdrawController::class);

        // View Influencer
        Route::resource('view-influencer', Api\AcnooViewInfluencerController::class)->only('show');
        Route::get('influencer-review/{id}', [Api\AcnooViewInfluencerController::class, 'review']);

        // Report
        Route::apiResource('reports', Api\AcnooReportController::class)->only('index','store');

        // report-types
        Route::apiResource('report-types', Api\AcnooReportTypeController::class)->only('index');

        //
        Route::apiResource('medias', Api\AcnooOurSocialMediaController::class);

        // User Route
        Route::apiResource('users', Api\AcnooUserController::class)->only('index');

        // notification setting
        Route::apiResource('notification', Api\AcnooNotificationSettingController::class)->only('index');


        Route::apiResource('get-notifications', Api\AcnooNotificationsController::class)->only('index');
        Route::get('read-nitifications', [Api\AcnooNotificationsController::class, 'readAll']);

        // chat
        Route::apiResource('chats', Api\AcnooChatController::class)->only('index', 'show', 'store');


        // Review
        Route::apiResource('reviews', Api\AcnooReviewController::class)->only('index','store', 'update');

        Route::get('top-categories', [Api\ReportController::class, 'topCategories']);
        Route::get('top-services', [Api\ReportController::class, 'topServices']);
        Route::get('top-influencers', [Api\ReportController::class, 'topInfluencers']);
        Route::get('all-influencers', [Api\ReportController::class, 'allInfluencers']);
    });
});
