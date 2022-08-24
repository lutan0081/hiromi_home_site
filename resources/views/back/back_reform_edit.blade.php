<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>施工事例：詳細/POST</title>

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
                                        <i class="bi bi-wrench-adjustable me-1"></i>施工事例：詳細
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
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <form id="editForm" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="card border border-0">
                                                    <div class="card-body">
                                                        <!-- 入力欄 -->
                                                        <label class="s_required mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>記事本文</label>
                                                        <div id="editor" style="min-height:30rem;">{!! $reform_list->reform_contents !!}</div>

                                                        <!-- 確認欄：非表示の場合は、style="display: none" -->
                                                        <!-- <textarea id="editor_input" style="min-height:30rem; display: none;" name="editor_input" required>{{ $reform_list->reform_contents }}</textarea> -->
                                                        <textarea id="editor_input" style="min-height:30rem; display: none;" name="editor_input" required>{{ $reform_list->reform_contents }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 施工事例 -->
                                    <div class="tab-pane fade" id="nav-reform_picture" role="tabpanel" aria-labelledby="nav-reform_picture-tab">
                                        <div class="row">

                                            <!-- 一括アップロードエリア -->
                                            <div class="col-12 col-md-12 col-lg-12 mb-4">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <!-- ドラッグ&ドロップエリア -->
                                                        <div id="image_upload_section">
                                                            <div id="drop" class="uplode_box" ondragover="onDragOver(event)" ondrop="onDrop(event)">
                                                                ファイルをドラッグ&ドロップしてください。複数ファイル同時も対応しています。
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ファイルアップロード -->
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                                <input class="form-control" id="img_files" type="file" name="img_files[]" multiple />
                                                <div class="invalid-feedback" id ="img_files_error"></div>
                                            </div>

                                            <!-- 罫線 -->
                                            <div class="col-12 col-md-12 col-lg-12 mb-4">
                                                <hr class="bar_blue">
                                            </div>

                                            @foreach($img_list as $imgs)
                                                <div class="col-12 col-md-12 col-lg-4 mb-4">
                                                    <div class="card">
                                                        <!-- 画像 -->
                                                        <img src="storage/{{ $imgs->img_path }}" class="card-img-top" style="height:16rem; alt="...">
                                                        <div class="card-body">
                                                            <div class="card-text p-3">

                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 col-lg-12">
                                                                        <span>種別：{{ $imgs->img_type_name }}</span>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 col-lg-12">
                                                                        <span>備考：{{ $imgs->img_memo }}</span>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 col-lg-6 mt-3">
                                                                        <button type="button" id="btn_delete_{{ $imgs->img_id }}" class="btn_modal_delete btn btn-outline-danger btn_size_6 float-start"><i class="bi bi-trash me-1"></i>削除</button>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 col-lg-6 mt-3">
                                                                        <button type="button" id="btn_edit_{{ $imgs->img_id }}" class="btn_modal btn btn-outline-primary btn_size_6 float-end"><i class="bi bi-pen me-1"></i>編集</button>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal_img" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="staticBackdropLabel">画像編集</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-12 col-md-12 col-lg-12 mb-3">
                                            <img src="" id="modal_img_box" class="card-img-top" style="height:15rem; alt="...">
                                        </div>

                                        <div class="col-12 col-md-12 col-lg-12 mb-3">
                                        <label class="s_any mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>種別</label>
                                            <select class="form-select disabled_class" name="img_type_id" id="img_type_id" required>
                                                <option></option>
                                                @foreach($img_type_list as $img_type)
                                                    <option value="{{$img_type->img_type_id}}">{{ $img_type->img_type_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id ="img_type_id_error">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 col-lg-12 mb-3">
                                            <label class="s_any mb-1" for="textBox"><i class="bi bi-check-lg me-1"></i>備考</label>
                                            <textarea class="form-control" id="img_memo" rows="3"></textarea>
                                            <div class="invalid-feedback" id ="img_memo_error">
                                            </div>
                                        </div>

                                        <!-- 画像id -->
                                        <div class="col-12 col-md-12 col-lg-12 mb-3">
                                            <input type="hidden" class="form-control" name="img_id" id="img_id" value="{{ $reform_list->reform_title }}" placeholder="例：記事タイトル" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="btn_modal_close" class="btn btn-outline-secondary btn_size_6" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i>閉じる</button>
                                <button type="button" id="btn_modal_edit" class="btn btn-outline-primary btn_size_6"><i class="bi bi-pen me-1"></i>登録</button>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="container mt-1">
                    <div class="row">

                        <!-- 削除ボタン -->
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="btn-group float-start" role="group">
                                <button type="button" id="btn_delete" class="btn btn-outline-danger btn_size_10"><i class="bi bi-trash me-1"></i>削除</button>
                            </div>
                        </div>

                        <!-- 投稿ボタン -->
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="btn-group float-end" role="group">
                                <button type="button" id="btn_edit" class="btn btn-outline-primary btn_size_10"><i class="bi bi-plus me-1"></i>投稿</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- id -->
                <div class="col-12 col-md-12 col-lg-12">
                    <input type="hidden" name="reform_id" id="reform_id" value="{{ $reform_list->reform_id }}">
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