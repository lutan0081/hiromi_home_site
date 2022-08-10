<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>投稿一覧/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

		<!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/back/back_post.css') }}">
		
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

                <!-- 上段検索 -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-2">

                            <!-- タイトル -->
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="mt-3">
                                        <i class="bi bi-mailbox me-1"></i>投稿一覧
                                    </div>
                                    <hr class="bar_blue">
                                </div>
                            </div>
                            
                            <!-- 検索欄 -->
                            <div class="row">
                                <form action="backPostInit" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="row align-items-end">
                                            <!-- フリーワード -->
                                            <div class="col-7 col-md-8 col-lg-4">
                                                <label for="">フリーワード</label>
                                                <input type="text" class="form-control" name="free_word" id="free_word" value="{{ $free_word }}">
                                            </div>
                                            <!-- 検索ボタン -->
                                            <div class="col-5 col-md-4 col-lg-8">
                                                <button type="submit" class="btn btn-outline-primary float-end btn_size_7"><i class="bi bi-search me-1"></i>検索</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        
                <!-- 一覧 -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="overflow-auto" style="height:40rem;">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <!-- テーブルヘッド -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col" id="post_id" style="display:none">id</th>
                                                        <th>公開</th>
                                                        <th scope="col" id="post_title">記事タイトル</th>
                                                        <th scope="col" id="post_tyoe">カテゴリ</th>
                                                        <th scope="col" id="entry_user_id">作成者</th>
                                                        <th scope="col" id="entry_date">登録日</th>
                                                        <th scope="col" id="entry_date"></th>
                                                    </tr>
                                                </thead>

                                                <!-- テーブルボディ -->
                                                <tbody>
                                                    @foreach($res as $post_list)
                                                        <tr>
                                                            <td id="id_{{ $post_list->post_id }}" class="click_class" style="display:none"></td>
                                                            <td id="cb_{{ $post_list->post_id }}" class="click_class"><input class="form-check-input check_class" type="checkbox" value="" name="aaa" id="v_{{ $post_list->post_id }}" @if( $post_list->active_flag == 0 ) checked @endif></td>
                                                            <td id="title_{{ $post_list->post_id }}" class="click_class">{{ $post_list->post_title }}</td>
                                                            <td id="type_{{ $post_list->post_id }}" class="click_class">{{ $post_list->post_type_name }}</td>
                                                            <td id="user_{{ $post_list->post_id }}" class="click_class">{{ $post_list->create_user_name }}</td>
                                                            <td id="date_{{ $post_list->post_id }}" class="click_class">{{ $post_list->entry_date }}</td>
                                                            <td id="date_{{ $post_list->post_id }}" class="click_class"><a href=""><i class="bi bi-three-dots"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ぺージネーション -->
                            <div id="links" style="display:none;" class="mt-2">
                                {{ $res->appends($paginate_params)->links() }}
                            </div>
                        </div>

                        <!-- ボタン -->
                        <div class="col-sm-12 mt-3">
                            <div class="card border border-0">
                                <div class="row">
                                    <!-- ボタン -->
                                    <div class="col-12">
                                        <div class="btn-group float-end" role="group">
                                            <button type="button" onclick="location.href='backPostNewInit'" class="btn btn-outline-primary float-end btn_size_7"><i class="bi bi-plus"></i>新規登録</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>
		</div>
	        
        <!-- 共通js -->
        @component('component.back_js')
        @endcomponent

		<!-- 自作js -->
        <script src="{{ asset('js/back/back_post.js') }}"></script>
		
	</body>
</html>