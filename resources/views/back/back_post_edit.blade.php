<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>投稿詳細/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

        <!-- リッチエディタ -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

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
                                        <i class="bi bi-mailbox me-1"></i><span class="s_13r">投稿詳細</span> 
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
                            
                            <!-- 記事タイトル -->
                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>タイトル</label>
                                <input type="text" class="form-control" name="post_title" id="post_title" value="{{ $post_list->post_title }}" placeholder="例：記事タイトル" required>
                                <div class="invalid-feedback" id ="post_title_error">
                                    タイトルは必須です。
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <!-- 記事カテゴリ -->
                            <div class="col-12 col-md-12 col-lg-3 mb-3">
                                <label class="s_required mb-1"><i class="bi bi-check-lg me-1"></i>カテゴリ</label>
                                <select class="form-select" name="post_type_id" id="post_type_id" required>
                                    <option></option>
                                    @foreach($post_type_list as $post_type)
                                        <option value="{{ $post_type->post_type_id }}" @if($post_list->post_type_id == $post_type->post_type_id) selected @endif>{{ $post_type->post_type_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id ="post_type_id_error">
                                    カテゴリは必須です。
                                </div>
                            </div>

                            <!-- 記事本文 -->
                            <div class="col-12 col-md-12 col-lg-12 mb-4">
                                <!-- 入力欄 -->
                                <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>記事本文</label>
                                <div id="editor" style="min-height:30rem;">{!! $post_list->post_contents !!}</div>

                                <!-- 確認欄：非表示の場合は、style="display: none" -->
                                <!-- <textarea id="editor_input" name="editor_input" style="display: none" required></textarea> -->
                                <textarea id="editor_input" style="min-height:30rem; display: none;" name="editor_input" required>{{ $post_list->post_contents }}</textarea>
                            </div>

                            <!-- 削除ボタン -->
                            <div class="col-12 col-md-12 col-lg-6 bg-info mb-3">
                                <div class="btn-group float-start" role="group">
                                    <button type="button" id="btn_delete" class="btn btn-outline-danger btn_size_10"><i class="bi bi-trash me-1"></i>削除</button>
                                </div>
                            </div>

                            <!-- 投稿ボタン -->
                            <div class="col-12 col-md-12 col-lg-12 bg-info">
                                <div class="btn-group float-end" role="group">
                                    <button type="button" id="btn_edit" class="btn btn-outline-primary btn_size_10"><i class="bi bi-plus me-1"></i>投稿</button>
                                </div>
                            </div>

                            <!-- id -->
                            <input type="hidden" name="post_id" id="post_id" value="{{ $post_list->post_id }}">

                        </form>
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
        <script src="{{ asset('js/back/back_post_edit.js') }}"></script>
		
	</body>
</html>