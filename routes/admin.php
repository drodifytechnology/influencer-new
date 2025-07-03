<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as ADMIN;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [ADMIN\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/get-dashboard', [Admin\DashboardController::class, 'getDashboardData'])->name('dashboard.data');
    Route::get('/yearly-generates', [Admin\DashboardController::class, 'yearlyWithdraw'])->name('dashboard.generates');
    Route::get('/income-overview', [ADMIN\DashboardController::class, 'yearlyincome'])->name('dashboard.total-income');

    Route::resource('users', ADMIN\UserController::class);
    Route::post('users/filter', [ADMIN\UserController::class, 'maanFilter'])->name('users.filter');
    Route::post('users/status/{id}', [ADMIN\UserController::class,'status'])->name('users.status');
    Route::post('users/delete-all', [ADMIN\UserController::class,'deleteAll'])->name('users.delete-all');

    Route::resource('profiles', ADMIN\ProfileController::class)->only('index', 'update');

    //banner
    Route::resource('banners', ADMIN\AcnooBannerController::class)->except('show',);
    Route::post('banners/status/{id}', [ADMIN\AcnooBannerController::class,'status'])->name('banners.status');
    Route::post('banners/delete-all', [ADMIN\AcnooBannerController::class,'deleteAll'])->name('banners.deleteAll');

    //Category
    Route::resource('categories',ADMIN\AcnooCategoryController::class);
    Route::post('categories/status/{id}', [ADMIN\AcnooCategoryController::class,'status'])->name('categories.status');
    Route::post('categories/filter', [ADMIN\AcnooCategoryController::class, 'maanFilter'])->name('categories.filter');
    Route::post('categories/delete-all', [ADMIN\AcnooCategoryController::class,'deleteAll'])->name('categories.deleteAll');

    //Service
    Route::resource('services',ADMIN\AcnooServiceController::class);
    Route::post('services/filter', [ADMIN\AcnooServiceController::class, 'maanFilter'])->name('services.filter');
    Route::post('services/reject/{id}', [ADMIN\AcnooServiceController::class,'reject'])->name('services.reject');
    Route::post('services/update/{id}', [ADMIN\AcnooServiceController::class,'update'])->name('services.update');
    Route::post('services/delete-all', [ADMIN\AcnooServiceController::class,'deleteAll'])->name('services.deleteAll');

    //Influencer
    Route::resource('influencers', Admin\AcnooInfluencerController::class);
    Route::post('influencers/filter', [ADMIN\AcnooInfluencerController::class, 'maanFilter'])->name('influencers.filter');
    Route::post('influencers/delete-all', [ADMIN\AcnooInfluencerController::class,'deleteAll'])->name('influencers.deleteAll');
    Route::post('influencers/reject/{id}', [ADMIN\AcnooInfluencerController::class,'reject'])->name('influencers.reject');
    Route::post('influencers/approve/{id}', [ADMIN\AcnooInfluencerController::class,'approve'])->name('influencers.approve');
    Route::post('influencers/banned/{id}', [ADMIN\AcnooInfluencerController::class,'banned'])->name('influencers.banned');
    Route::post('influencers/service-reject/{id}', [ADMIN\AcnooInfluencerController::class,'service_reject'])->name('influencers.service-reject');
    Route::post('influencers/send-email', [ADMIN\AcnooInfluencerController::class,'send_email'])->name('influencers.send-email');
    Route::post('influencers/show-order-filter/{id}', [ADMIN\AcnooInfluencerController::class, 'showOrderFilter'])->name('influencers.showOrderFilter');
    Route::post('influencers/show-ticket-filter/{id}', [ADMIN\AcnooInfluencerController::class, 'showServiceFilter'])->name('influencers.showServiceFilter');
    //Client
    Route::resource('clients', Admin\AcnooClientController::class);
    Route::post('clients/filter', [ADMIN\AcnooClientController::class, 'maanFilter'])->name('clients.filter');
    Route::post('clients/delete-all', [ADMIN\AcnooClientController::class,'deleteAll'])->name('clients.deleteAll');
    Route::post('clients/banned/{id}', [ADMIN\AcnooClientController::class,'banned'])->name('clients.banned');
    Route::post('clients/approve/{id}', [ADMIN\AcnooClientController::class,'approve'])->name('clients.approved');
    Route::get('clients/order-details/{id}', [Admin\AcnooClientController::class, 'order_details'])->name('order.details');
    Route::post('clients/send-email', [ADMIN\AcnooClientController::class,'send_email'])->name('clients.send-email');
    Route::get('clients/get-message/{id}', [ADMIN\AcnooClientController::class,'getMessage'])->name('clients.get-message');
    Route::post('clients/show-order-filter/{id}', [ADMIN\AcnooClientController::class, 'showOrderFilter'])->name('clients.showOrderFilter');
    Route::post('clients/show-ticket-filter/{id}', [ADMIN\AcnooClientController::class, 'showTicketFilter'])->name('clients.showTicketFilter');

    //Coupon
    Route::resource('coupons',ADMIN\AcnooCouponController::class);
    Route::post('coupons/filter', [ADMIN\AcnooCouponController::class, 'maanFilter'])->name('coupons.filter');
    Route::post('coupons/status/{id}', [ADMIN\AcnooCouponController::class,'status'])->name('coupons.status');
    Route::post('coupons/delete-all', [ADMIN\AcnooCouponController::class,'deleteAll'])->name('coupons.deleteAll');

    //Order manage route
    Route::resource('orders',ADMIN\AcnooOrderController::class)->only('index','destroy');
    Route::post('orders/delete-all', [ADMIN\AcnooOrderController::class,'deleteAll'])->name('orders.deleteAll');
    Route::post('orders/reject/{id}', [ADMIN\AcnooOrderController::class,'order_reject'])->name('orders.reject');
    Route::post('orders/paid/{id}', [ADMIN\AcnooOrderController::class,'paid'])->name('orders.paid');


    // Expense Category
    Route::resource('expense-category',ADMIN\AcnooExpenseCategoryController::class);
    Route::post('expense-category/filter', [ADMIN\AcnooExpenseCategoryController::class, 'maanFilter'])->name('expense-category.filter');
    Route::post('expense-category/status/{id}', [ADMIN\AcnooExpenseCategoryController::class,'status'])->name('expense-category.status');
    Route::post('expense-category/delete-all', [ADMIN\AcnooExpenseCategoryController::class,'deleteAll'])->name('expense-category.deleteAll');

    // Expense
    Route::resource('expenses',ADMIN\AcnooExpenseController::class);
    Route::post('expenses/delete-all', [ADMIN\AcnooExpenseController::class,'deleteAll'])->name('expenses.deleteAll');


    //Complain
    Route::resource('complains',ADMIN\AcnooComplainController::class)->only('index', 'destroy');
    Route::post('complains/filter', [ADMIN\AcnooComplainController::class, 'maanFilter'])->name('complains.filter');
    Route::post('complains/delete-all', [ADMIN\AcnooComplainController::class,'deleteAll'])->name('complains.deleteAll');


    //Refund
    Route::resource('refunds',ADMIN\AcnooRefundController::class)->only('index', 'destroy');
    Route::post('refunds/filter', [ADMIN\AcnooRefundController::class, 'maanFilter'])->name('refunds.filter');
    Route::post('refunds/reject/{id}', [ADMIN\AcnooRefundController::class,'reject'])->name('refunds.reject');
    Route::post('refunds/approve/{id}', [ADMIN\AcnooRefundController::class,'approve'])->name('refunds.approve');


    // Ticket
    Route::resource('supports', ADMIN\AcnooSupportController::class)->only('index', 'show', 'store');
    Route::post('supports/filter', [ADMIN\AcnooSupportController::class, 'maanFilter'])->name('supports.filter');
    Route::post('supports/delete-all', [ADMIN\AcnooSupportController::class,'deleteAll'])->name('supports.deleteAll');
    Route::get('support/get-message/{id}', [ADMIN\AcnooSupportController::class,'getMessage'])->name('supports.get-message');
    Route::post('support/closed', [ADMIN\AcnooSupportController::class,'close'])->name('support.closed');

    //Withdrawal
    Route::resource('withdraw-request', ADMIN\AcnooWithdrawRequestController::class)->only('index', 'show', 'store','reject');
    Route::post('withdraw-request/filter', [ADMIN\AcnooWithdrawRequestController::class, 'maanFilter'])->name('withdraw-request.filter');
    Route::post('withdraw-request/reject/{id}', [ADMIN\AcnooWithdrawRequestController::class,'reject'])->name('withdraw.reject');
    Route::post('withdraw-request/approve/{id}', [ADMIN\AcnooWithdrawRequestController::class,'approve'])->name('withdraw.approve');

    //Withdrawal Method
    Route::resource('withdraw_methods',ADMIN\AcnooWithdrawMethodController::class);
    Route::post('withdraw_methods/status/{id}', [ADMIN\AcnooWithdrawMethodController::class,'status'])->name('withdraw_methods.status');
    Route::post('withdraw_methods/filter', [ADMIN\AcnooWithdrawMethodController::class, 'maanFilter'])->name('withdraw_methods.filter');
    Route::post('withdraw_methods/delete-all', [ADMIN\AcnooWithdrawMethodController::class,'deleteAll'])->name('withdraw_methods.delete-all');

   // Currencies
   Route::resource('currencies', ADMIN\AcnooCurrencyController::class)->except('show');
   Route::match(['get', 'post'], 'currencies/default/{id}', [ADMIN\AcnooCurrencyController::class, 'default'])->name('currencies.default');
   Route::post('currencies/filter', [ADMIN\AcnooCurrencyController::class, 'maanFilter'])->name('currencies.filter');

    //Reports
    Route::get('client/report', [ADMIN\AcnooReportsController::class,'clientReport'])->name('client.report');
    Route::post('client/filter', [ADMIN\AcnooReportsController::class, 'clientFilter'])->name('client.filter');

    Route::get('influencer/report', [ADMIN\AcnooReportsController::class,'influencerReport'])->name('influencer.report');
    Route::post('influencer/filter', [ADMIN\AcnooReportsController::class, 'influencerFilter'])->name('influencer.filter');

    Route::get('withdraw/report', [ADMIN\AcnooReportsController::class,'withdrawReport'])->name('withdraw.report');
    Route::post('withdraw/filter', [ADMIN\AcnooReportsController::class, 'withdrawFilter'])->name('withdraw.filter');

    Route::get('income/report', [ADMIN\AcnooReportsController::class,'incomeReport'])->name('income.report');
    Route::post('income/filter', [ADMIN\AcnooReportsController::class, 'incomeFilter'])->name('income.filter');

    Route::get('expense/report', [ADMIN\AcnooReportsController::class,'expenseReport'])->name('expense.report');
    Route::post('expense/filter', [ADMIN\AcnooReportsController::class, 'expenseFilter'])->name('expense.filter');

    Route::get('order/report', [ADMIN\AcnooReportsController::class,'orderReport'])->name('orders.report');
    Route::post('order/filter', [ADMIN\AcnooReportsController::class, 'orderFilter'])->name('order.filter');

    // Blog Controller
    Route::resource('blogs', Admin\AcnooBlogController::class);
    Route::post('blogs/status/{id}', [ADMIN\AcnooBlogController::class,'status'])->name('blogs.status');
    Route::post('blogs/delete-all', [ADMIN\AcnooBlogController::class, 'deleteAll'])->name('blogs.delete-all');

    // Term And Condition Controller
    Route::resource('term-conditions', ADMIN\AcnooTermConditionController::class)->only('index', 'store');

    //Client Report
    Route::resource('report-types', ADMIN\AcnooClientReportController::class)->except('show');
    Route::post('report-types/status/{id}', [ADMIN\AcnooClientReportController::class,'status'])->name('report-types.status');
    Route::post('report-types/delete-all', [ADMIN\AcnooClientReportController::class, 'deleteAll'])->name('report-types.deleteAll');

    //Client Report
    Route::resource('social-medias', ADMIN\AcnooOurSocialMediaController::class)->except('show', 'edit', 'create');
    Route::post('social-medias/status/{id}', [ADMIN\AcnooOurSocialMediaController::class,'status'])->name('social-medias.status');
    Route::post('social-medias/delete-all', [ADMIN\AcnooOurSocialMediaController::class, 'deleteAll'])->name('social-medias.deleteAll');


    // About Us Controller
    Route::resource('about-us', ADMIN\AcnooAboutUsController::class)->only('index', 'store');

    Route::resource('help-supports', ADMIN\AcnooHelpSupportController::class)->only('index', 'store');

    // Roles & Permissions
    Route::resource('roles', ADMIN\RoleController::class)->except('show');
    Route::resource('permissions', ADMIN\PermissionController::class)->only('index', 'store');

    // General Setting
    Route::resource('settings', ADMIN\SettingController::class)->only('index', 'update');

    //Payment type
    Route::resource('payment-type', ADMIN\AcnooPaymentTypeController::class)->except('show');
    Route::post('payment-type/status/{id}', [ADMIN\AcnooPaymentTypeController::class,'status'])->name('payment-type.status');
    Route::post('payment-type/delete-all', [ADMIN\AcnooPaymentTypeController::class,'deleteAll'])->name('payment-type.deleteAll');

    // System Settings
    Route::resource('system-settings', ADMIN\SystemSettingController::class)->only('index', 'store');
    //service settings
    Route::resource('service-settings', ADMIN\AcnooServiceSettingController::class)->only('index', 'store');
    Route::resource('gateways', ADMIN\AcnooGatewayController::class)->only('index', 'update');


    //Notifications manager
    Route::prefix('notifications')->controller(ADMIN\NotificationController::class)->name('notifications.')->group(function () {
        Route::get('/', 'mtIndex')->name('index');
        Route::post('/filter', 'maanFilter')->name('filter');
        Route::get('/{id}', 'mtView')->name('mtView');
        Route::get('view/all/', 'mtReadAll')->name('mtReadAll');
    });
});

