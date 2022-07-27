<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>HIROMI HOME</title>

        <!-- 説明 -->
        <meta name="description" content="「株式会社広末ホーム」は、テキストテキストテキストテキストテキストテキストテキストテキスト" />
        
        <!-- SEO -->
        <meta name="keywords"  content="テキスト,テキスト,テキスト,テキスト,テキスト,テキスト,テキスト" />

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_home.css') }}">

    </head>

    <body>
        <!-- 初回ローディング画面 -->
        <div id="splash">
            <div id="splash-logo">読み込み中...</div>
        </div>

        <div class="splashbg"></div>
        <!-- 初回ローディング画面 -->

        <!---画面遷移用-->
        <div id="container">

            <!-- プルダウンメニュー -->
            @component('component.front_menu')
            @endcomponent

            <!-- top動画 -->
            <div class="video-container movie">
                <div class="video-wrap overlay">
                    <video src="./video/front_top.mp4" type="video/mp4" playsinline loop autoplay muted></video>
                </div>		
            </div>
            <!-- top動画 -->

            <!-- top画面の文字 -->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <h1 class="top_video_box">
                            <!-- top画面の文字：英語 -->
                            <p>
                                <span class="slide-in leftAnime">
                                    <span class="slide-in_inner leftAnimeInner">We make create the best space.</span>
                                </span>
                            </p>
                            
                            <!-- top画面の文字：日本語 -->
                            <p>
                                <span class="slide-in leftAnime_jp">
                                    <span class="slide-in_inner leftAnimeInner">「<span class="text_red">住</span>みたい空間」「<span class="text_red">し</span>たい暮らし」を創造する。</span>
                                </span>
                            </p>
                        </h1>
                    </div>
                </div>
            </div>
            <!-- top画面の文字 -->

            
            



        </div>
        <!---画面遷移用-->

        <!-- js -->
        @component('component.front_js')
        @endcomponent
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_home.js') }}"></script>
    </body>

</html>