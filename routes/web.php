<?php

/**
 * front
 */
// top:表示
Route::get('/', 'Front\Home\FrontHomeController@frontHomeInit');

// プライバシー:表示
Route::get('frontPrivacyInit', 'Front\Privacy\FrontPrivacyController@frontPrivacyInit');

// 会社概要:表示
Route::get('frontAboutUsInit', 'Front\AboutUs\FrontAboutUsController@frontAboutUsInit');

// お問い合わせ:表示
Route::get('frontContactInit', 'Front\Contact\FrontContactController@frontContactInit');