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
        <link rel="stylesheet" href="{{ asset('css/front/front_information.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid information_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 information_top_box_filter">
                    <div class="information_top_title_box">
                        <span class="information_top_title_en">INFORMATION<br></span>
                        <span class="information_top_title_jp">新着情報</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 新着情報 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 information_contents_title_box">
                    <span class="information_contents_title">新着情報</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="row">

                        @foreach($res as $information)
                            <div class="col-12 col-md-12 col-lg-6 mb-4">
                                <div id="card_{{ $information->post_id }}" class="card click_class information_contents_box">
                                    <div class="row">
                                        
                                        <!-- 左要素 -->
                                        <div class="col-12 col-md-12 col-lg-4 information_contents_left_box">
                                            <img src="./img/hiromi_home_logo_side.png" class="img-fluid information_img_size" alt="...">
                                        </div>

                                        <!-- 右要素 -->
                                        <div class="col-12 col-md-12 col-lg-8 information_contents_right_box">
                                            <div class="card-body click_class">
                                                <span class="card-text" style="font-weight:bold;">{{ Common::format_date_hy($information->entry_date) }}<br></span>
                                                <span class="card-text">{{ $information->post_title }}<br></span>
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- ぺージネーション -->
                <div class="col-12 col-md-12 col-lg-12">
                    <div id="links" style="display:none;" class="mt-2">
                        {{ $res->links() }}
                    </div>
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
        <script src="{{ asset('js/front/front_information.js') }}"></script>
    </body>

</html>