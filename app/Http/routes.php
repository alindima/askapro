<?php

/**
 * Normal routes (not pro)
 */
Route::group(['middleware' => 'redirect_if_pro'], function(){
	
	//braintree webhook uri
	Route::post(
	    'braintree/webhook',
	    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
	);

	//home routes
	
	Route::get('/', [
		'uses' => 'HomeController@home',
		'as' => 'home',
	]);

	Route::get('premium', [
		'uses' => 'HomeController@premium',
		'as' => 'premium',
	]);

	Route::get('questions', [
		'uses' => 'HomeController@questions',
		'as' => 'questions',
	]);


	//account routes

	Route::get('dashboard', [
		'uses' => 'Auth\AccountController@dashboard',
		'as' => 'dashboard',
	]);

	Route::get('settings', [
		'uses' => 'Auth\SettingsController@index',
		'as' => 'settings.index',
	]);

	Route::post('settings/password/change', [
		'uses' => 'Auth\SettingsController@change_password',
		'as' => 'password.change',
	]);

	Route::get('settings/subscription/resume', [
		'uses' => 'Auth\SettingsController@resume_subscription',
		'as' => 'subscription.resume',
	]);

	Route::get('settings/subscription/cancel', [
		'uses' => 'Auth\SettingsController@cancel_subscription',
		'as' => 'subscription.cancel',
	]);

	Route::put('settings/subscription/payment_method', [
		'uses' => 'Auth\SettingsController@payment_method',
		'as' => 'subscription.payment_method',
	]);

	Route::delete('settings/delete_account', [
		'uses' => 'Auth\SettingsController@delete_account',
		'as' => 'account.delete'
	]);

	Route::get('premium/join', [
		'uses' => 'Auth\AccountController@getJoin',
		'as' => 'premium.join',
	]);

	Route::post('premium/join', 'Auth\AccountController@postJoin');

	Route::get('invoices', [
		'uses' => 'Auth\AccountController@invoices',
		'as' => 'invoices',
	]);

	Route::get('invoice/{id}', [
		'uses' => 'Auth\AccountController@invoice',
		'as' => 'invoice'
	]);


	//auth routes
	
	Route::get('signup', [
		'uses' => 'Auth\AuthController@getSignup',
		'as' => 'signup',
	]);

	Route::post('signup', 'Auth\AuthController@register');

	Route::get('login', [
		'uses' => 'Auth\AuthController@getLogin',
		'as' => 'login',
	]);
	
	Route::post('login', 'Auth\AuthController@login');

	Route::get('activate/{email}/{activation_token}', [
		'uses' => 'Auth\AuthController@verify',
		'as' => 'verify',
	]);

	//password routes
	
	Route::get('password/reset', [
		'uses' => 'Auth\PasswordController@getReset',
		'as' => 'password.reset',
	]);

	Route::post('password/reset', 'Auth\PasswordController@reset');

	Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm');

	Route::post('password/email', [
		'uses' => 'Auth\PasswordController@sendResetLinkEmail',
		'as' => 'password.email',
	]);

	//question routes
	
	Route::get('questions/create', [
		'uses' => 'Auth\QuestionController@create',
		'as' => 'question.create',
	]);

	Route::post('questions/create', [
		'uses' => 'Auth\QuestionController@store',
	]);

	Route::get('question/{question}/edit', [
		'uses' => 'Auth\QuestionController@edit',
		'as' => 'question.edit'
	]);

	Route::put('question/{question}/edit', [
		'uses' => 'Auth\QuestionController@update',
	]);

	Route::get('questions/mine', [
		'uses' => 'Auth\QuestionController@mine',
		'as' => 'questions.mine'
	]);

	Route::delete('question/{question}', [
		'uses' => 'Auth\QuestionController@delete',
	]);

	//answer routes
	
	Route::get('question/{question}/answer/{answer}/markAsBest', [
		'uses' => 'Auth\AnswerController@markAsBest',
		'as' => 'answer.markAsBest',
	]);

	Route::get('question/{question}/answer/{answer}/unmarkAsBest', [
		'uses' => 'Auth\AnswerController@unmarkAsBest',
		'as' => 'answer.unmarkAsBest',
	]);
});

/**
 * Both normal and pro routes
 */

Route::get('setLang/{lang}', [
	'uses' => 'HomeController@setLang',
	'as' => 'setLang',
]);

Route::get('logout', [
	'uses' => 'Auth\AuthController@logout',
	'as' => 'logout',
]);

Route::get('cookie_accept', [
	'uses' => 'HomeController@cookie_accept',
	'as' => 'cookie_accept',
]);

Route::get('@{user}', [
	'uses' => 'Auth\AccountController@profile',
	'as' => 'profile',
]);

Route::get('profile/edit', [
	'uses' => 'Auth\AccountController@getEdit',
	'as' => 'profile.edit',
]);

Route::put('profile/edit', 'Auth\AccountController@putEdit');

Route::post('api/markdown', [
	'uses' => 'ApiController@markdown',
	'as' => 'api.markdown',
]);

Route::get('questions/search/{tag?}', [
	'uses' => 'Auth\QuestionController@search',
	'as' => 'questions.search',
]);

Route::post('question/{question}/answers', [
	'uses' => 'Auth\AnswerController@store',
	'as' => 'answer.store',
]);

Route::get('question/{question}/answer/{answer}/edit', [
	'uses' => 'Auth\AnswerController@edit',
	'as' => 'answer.edit',
]);

Route::put('question/{question}/answer/{answer}/edit', 'Auth\AnswerController@update');

Route::get('question/{question}', [
	'uses' => 'Auth\QuestionController@show',
	'as' => 'question.show',
]);

/**
 * Pro routes
 */

Route::group(['middleware' => ['auth', 'pro']], function() {
	Route::get('pro', [
		'uses' => 'Pro\ProController@home',
		'as' => 'pro.home',
	]);

	Route::get('pro/mine', [
		'uses' => 'Pro\ProController@mine',
		'as' => 'pro.mine',
	]);
});
