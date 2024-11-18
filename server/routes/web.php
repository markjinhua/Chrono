<?php

use Illuminate\Support\Facades\Auth;
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



Route::get('/',function(){
  return view('landing');
});

Route::get('/privacy',function(){
  return view('privacy');
});

Route::get('/refund',function(){
  return view('refund');
});

Route::get('/terms',function(){
  return view('terms');
});

Route::get('/dmca',function(){
  return view('dmca');
});

Route::get('/contact',function(){
  return view('contact');
});
//Hriday
Route::get('/demologin',function(){
  return view('demologin.login');
});
Route::get('/demoregister',function(){
  return view('demologin.signup');
});
Route::get('/demofp',function(){
  return view('demologin.forgot_password');
});
Route::get('/demorp',function(){
  return view('demologin.reset_password');
});

//Hriday
Route::get('/beforelogin',function(){
  return view('beforelogin');
})->name('beforelogin');

Route::get('check', 'CheckController@check');

 Route::get('/affliate/verify/{token}', 'Auth\AffliateRegisterController@verifyUser');
 Route::prefix('affliate')->group(function(){
   Route::post('/logout', 'Auth\AffliateLoginController@logout');
    Route::get('/', 'Users\Affliate\AffliateController@index')->name('affliate.dashboard');
    Route::get('/login', 'Auth\AffliateLoginController@showLoginForm')->name('affliate.login');
    Route::post('/login', 'Auth\AffliateLoginController@login')->name('affliate.login.submit');
    Route::get('/register', 'Auth\AffliateRegisterController@showRegisterForm')->name('affliate.register');
    Route::post('/register', 'Auth\AffliateRegisterController@register')->name('affliate.register.submit');

    Route::get('/view-offer-detail', 'Users\Affliate\OfferController@viewOfferDetail')->name('affliate.view.offer');
    Route::get('/offer-detail/{id?}', 'Users\Affliate\OfferController@offerDetail')->name('affliate.offer');


    Route::get('/approve-request/{id}', 'Users\Affliate\OfferController@ApproveRequest');
Route::get('/reject-request/{id}', 'Users\Affliate\OfferController@RejectRequest');

Route::get('/approval-request', 'Users\Affliate\OfferController@ApprovalRequest');
Route::get('/approve-approval-request', 'Users\Affliate\OfferController@ApproveApprovalRequest');
Route::get('/show-approval-request', 'Users\Affliate\OfferController@ShowApprovalRequest');
Route::get('/show-approval-request-approved', 'Users\Affliate\OfferController@ShowApprovalRequestApproved');
Route::get('/delete-approval-request', 'Users\Affliate\OfferController@DeleteApprovalRequest');


         Route::get('/support/{reply?}','Users\Affliate\AffliateController@Support');
              Route::post('/send-message','Users\Affliate\AffliateController@SendMessage');
            Route::get('/view-message/{id}','Users\Affliate\AffliateController@ViewMessage');
Route::post('/update-publishers', 'Users\Affliate\AffliateController@UpdatePublisher');
Route::post('/update-postback', 'Users\Affliate\AffliateController@UpdatePostback');
Route::get('/settings', 'Users\Affliate\AffliateController@Settings');
Route::get('/payment', 'Users\Affliate\AffliateController@Payment');
Route::get('/get-detail/{id}','Users\Affliate\AffliateController@GetDetail');
Route::get('/set-postback/{id}','Users\Affliate\AffliateController@SetPostback');
Route::get('/generate-link','Users\Affliate\AffliateController@GenerateLink');
Route::get('/mail-room', 'Users\Affliate\AffliateController@MailRoom');
Route::get('/manage-publisher', 'Users\Affliate\AffliateController@ManagePublisher');
Route::get('/show-publisher', 'Users\Affliate\AffliateController@ShowPublisher');
Route::get('/pending-publisher', 'Users\Affliate\AffliateController@ShowPendingPublisher');
Route::get('/pending-smartlinks', 'Users\Affliate\AffliateController@PendingSmartlink');
Route::get('/approve-smartlinks', 'Users\Affliate\AffliateController@ApproveSmartlink');
Route::get('/rejected-smartlinks', 'Users\Affliate\AffliateController@RejectedSmartlink');
Route::get('view-publisher-messages', 'Users\Affliate\AffliateController@ViewPublisherMessages');

Route::get('/pending-offer-process', 'Users\Affliate\OfferController@PendingOfferProcess');
Route::get('/approve-offer-process', 'Users\Affliate\OfferController@ApproveOfferProcess');
Route::get('/reject-offer-process', 'Users\Affliate\OfferController@RejectOfferProcess');
Route::get('/reject-offer-process1', 'Users\Affliate\OfferController@RejectOfferProcess1');
Route::get('/wait-offer-process', 'Users\Affliate\OfferController@WaitOfferProcess');
Route::get('/approve-pending-offer-process', 'Users\Affliate\OfferController@ApprovePendingOfferProcess');
Route::get('/approve-reject-offer-process', 'Users\Affliate\OfferController@ApproveRejectOfferProcess');
Route::get('/approve-reject-offer-process1', 'Users\Affliate\OfferController@ApproveRejectOfferProcess1');
Route::get('/approve-wait-offer-process', 'Users\Affliate\OfferController@ApproveWaitOfferProcess');


Route::get('/search-pending-offer-process', 'Users\Affliate\OfferController@SearchPendingOfferProcess');
Route::get('/search-approve-offer-process', 'Users\Affliate\OfferController@SearchApproveOfferProcess');
Route::get('/search-wait-offer-process', 'Users\Affliate\OfferController@SearchWaitOfferProcess');
Route::get('/search-reject-offer-process', 'Users\Affliate\OfferController@SearchRejectOfferProcess');



Route::get('/show-smartlink-request', 'Users\Affliate\AffliateController@ShowSmartlinkRequest');
Route::get('/show-approve-smartlink-request', 'Users\Affliate\AffliateController@ShowSmartlinkApproveRequest');
Route::get('/show-reject-smartlink-request', 'Users\Affliate\AffliateController@ShowSmartlinkRejectedRequest');
Route::get('/smartlink-approve-request/{id}', 'Users\Affliate\AffliateController@SmartlinkApproveRequest');
Route::get('/smartlink-reject-request/{id}', 'Users\Affliate\AffliateController@SmartlinkRejectRequest');


Route::get('/rejected-publisher', 'Users\Affliate\AffliateController@ShowRejectedPublisher');
Route::get('/show-pending-publisher', 'Users\Affliate\AffliateController@ViewPendingPublisher');
Route::get('/show-rejected-publisher', 'Users\Affliate\AffliateController@ViewRejectedPublisher');

Route::get('/ban-publishers/{id}', 'Users\Affliate\AffliateController@BanPublisher');
Route::get('/approve-publishers/{id}', 'Users\Affliate\AffliateController@ApprovePublisher');
Route::get('/reject-publishers/{id}', 'Users\Affliate\AffliateController@RejectPublisher');
Route::post('/send-mail', 'Users\Affliate\AffliateController@SendMail');
Route::get('/view-mail', 'Users\Affliate\AffliateController@ViewMail');


Route::post('/update-settings', 'Users\Affliate\AffliateController@UpdateSettings');
Route::post('/change-password', 'Users\Affliate\AffliateController@ChangePassword');

});



 Route::get('/publisher/verify/{token}', 'Auth\PublisherRegisterController@verifyUser');
  Route::get('/countries', 'HomeController@countries');


  Route::group(['prefix'=>'publisher/2fa'], function(){
    Route::get('/','LoginSecurityController@show2faForm');
    Route::post('/generateSecret','LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa','LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','LoginSecurityController@disable2fa')->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
      return redirect('/publisher');
    })->name('2faVerify')->middleware('2fa');
});




  Route::group(['prefix'=>'admin/2fa'], function(){
    Route::get('/','LoginSecurityController@show2faFormAdmin');
    Route::post('/generateSecret','LoginSecurityController@generate2faSecretAdmin')->name('generate2faSecretadmin');
    Route::post('/enable2fa','LoginSecurityController@enable2faAdmin')->name('enable2faadmin');;
    Route::post('/disable2fa','LoginSecurityController@disable2faAdmin')->name('disable2faadmin');
     // 2fa middleware
    Route::post('/2faVerifyadmin', function () {
      return redirect('/admin');
    })->name('2faVerifyadmin')->middleware('2faadmin');
});




  Route::group(['prefix'=>'affliate/2fa'], function(){
    Route::get('/','LoginSecurityController@show2faFormAffliate');
    Route::post('/generateSecret','LoginSecurityController@generate2faSecretAffliate')->name('generate2faSecretaffliate');
    Route::post('/enable2fa','LoginSecurityController@enable2faAffliate')->name('enable2faaffliate');;
    Route::post('/disable2fa','LoginSecurityController@disable2faAffliate')->name('disable2faaffliate');
     // 2fa middleware
    Route::post('/2faVerifyAffliate', function () {
      return redirect('/affliate');
    })->name('2faVerifyaffliate')->middleware('2faaffliate');
});







Route::get('api','HomeController@Api');

Route::prefix('publisher')->group(function(){
   Route::get('/public-offers', 'Users\Publisher\OfferController@PublicOffers');
   Route::get('/offer/search', 'Users\Publisher\OfferController@offerSearch');
   Route::get('/new_offer/search', 'Users\Publisher\OfferController@newOfferSearch');
   Route::get('/top_offer/search', 'Users\Publisher\OfferController@topOfferSearch');
    Route::get('/private-offers', 'Users\Publisher\OfferController@PrivateOffers');
    Route::get('/private-offers2', 'Users\Publisher\OfferController@PrivateOffers2');
       Route::get('/offers-details/{id}', 'Users\Publisher\OfferController@OfferDetails');
     Route::get('/special-offers', 'Users\Publisher\OfferController@SpecialOffers');
     Route::get('reports',function(){
      return view('publisher.Report')->with(['from_date'=>date('Y-m-d 00:00:00', strtotime('-7 days')),'to_date'=>date('Y-m-d 23:59:59'),'type'=>'offer','key'=>'']);


     });
     Route::post('reports','Users\Publisher\PublisherController@Reports');



Route::post('/add-postback', 'Users\Publisher\PostbackController@AddPostback');
Route::get('/postback', 'Users\Publisher\PostbackController@Postback');
Route::get('/send-postback', 'Users\Publisher\PostbackController@SendPostback');
Route::get('/generate-payment-pdf', 'Users\Publisher\PublisherController@PaymentPdf');
 Route::get('/clicks-graph', 'Users\Publisher\PublisherController@ClicksGraph');

       Route::get('/new-offers', 'Users\Publisher\OfferController@NewOffers');
          Route::get('/top-offers', 'Users\Publisher\OfferController@TopOffers');
               Route::get('/api', 'Users\Publisher\ApiController@OfferApi');
    Route::get('/search-offer', 'Users\Publisher\OfferController@SearchOffer');
     Route::get('/search-private-offer', 'Users\Publisher\OfferController@SearchPrivateOffer');
       Route::get('/search-new-offer', 'Users\Publisher\OfferController@SearchNewOffer');
          Route::get('/search-top-offer', 'Users\Publisher\OfferController@SearchTopOffer');
        Route::get('/search-special-offer', 'Users\Publisher\OfferController@SearchSpecialOffer');
    Route::get('/', 'Users\Publisher\PublisherController@index')->name('publisher.dashboard');
Route::post('/filter-smartlink', 'Users\Publisher\PublisherController@FilterSmartlink');
Route::post('/insert-smartlink', 'Users\Publisher\PublisherController@InsertSmartlink');
Route::get('/smartlink', 'Users\Publisher\PublisherController@Smartlink');
Route::get('/delete-smartlink', 'Users\Publisher\PublisherController@DeleteSmartlink');
Route::get('/show-smartlink', 'Users\Publisher\PublisherController@ViewSmartlink');
   Route::get('/account-information','Users\Publisher\SettingsController@AccountInformation');
   Route::get('/remove-payment/{id}','Users\Publisher\SettingsController@RemoveAccount');
Route::get('/show-all-notifications','Users\Publisher\SettingsController@ShowAllNotifications');
   Route::post('/add-payment','Users\Publisher\SettingsController@AddPayment');
   Route::get('/payment-history','Users\Publisher\PaymentController@PaymentHistory');
     Route::get('/login-history','Users\Publisher\PublisherController@LoginHistory');
          Route::get('/support/{reply?}','Users\Publisher\PublisherController@Support');
              Route::post('/send-message','Users\Publisher\PublisherController@SendMessage');
            Route::get('/view-message/{id}','Users\Publisher\PublisherController@ViewMessage');
             Route::get('/view-notification/{id}','Users\Publisher\PublisherController@ViewNotification');
   Route::get('/top-10-members','Users\Publisher\OfferController@TopMembers');
        Route::get('/manage-site','Users\Publisher\PublisherController@ManageSite');
    Route::get('/add-site','Users\Publisher\PublisherController@AddSite');
  Route::post('/insert-site','Users\Publisher\PublisherController@InsertSite');
   Route::get('/show-site','Users\Publisher\PublisherController@ShowSite');

   Route::get('/edit-site','Users\Publisher\PublisherController@EditSite');
    Route::post('/update-site','Users\Publisher\PublisherController@UpdateSite');
   Route::get('/delete-site','Users\Publisher\PublisherController@DeleteSite');

    Route::get('/daily-report', 'Users\Publisher\PublisherController@DailyReport');
     Route::get('/show-daily-report', 'Users\Publisher\PublisherController@ShowDailyReport');

   Route::post('/upload-image','Users\Publisher\SettingsController@UploadImage');
      Route::post('/change-password','Users\Publisher\SettingsController@ChangePassword');
         Route::post('/update-settings','Users\Publisher\SettingsController@UpdateSettings');
    Route::get('/login', 'Auth\PublisherLoginController@showLoginForm')->name('publisher.login');
    Route::post('/login', 'Auth\PublisherLoginController@login')->name('publisher.login.submit');
    Route::get('/register', 'Auth\PublisherRegisterController@showRegisterForm')->name('publisher.register');

        Route::get('/requestApproval', 'Users\Publisher\OfferController@requestApproval');
    Route::post('/register', 'Auth\PublisherRegisterController@register')->name('publisher.register.submit');
    Route::post('/logout', 'Auth\PublisherLoginController@logout');
});




Route::get('/click', 'HomeController@Click');
Route::get('/links', 'HomeController@Smartlink');
Route::get('/postback', 'HomeController@Postback');


Route::post('reset_password_without_token', 'Auth\PublisherLoginController@validatePasswordRequest');
Route::post('checkpin', 'Auth\PublisherLoginController@CheckPin');

Route::get('VerifyPin/{email}',function($email){
  return view('auth.passwords.pin')->with('email',$email);
});


  Route::group(['prefix'=>'admin',], function(){


Route::get('/add-offer', 'Users\Admin\OfferController@AddOffer');
Route::get('/lead/search', 'Users\Admin\OfferController@leadSearch');
Route::get('/pending-offer-process', 'Users\Admin\OfferController@PendingOfferProcess');
Route::get('/approve-offer-process', 'Users\Admin\OfferController@ApproveOfferProcess');
Route::get('/reject-offer-process', 'Users\Admin\OfferController@RejectOfferProcess');
Route::get('/reject-offer-process1', 'Users\Admin\OfferController@RejectOfferProcess1');
Route::get('/wait-offer-process', 'Users\Admin\OfferController@WaitOfferProcess');
Route::get('/search-pending-offer-process', 'Users\Admin\OfferController@SearchPendingOfferProcess');
Route::get('/search-approve-offer-process', 'Users\Admin\OfferController@SearchApproveOfferProcess');
Route::get('/search-wait-offer-process', 'Users\Admin\OfferController@SearchWaitOfferProcess');
Route::get('/search-reject-offer-process', 'Users\Admin\OfferController@SearchRejectOfferProcess');



Route::get('/smartlink-pending-process', 'Users\Admin\OfferController@SmartlinkPendingProcess');
Route::get('/smartlink-approve-process', 'Users\Admin\OfferController@SmartlinkApproveProcess');
Route::get('/smartlink-waited-process', 'Users\Admin\OfferController@SmartlinkWaitedProcess');
Route::get('/smartlink-rejected-process', 'Users\Admin\OfferController@SmartlinkRejectedProcess');

Route::get('/search-pending-smartlink-process', 'Users\Admin\OfferController@SearchPendingSmartlinkProcess');
Route::get('/search-rejected-smartlink-process', 'Users\Admin\OfferController@SearchRejectedSmartlinkProcess');
Route::get('/search-approved-smartlink-process', 'Users\Admin\OfferController@SearchApprovedSmartlinkProcess');
Route::get('/search-wait-smartlink-process', 'Users\Admin\OfferController@SearchWaitSmartlinkProcess');








    Route::post('/change-password', 'Users\Admin\SettingsController@ChangePassword');
Route::get('/settings', 'Users\Admin\SettingsController@index');
Route::post('/update-settings', 'Users\Admin\SettingsController@UpdateSettings');

Route::get('/edit-offer/{id}', 'Users\Admin\OfferController@EditOffer');
Route::get('/show-domain', 'Users\Admin\AdminController@ShowDomain');
Route::get('/edit-domain', 'Users\Admin\AdminController@EditDomain');
Route::get('/show-smartlink-domain', 'Users\Admin\AdminController@ShowSmartlinkDomain');
Route::get('/edit-smartlink-domain', 'Users\Admin\AdminController@EditSmartlinkDomain');

Route::get('/cron-payout-net-45', 'Users\Admin\CashoutController@CronPayoutNet45');
Route::get('/cron-payout-net-30', 'Users\Admin\CashoutController@CronPayoutNet30');
Route::get('/cron-payout-net-15', 'Users\Admin\CashoutController@CronPayoutNet15');
Route::get('/cron-payout-net-7', 'Users\Admin\CashoutController@CronPayoutNet7');
Route::get('/cron-payout-on-requested', 'Users\Admin\CashoutController@CronPayoutOnRequested');




Route::get('/messages/{reply?}', 'Users\Admin\AdminController@Messages');
Route::post('/send-message', 'Users\Admin\AdminController@SendMessage');
Route::get('/delete-domain', 'Users\Admin\AdminController@DeleteDomain');
Route::post('/update-domain', 'Users\Admin\AdminController@UpdateDomain');
Route::post('/insert-domain', 'Users\Admin\AdminController@InsertDomain');
Route::get('/manage-domain', 'Users\Admin\AdminController@ManageDomain');

Route::get('/delete-smartlink-domain', 'Users\Admin\AdminController@DeleteSmartlinkDomain');
Route::post('/update-smartlink-domain', 'Users\Admin\AdminController@UpdateSmartlinkDomain');
Route::post('/insert-smartlink-domain', 'Users\Admin\AdminController@InsertSmartlinkDomain');
Route::get('/manage-smartlink-domain', 'Users\Admin\AdminController@ManageSmartlinkDomain');
Route::get('/manage-smartlink-request', 'Users\Admin\AdminController@ManageSmartlinkRequest');
Route::get('/show-smartlink-request', 'Users\Admin\AdminController@ShowSmartlinkRequest');


Route::get('/show-categories', 'Users\Admin\AdminController@ShowCategory');
Route::get('/edit-categories', 'Users\Admin\AdminController@EditCategory');
   Route::post('/logout', 'Auth\AdminLoginController@logout');
Route::get('/delete-categories', 'Users\Admin\AdminController@DeleteCategory');
Route::post('/update-categories', 'Users\Admin\AdminController@UpdateCategory');
Route::post('/insert-categories', 'Users\Admin\AdminController@InsertCategory');
Route::get('/manage-categories', 'Users\Admin\AdminController@ManageCategory');

Route::get('/show-site-categories', 'Users\Admin\AdminController@ShowSiteCategory');
Route::get('/edit-site-categories', 'Users\Admin\AdminController@EditSiteCategory');

Route::get('/delete-site-categories', 'Users\Admin\AdminController@DeleteSiteCategory');
Route::post('/update-site-categories', 'Users\Admin\AdminController@UpdateSiteCategory');
Route::post('/insert-site-categories', 'Users\Admin\AdminController@InsertSiteCategory');
Route::get('/manage-site-categories', 'Users\Admin\AdminController@ManageSiteCategory');


     Route::get('/view-message/{id}','Users\Admin\AdminController@ViewMessage');
Route::get('/manage-clicks', 'Users\Admin\ClickController@ManageClicks');
Route::get('/ban-publishers/{id}', 'Users\Admin\PublisherController@BanPublisher');
Route::get('/approve-request/{id}', 'Users\Admin\OfferController@ApproveRequest');
Route::get('/reject-request/{id}', 'Users\Admin\OfferController@RejectRequest');
Route::get('/smartlink-approve-request/{id}', 'Users\Admin\OfferController@SmartlinkApproveRequest');
Route::get('/smartlink-reject-request/{id}', 'Users\Admin\OfferController@SmartlinkRejectRequest');

Route::get('/approval-request', 'Users\Admin\OfferController@ApprovalRequest');
Route::get('/approve-pending-offer-process', 'Users\Admin\OfferController@ApprovePendingOfferProcess');
Route::get('/approve-reject-offer-process', 'Users\Admin\OfferController@ApproveRejectOfferProcess');
Route::get('/approve-reject-offer-process1', 'Users\Admin\OfferController@ApproveRejectOfferProcess1');
Route::get('/approve-wait-offer-process', 'Users\Admin\OfferController@ApproveWaitOfferProcess');



Route::get('/website-approve-request/{id}', 'Users\Admin\AdminController@WebsiteApproveRequest');
Route::get('/website-reject-request/{id}', 'Users\Admin\AdminController@WebsiteRejectRequest');
Route::get('/show-website-approval', 'Users\Admin\AdminController@ShowWebsiteApproval');
Route::get('/show-publisher-approval', 'Users\Admin\AdminController@ShowPublisherApproval');
Route::get('/publisher-approve-request/{id}', 'Users\Admin\AdminController@PublisherApproveRequest');
Route::get('/show-approval-request', 'Users\Admin\OfferController@ShowApprovalRequest');
Route::get('/delete-approval-request', 'Users\Admin\OfferController@DeleteApprovalRequest');
Route::get('/website-approval-request', 'Users\Admin\AdminController@WebsiteApprovalRequest');
Route::get('/publisher-approval-request', 'Users\Admin\AdminController@PublisherApprovalRequest');

Route::get('/show-news', 'Users\Admin\AdminController@ShowNews');
Route::get('/edit-news', 'Users\Admin\AdminController@EditNews');
Route::get('/delete-news', 'Users\Admin\AdminController@DeleteNews');
Route::post('/update-news', 'Users\Admin\AdminController@UpdateNews');
Route::get('/insert-news', 'Users\Admin\AdminController@InsertNews');
Route::get('/manage-news', 'Users\Admin\AdminController@ManageNews');

Route::get('/show-ban-ip', 'Users\Admin\AdminController@ShowBanIp');
Route::get('/edit-ban-ip', 'Users\Admin\AdminController@EditBanIp');
Route::get('/delete-ban-ip', 'Users\Admin\AdminController@DeleteBanIp');
Route::post('/update-ban-ip', 'Users\Admin\AdminController@UpdateBanIp');
Route::post('/insert-ban-ip', 'Users\Admin\AdminController@InsertBanIp');
Route::get('/manage-ban-ip', 'Users\Admin\AdminController@ManageBanIp');

Route::get('/show-cashout', 'Users\Admin\CashoutController@ShowCashout');
Route::get('/edit-cashout', 'Users\Admin\CashoutController@EditCashout');
Route::get('/delete-cashout', 'Users\Admin\CashoutController@DeleteCashout');
Route::post('/update-cashout', 'Users\Admin\CashoutController@UpdateCashout');
Route::post('/insert-cashout', 'Users\Admin\CashoutController@InsertCashout');
Route::get('/manage-cashout', 'Users\Admin\CashoutController@ManageCashout');
Route::get('/search-cashout', 'Users\Admin\CashoutController@SearchCashout');
Route::get('/InstantWithdraw', 'Users\Admin\CashoutController@InstantWithdraw');

Route::get('/show-cashout-affliate', 'Users\Admin\CashoutController@ShowCashoutAffliate');
Route::get('/edit-cashout-affliate', 'Users\Admin\CashoutController@EditCashoutAffliate');
Route::get('/delete-cashout-affliate', 'Users\Admin\CashoutController@DeleteCashoutAffliate');
Route::post('/update-cashout-affliate', 'Users\Admin\CashoutController@UpdateCashoutAffliate');
Route::post('/insert-cashout-affliate', 'Users\Admin\CashoutController@InsertCashoutAffliate');
Route::get('/manage-cashout-affliate', 'Users\Admin\CashoutController@ManageCashoutAffliate');



Route::get('/show-advertiser', 'Users\Admin\AdvertiserController@ShowAdvertiser');
Route::get('/edit-advertiser', 'Users\Admin\AdvertiserController@EditAdvertiser');
Route::get('/delete-advertiser', 'Users\Admin\AdvertiserController@DeleteAdvertiser');
Route::post('/update-advertiser', 'Users\Admin\AdvertiserController@UpdateAdvertiser');
Route::post('/insert-advertiser', 'Users\Admin\AdvertiserController@InsertAdvertiser');
Route::get('/manage-advertiser', 'Users\Admin\AdvertiserController@ManageAdvertiser');

Route::get('/show-affliatemanager', 'Users\Admin\AffliateManagerController@ShowAffliateManager');
Route::get('/edit-affliatemanager', 'Users\Admin\AffliateManagerController@EditAffliateManager');
Route::get('/delete-affliatemanager', 'Users\Admin\AffliateManagerController@DeleteAffliateManager');
Route::post('/update-affliatemanager', 'Users\Admin\AffliateManagerController@UpdateAffliateManager');
Route::post('/insert-affliatemanager', 'Users\Admin\AffliateManagerController@InsertAffliateManager');
Route::get('/manage-affliatemanager', 'Users\Admin\AffliateManagerController@ManageAffliateManager');

Route::post('/change-affliatemanager', 'Users\Admin\AffliateManagerController@ChangePassword');
Route::get('/show-publishers', 'Users\Admin\PublisherController@ShowPublisher');
Route::get('/edit-view-publisher/{id}', 'Users\Admin\PublisherController@ViewPublisher');
Route::get('/edit-publishers', 'Users\Admin\PublisherController@EditPublisher');
Route::get('/delete-publishers', 'Users\Admin\PublisherController@DeletePublisher');
Route::post('/update-publishers', 'Users\Admin\PublisherController@UpdatePublisher');
Route::post('/insert-publishers', 'Users\Admin\PublisherController@InsertPublisher');
Route::get('/manage-publishers', 'Users\Admin\PublisherController@ManagePublisher');
Route::get('/access-publisher/{email}', 'Users\Admin\PublisherController@login');


Route::get('/manage-postback', 'Users\Admin\PostbackController@ManagePostback');
Route::get('/manage-postback-log', 'Users\Admin\PostbackController@ManagePostbackLog');
Route::get('/manage-postback-log-receive', 'Users\Admin\PostbackController@ManagePostbackLogRecieve');

Route::post('/insert-offer', 'Users\Admin\OfferController@InsertOffer');
Route::post('/update-offer', 'Users\Admin\OfferController@UpdateOffer');
Route::get('/view-offer', 'Users\Admin\OfferController@ViewOffer');

Route::get('/offer-delete/{id}', 'Users\Admin\OfferController@offerDelete');
Route::get('/search/offer', 'Users\Admin\OfferController@searchOffers');
Route::get('/delete-offer/{id}', 'Users\Admin\OfferController@DeleteOffer');
Route::get('/show-offer', 'Users\Admin\OfferController@ShowOffer');
Route::get('/search-offer', 'Users\Admin\OfferController@SearchOffer');
    Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
    Route::post('/','Users\Admin\AdminController@FilterDashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
});



Route::group( [ 'prefix' => 'user-dashboard' ,'middleware'=>'verified'], function()
{

});

// Route::group( [ 'prefix' => 'user-dashboard-arabic' ,'middleware'=>'verified'], function()
// {
//     Route::get('/','UserController@Home_Arabic');

// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
