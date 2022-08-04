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

// サイトマップ:表示
Route::get('frontSiteMapInit', 'Front\SiteMap\FrontSiteMapController@frontSiteMapInit');

// 施工事例:表示
Route::get('frontWorksInit', 'Front\Works\FrontWorksController@frontWorksInit');