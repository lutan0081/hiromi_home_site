<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>ユーザ情報/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

		<!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/back/back_post_edit.css') }}">
		
        <style>
            /* 一覧の左右に余白が出来るため、0に設定 */
            .card-body {
                padding: 0rem;
            }
		</style>
        
	</head>

	<body>
		<!-- page-wrapper -->
		<div class="page-wrapper chiller-theme toggled">

            <!-- ローディング画面 -->
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>
        
            <!-- sidebar-wrapper  -->
            @component('component.back_sidebar')
            @endcomponent
            
            <!-- 以下から記載" -->
            <main class="page-content mb-3">

                <!-- タイトル -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="mt-3">
                                        <i class="bi bi-person-fill me-1"></i>ユーザ情報
                                    </div>
                                    <hr class="bar_blue">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 入力項目 -->
                <div class="container">
                    <div class="row">
                        <form id="editForm" class="needs-validation" novalidate>

                            <!-- ログインユーザ名 -->
                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>ユーザ名</label>
                                <input type="text" class="form-control" name="create_user_name" id="create_user_name" value="{{ $user_list->create_user_name }}" placeholder="例：株式会社ルタン" required>
                                <div class="invalid-feedback" id ="create_user_name_error">
                                    ユーザ名は必須です。
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <!-- メールアドレス -->
                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>メールアドレス</label>
                                <input type="text" class="form-control" name="create_user_mail" id="create_user_mail" value="{{ $user_list->create_user_mail }}" placeholder="例：lutan0081.h@gmail.com" required>
                                <div class="invalid-feedback" id ="create_user_mail_error">
                                    メールアドレスは必須です。
                                </div>
                            </div>

                            <!-- パスワード -->
                            <div class="col-12 col-md-12 col-lg-6 mb-4">
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>パスワード</label>
                                <input type="password" class="form-control" name="create_user_password" id="create_user_password" value="{{ $user_list->create_user_password }}" placeholder="例：lutan0081" required>
                                <div class="invalid-feedback" id ="create_user_password_error">
                                    パスワードを確認してください。
                                </div>
                            </div>

                            <!-- パスワード確認用 -->
                            <div class="col-12 col-md-12 col-lg-6 mb-4">
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>パスワード確認用</label>
                                <input type="password" class="form-control" name="create_user_password_again" id="create_user_password_again" value="" placeholder="例：lutan0081" required>
                                <div class="invalid-feedback" id="create_user_password_again_error">
                                    パスワードを確認してください。
                                </div>
                            </div>

                            <!-- 投稿ボタン -->
                            <div class="col-12 col-md-12 col-lg-12 bg-info">
                                <div class="btn-group float-end" role="group">
                                    <button type="button" id="btn_edit" class="btn btn-outline-primary btn_size_10"><i class="bi bi-plus me-1"></i>登録</button>
                                </div>
                            </div>

                            <!-- id -->
                            <input type="hidden" name="create_user_id" id="create_user_id" value="{{ $user_list->create_user_id }}">
                            
                        </form>
                    </div>
                </div>
                
            </main>
		</div>
	        
        <!-- 共通js -->
        @component('component.back_js')
        @endcomponent

		<!-- 自作js -->
        <script src="{{ asset('js/back/back_user_edit.js') }}"></script>
		
	</body>
</html>