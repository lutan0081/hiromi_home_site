<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>サイトマップ/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_site_map.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid site_map_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 site_map_box_filter">
                    <div class="site_map_top_title_box">
                        <span class="site_map_top_title_en">SITE MAP<br></span>
                        <span class="site_map_top_title_jp">サイトマップ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- プライバシー内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 site_map_contents_title_box">
                    <span class="site_map_contents_title">サイトマップ</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12 site_map_contents_box">
                    
                    <!-- home -->
                    <span style="font-weight:bold;"><i class="bi bi-house-door me-1"></i>HOME<br></span>
                    -ホーム<br>
                    -プライバシー<br>
                    -サイトマップ<br>
                    -新着情報<br><br>

                    <!-- 会社概要 -->
                    <span style="font-weight:bold;"><i class="bi bi-building me-1"></i>COMPANY<br></span>
                    -会社概要<br>
                    -お問い合わせ<br><br>

                    <!-- サービス -->
                    <span style="font-weight:bold;"><i class="bi bi-gem me-1"></i>SERVICE<br></span>
                    -施工事例<br>
                    -ブログ<br><br>

                    <!-- リクルート -->
                    <span style="font-weight:bold;"><i class="bi bi-search me-1"></i>RECRUIT<br></span>
                    -採用情報<br>

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
        <script src="{{ asset('js/front/front_home.js') }}"></script>
    </body>

</html>