<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>新着情報/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_information_edit.css') }}">
    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid information_edit_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 information_edit_top_box_filter">
                    <div class="information_edit_top_title_box">
                        <span class="information_edit_top_title_en">INFORMATION<br></span>
                        <span class="information_edit_top_title_jp">新着情報</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 新着情報：タイトル -->
        <div class="container fadeUpTrigger">
            <div class="row">
                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 information_edit_contents_title_box">
                    <span class="information_edit_contents_title">{{ $information_edit_list->post_title }}</span>
                    <hr class="bar_red"> 
                </div>
            </div>
        </div>

        <!-- 新着情報：内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 information_edit_contents_box">
                    {!! $information_edit_list->post_contents !!}
                </div>
            </div>
        </div>

        <!-- ボタン：戻る -->
        <div class="container fadeUpTrigger">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 mt-3">
                    <a href="frontInformationInit" class="btnshine btn_size_12 float-end zoomInTrigger">お知らせ一覧</a>
                </div>
            </div>
        </div>

        <!-- お問い合わせ -->
        @component('component.front_contact')
        @endcomponent

        <!-- フッター -->
        @component('component.front_footer')
        @endcomponent

        <!-- js -->
        @component('component.front_js')
        @endcomponent
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_information_edit.js') }}"></script>
    </body>

</html>