<?php

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

Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');

Route::get('company/login', 'Auth\CompanyLoginController@showLoginForm')->name('company.login');
Route::post('company/login', 'Auth\CompanyLoginController@login')->name('company.login');
Route::post('check-environment','HomeController@checkEnvironment')->name('check.environment');

Auth::routes(['verify' => true]);

Route::get('lang/{locale}', 'HomeController@lang')->name('switch-lang');

//Social Routes
Route::get('/social/login/{provider}', 'Auth\SocialLoginController@providerRedirect')->name('social.login');
Route::get('/social/login/callback/{provider}', 'Auth\SocialLoginController@providerRedirectCallback')->name('social.loginCallback');

Route::get('/register-domain', 'HomeController@registerDomain')->name('register.domain');
Route::post('/store-domain', 'HomeController@storeUserDomain')->name('store.domain');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/ajax-list', 'SearchController@getAjaxList')->name('ajax-list');

// Environment setup


/*Admin Route Group*/
Route::group(['namespace' => 'Admin','prefix'=>'admin','middleware'=>['auth:admin,company']], function () {

    Route::get('/', 'UsersController@dashboard');
    Route::get('/account-profile','UsersController@adminProfileShow')->name('admin.profile');
    Route::post('/account-profile','UsersController@adminProfileStore')->name('admin.profile.store');
    Route::get('/user-status/{type}/{id}/{status}', 'UsersController@updateUserStatus')->name('users.status');

    Route::resource('permission','PermissionController');
    Route::get('permission/add/{type}','PermissionController@addPermission')->name('permission.add');
    Route::post('permission/save','PermissionController@savePermission')->name('permission.save');

    Route::get('dashboard', 'UsersController@dashboard')->name('admin.dashboard');

    Route::get('remove-current-photo', 'UsersController@removeCurrentPhoto')->name('remove.current.photo');

    Route::resource('users','UsersController');

      //Articles Routes
    Route::resource('/articles','ArticleController');
    Route::resource('/categories','CategoriesController');


    Route::resource('pages','PageController');

    Route::get('page/{type}', 'PageController@pageForm')->name('pages.form');

    Route::get('faq', 'PageController@faq')->name('faq.index');

    Route::get('faq-create', 'PageController@faqCreate')->name('faq.create');

    Route::post('faq-store', 'PageController@faqStore')->name('faq.store');

    Route::delete('faq-destroy/{id}', 'PageController@faqDestroy')->name('faq.destroy');

    // Setting
    Route::get('settings', 'SettingsController@settings')->name('settings');
    Route::post('settings', 'SettingsController@settingsUpdates')->name('setting.update');
    Route::post('env-changes', 'SettingsController@envChanges')->name('env.changes');
    Route::post('homepage-settings', 'SettingsController@homepageSettings')->name('setting.homepage');
    Route::post('contactus-settings', 'SettingsController@contactusSettings')->name('setting.contactus');
    Route::post('notification-settings', 'SettingsController@notificationSettings')->name('setting.notification');
    Route::post('headfootupdate', 'SettingsController@headfootupdate')->name('setting.header.footer');


    Route::resource('knowledges','KnowledgeBaseController');
    Route::resource('videos','VideoTutorialController');

    /*Mail trigger module*/
    Route::group(['prefix' => 'mail'],function (){
        Route::resource('mailable','MailableController',['names' => 'mail.mailable']);
        Route::get('mailable-buttons','MailableController@mailButton')->name('mailable-buttons');
        Route::get('mailable-template','MailableController@mailTemplate')->name('mailable-template');
        Route::resource('template','MailTemplateController',['names' => 'mail.template']);
    });

});
/*End Admin Route Group*/


/*Company Route Group*/
Route::group(['namespace' => 'Company','middleware'=>['auth:admin,company']], function () {

    Route::resource('employees','EmployeeController');
    Route::resource('departments','DepartmentController');

    Route::get('employee/profile/{employee}', 'EmployeeController@edit')->name('employee.profile');
    Route::patch('employee/profile/{employee}', 'EmployeeController@update')->name('employee.profile.update');

});
/*End Company Route Group*/


/*Employee Route Group*/
Route::group(['namespace' => 'Admin','prefix'=>'company','middleware'=>['auth:company']], function () {

    Route::get('/', 'UsersController@dashboard')->name('company.dashboard');

});
/*End Employee Route Group*/

/*User Route Group*/
Route::group(['namespace' => 'Admin','middleware'=>['auth:web,company']], function () {

    Route::get('user/profile/{user}', 'UsersController@edit')->name('user.profile');
    Route::patch('user/profile/{user}', 'UsersController@update')->name('user.profile.update');

    /* Change Password Route*/
    Route::get('user/change-password', 'UsersController@changePassword')->name('user.change.password');
    Route::get('employee/change-password', 'UsersController@changePassword')->name('employee.change.password');

    /*Dashboard Route*/
    Route::get('user/dashboard', 'UsersController@dashboard')->name('user.dashboard');
    Route::get('employee/dashboard', 'UsersController@dashboard')->name('employee.dashboard');

});
/*End User Route Group*/




Route::group(['middleware'=>['auth','verified', 'user.deactivated']], function () {
    Route::get('vots/{val}', 'HomeController@vots')->name('user.vots');

});



/*------------------------------- SUPPORT TICKET SYSTEM [START] -----------------------------------*/

Route::group(['namespace' => 'Support'], function () {
    Route::get('tickets/{type}','SupportController@getTickets')->name('public.ticket');
    Route::any('support/ticket-list', 'SupportController@ticketList')->name('ticket.list');
    Route::get('ticket/{slug}','SupportController@viewTickets')->name('ticket.show');

    Route::get('/supports-serach','SupportController@getSuppotSearch')->name('supports.search');
    Route::post('/serach-list','SupportController@suppotSearch')->name('search.list');
    Route::get('post-reply','SupportController@postReply')->name('post.reply');
    


    Route::post('/ticket-suggestion-list','SupportController@ticketSuggestionList')->name('ticket.suggestion');
});

Route::group(['namespace'=>'Support','middleware'=>['auth:company,admin,web','verified','user.deactivated']], function () {

    Route::group(['middleware'=>['auth:web','verified', 'user.deactivated']], function () {
        Route::resource('support','SupportController');
    });
	Route::post('comment-loved','SupportController@commentLoved')->name('comment.loved');
	Route::get('ticket-status-change','SupportController@ticketStatusChange')->name('ticket.close');
	Route::post('comment-save', 'SupportController@saveComments')->name('comment.save');
    Route::get('tickets/{type?}','SupportController@getTickets')->name('my.ticket');

});



Route::group(['namespace' => 'Company', 'middleware' => ['auth:web,company,admin','user.deactivated']], function () {
    Route::get('support-tickets/{type}','TicketController@index')->name('support.ticket.list');
    Route::get('support-tickets/edit/{id}','TicketController@edit')->name('support.ticket.edit');
    Route::get('support-tickets/transfer_form/{id}','TicketController@transferForm')->name('support.ticket.transfer_form');
    Route::get('support-tickets/assign_employee_form/{id}','TicketController@assignEmployeeForm')->name('support.ticket.assign_employee_form');
    Route::post('support-tickets/action/{id}','TicketController@action')->name('support.ticket.action');


    Route::get('support-tickets/add-category/{id}','TicketController@addCategory')->name('support.ticket.add.category');

    Route::post('support-tickets/store-category','TicketController@ticketCategoryAdd')->name('support.ticket.category.store');

});

/*------------------------------- SUPPORT TICKET SYSTEM [END] -----------------------------------*/


Route::group(['namespace' => 'User', 'prefix' => 'settings','middleware' =>['auth:web,company','user.deactivated']],function(){

    Route::post('/change-password','UsersController@updatePassword')->name('users.update.password');

});


//Articles Routes
Route::get('articles/{slug?}', 'ArticleController@index')->name('article.list');
Route::post('/get-more-article', 'ArticleController@articleList')->name('get.more.article');
Route::get('article/{slug}', 'ArticleController@articleDetails')->name('article.details');


//knowledge Routes
Route::get('knowledge-base', 'KnowledgeController@index')->name('knowledge.list');

Route::post('/get-category-knowledge', 'KnowledgeController@knowledgeCategoryList')->name('get.category.knowledge');

Route::get('knowledgebase-listing/{category}', 'KnowledgeController@knowledgebaseListing')->name('knowledgebase.list');

Route::post('/get-more-knowledge', 'KnowledgeController@knowledgebaseAjaxList')->name('get.more.knowledge');

Route::get('knowledge/{slug}', 'KnowledgeController@knowledgebaseDetails')->name('knowledge.details');


/*End Admin Route Group*/


//Page  Routes
Route::get('page/{type}', 'HomeController@pages')->name('page');
Route::post('contact-message', 'HomeController@contactMessage')->name('contact.message');

Route::any('video/{id}', 'HomeController@getSingleVideo')->name('video.item');

//NewsLetter Subscribe
Route::post('newsletter/subscribe', 'NewsLetterController@save')->name('newsletter.subscribe');


Route::get('single-view-page/{type}/{slug}','HomeController@singleViewPage')->name('single.page.show');


//make a push notification.
Route::get('/push','PushController@push')->name('push');
//store a push subscriber.
Route::post('/push','PushController@store');
