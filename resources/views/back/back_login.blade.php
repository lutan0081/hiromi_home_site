<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>ログイン/HIROMI HOME</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

		<!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/back/back_login.css') }}">

        <style>
            /* 一覧の左右に余白が出来るため、0に設定 */
            .card-body {
                padding: 0rem;
            }
		</style>
        
	</head>

	<body>
	
        <!-- 一覧 -->
        <div class="container-fluid">
            
            <div class="row">
                    
                <!-- テーブルcard -->
                <div class="col-12 col-md-12 col-lg-12">

                    <!-- テーブルcard -->
                    <div class="main_container">
                        <div class="box_container px-5">

                            <div class="row">
                                
                                <!-- ロゴ -->
                                <div class="col-12 col-md-12 col-lg-12 mt-3 logo_box">
                                    <img src="./img/hiromi_home_logo_side.png" class="logo_size" alt="">
                                </div>

                                <!-- ロゴ -->
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div style="display:none" class="msg"></div>
                                </div>

                                <!-- メールアドレス -->
                                <div class="col-12 col-md-12 col-lg-12 mt-3">
                                    <label class="label_required mb-2" for="textBox"></label>メールアドレス
                                    <input type="text" class="form-control" name="create_user_mail" id="create_user_mail" placeholder="例：メールアドレス" value="" required>
                                    
                                    <!-- エラーメッセージ -->
                                    <div class="invalid-feedback" id ="create_user_mail_error">
                                        メールアドレスは必須です。
                                    </div>
                                </div>

                                <!-- パスワード -->
                                <div class="col-12 col-md-12 col-lg-12 mt-3">
                                    <label class="label_required mb-2" for="textBox"></label>パスワード
                                    <input type="password" class="form-control" name="create_user_password" id="create_user_password" placeholder="例：パスワード" value="" required>
                                    
                                    <!-- エラーメッセージ -->
                                    <div class="invalid-feedback" id ="create_user_password_error">
                                        パスワードは必須です。
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-lg-12 mt-4">
                                    <a href="#" id="btn_login" class="btnDraw bgleft float-end"><span>ログイン</span></a><br>
                                </div>

                                <div class="col-12 col-md-12 col-lg-12 mt-4 forgot_box">
                                    パスワードを忘れてしまった場合はこちら
                                </div>

                            </div>
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- 一覧 --> 

        <!-- 共通js -->
        @component('component.back_js')
        @endcomponent

		<!-- 自作js -->
		<script src="{{ asset('js/back/back_login.js') }}"></script>
	</body>
	
</html>