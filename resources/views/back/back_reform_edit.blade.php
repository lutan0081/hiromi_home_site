<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>施工事例詳細/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

        <!-- リッチエディタ -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

		<!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/back/back_reform_edit.css') }}">
		
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
            <main class="page-content">

                <!-- タイトル -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="mt-3">
                                        <i class="bi bi-wrench-adjustable me-1"></i>施工事例詳細
                                    </div>
                                    <hr class="bar_blue">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- タブ：タイトル -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-reform_contents-tab" data-bs-toggle="tab" href="#nav-reform_contents" role="tab" aria-controls="nav-reform_contents" aria-selected="true">記事項目</a>
                                    <a class="nav-link" id="nav-reform_picture-tab" data-bs-toggle="tab" href="#nav-reform_picture" role="tab" aria-controls="nav-reform_picture" aria-selected="false">施工写真</a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- タブ：コンテンツ -->
                <div class="container">
                    <div class="row row-cols-3">
                        <div class="col-12 col-md-12 col-lg-12 mb-3">
                            <div class="tab-content" id="nav-tabContent">
                            
                                <!-- 記事項目 -->
                                <div class="tab-pane fade show active" id="nav-reform_contents" role="tabpanel" aria-labelledby="nav-reform_contents-tab">
                                    <div class="row row-cols-2">
                                        <!-- 記事タイトル -->
                                        <div class="col-12 col-md-12 col-lg-6 mb-3">
                                            <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>タイトル</label>
                                            <input type="text" class="form-control" name="reform_title" id="reform_title" value="{{ $reform_list->reform_title }}" placeholder="例：記事タイトル" required>
                                            <div class="invalid-feedback" id ="reform_title_error">
                                                タイトルは必須です。
                                            </div>
                                        </div>

                                        <div class="w-100"></div>

                                        <!-- サブタイトル -->
                                        <div class="col-12 col-md-12 col-lg-6 mb-3">
                                            <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>サブタイトル</label>
                                            <input type="text" class="form-control" name="reform_sub_title" id="reform_sub_title" value="{{ $reform_list->reform_sub_title }}" placeholder="例：サブタイトル" required>
                                            <div class="invalid-feedback" id ="reform_sub_title_error">
                                                サブタイトルは必須です。
                                            </div>
                                        </div>

                                        <!-- 記事本文 -->
                                        <div class="col-12 col-md-12 col-lg-12 mb-4">
                                            <!-- 入力欄 -->
                                            <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>記事本文</label>
                                            <div id="editor" style="min-height:30rem;"></div>

                                            <!-- 確認欄：非表示の場合は、style="display: none" -->
                                            <!-- <textarea id="reform_contents" style="min-height:30rem;" name="reform_contents" required>{{ $reform_list->reform_contents }}</textarea> -->
                                        </div>

                                    </div>
                                </div>

                                <!-- 施工事例 -->
                                <div class="tab-pane fade" id="nav-reform_picture" role="tabpanel" aria-labelledby="nav-reform_picture-tab">
                                    <div class="row row-cols-3">

                                        <!-- 記事本文 -->
                                        <div class="col-12 col-md-12 col-lg-12 mb-4">
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="container mt-4">
                    <div class="row">

                        <!-- 削除ボタン -->
                        <div class="col-12 col-md-12 col-lg-6">
                            <div class="btn-group float-start" role="group">
                                <button type="button" id="btn_delete" class="btn btn-outline-danger btn_size_10"><i class="bi bi-trash me-1"></i>削除</button>
                            </div>
                        </div>

                        <!-- 投稿ボタン -->
                        <div class="col-12 col-md-12 col-lg-6">
                            <div class="btn-group float-end" role="group">
                                <button type="button" id="btn_edit" class="btn btn-outline-primary btn_size_10"><i class="bi bi-plus me-1"></i>投稿</button>
                            </div>
                        </div>

                        <!-- id -->
                        <div class="col-12 col-md-12 col-lg-12">
                            <input type="hidden" name="reform_id" id="reform_id" value="">
                        </div>

                    </div>
                </div>






















                
            </main>
		</div>
	        
        <!-- 共通js -->
        @component('component.back_js')
        @endcomponent
        
        <!-- リッチエディタ -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            // 本体
            var editor = document.getElementById('editor');
            // テキストエリア
            var editorInput = document.getElementById('editor_input');
            // 初期設定読込み
            var quill = quillEditor("editor");

            // エディタ内容の変更時
            quill.on('text-change', function(delta, oldDelta, source) {
                var editorHtml = editor.querySelector('.ql-editor').innerHTML;
                editorInput.value = editorHtml;
            });

            // quill初期設定(外部ファイルにして読み込む)
            function quillEditor(make_id) {
                var toolbarOptions;
                var quill;
                var themes = "snow";

                // ツールバー機能の設定
                toolbarOptions = [
                    // 見出し
                    [{
                        'header': [1, 2, 3, false]
                    }],
                    // フォント種類
                    [{
                        'font': []
                    }],
                    // 文字寄せ
                    [{
                        'align': []
                    }],
                    // 太字、斜め、アンダーバー
                    ['bold', 'italic', 'underline'],
                    // 文字色
                    [{
                            'color': []
                        },
                        // 文字背景色
                        {
                            'background': []
                        }
                    ],
                    // リスト
                    [{
                            'list': 'ordered'
                        },
                        {
                            'list': 'bullet'
                        }
                    ],
                    // インデント
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    // 画像挿入
                    ['image'],
                    // 動画
                    ['video'],
                    // 数式
                    ['formula'],
                    // URLリンク
                    ['link']
                ];

                make_id = '#' + make_id;

                // エディタの情報を生成
                quill = new Quill(make_id, {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    placeholder: '本文を入力してください',
                    theme: themes
                });

                return quill;
            }
        </script>

		<!-- 自作js -->
        <script src="{{ asset('js/back/back_reform_edit.js') }}"></script>
		
	</body>
</html>