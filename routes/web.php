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

// 施工事例詳細:表示
Route::get('frontWorksEditInit', 'Front\Works\FrontWorksController@frontWorksEditInit');

// 新着情報:表示
Route::get('frontInformationInit', 'Front\Information\FrontInformationController@frontInformationInit');

// 新着情報：詳細表示
Route::get('frontInformationEditInit', 'Front\Information\FrontInformationController@frontInformationEditInit');

/**
 * back
 */
// ログイン画面：表示
Route::get('backLoginInit', 'Back\Login\BackLoginController@backLoginInit');

// ログイン画面：ログインの処理
Route::post('backLoginEntry', 'Back\Login\BackLoginController@backLoginEntry');

// メイン画面：表示
Route::get('backHomeInit', 'Back\Home\BackHomeController@backHomeInit')->middleware("post_auth");

// 投稿一覧：表示
Route::any('backPostInit', 'Back\Post\BackPostController@backPostInit')->middleware("post_auth");

// 投稿詳細：新規表示
Route::get('backPostNewInit', 'Back\Post\BackPostController@backPostNewInit')->middleware("post_auth");

// 投稿詳細：編集表示
Route::get('backPostEditInit', 'Back\Post\BackPostController@backPostEditInit')->middleware("post_auth");

// 投稿詳細：登録
Route::post('backPostEntry', 'Back\Post\BackPostController@backPostEntry')->middleware("post_auth");

// 投稿詳細：削除
Route::post('backPostDeleteEntry', 'Back\Post\BackPostController@backPostDeleteEntry')->middleware("post_auth");

// 投稿詳細：公開・非公開
Route::post('backPostReleaseEntry', 'Back\Post\BackPostController@backPostReleaseEntry')->middleware("post_auth");

// 施工事例一覧：表示
Route::any('backReformInit', 'Back\Reform\BackReformController@backReformInit')->middleware("post_auth");

// 施工事例詳細：新規表示
Route::get('backReformNewInit', 'Back\Reform\BackReformController@backReformNewInit')->middleware("post_auth");

// 施工事例詳細：編集表示
Route::get('backReformEditInit', 'Back\Reform\BackReformController@backReformEditInit')->middleware("post_auth");

// 施工事例詳細：公開・非公開
Route::post('backReformReleaseEntry', 'Back\Reform\BackReformController@backReformReleaseEntry')->middleware("post_auth");


