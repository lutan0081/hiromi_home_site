<?php

/**
 * front
 */
// top:表示
Route::get('/', 'Front\Home\FrontHomeController@frontHomeInit');

// プライバシー:表示
Route::get('frontPrivacyInit', 'Front\Privacy\FrontPrivacyController@frontPrivacyInit');
