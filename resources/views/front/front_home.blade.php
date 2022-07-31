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

        <!-- Googleフォント：トップ画面 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

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

            <!-- top画面のロゴ -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 top_logo_box">
                        <img src="./img/hiromi_home_logo_side.png" class="top_log_size">
                    </div>
                </div>
            </div>

            <!-- top動画 -->
            <div class="video-container movie">
                <div class="video-wrap overlay">

                    <!-- top動画の設定 -->
                    <video src="./video/front_top.mp4" type="video/mp4" playsinline loop autoplay muted></video>

                    <!-- top画面文字 -->
                    <h1 class="top_video_box">
                        <!-- top画面の文字：英語 -->
                        <span class="slide-in leftAnime">
                            <span class="slide-in_inner leftAnimeInner">We make create the best space.</span>
                        </span>
        
                        <!-- top画面の文字：日本語 -->
                        <span class="slide-in leftAnime_jp">
                            <span class="slide-in_inner leftAnimeInner">「住みたい<span class="text_red">空</span>間」「したい<span class="text_red">暮</span>らし」を創造する。
                        </span>
                    </h1>

                </div>		
            </div>

            <hr class="boderTrigger"> 

            <!-- 施工事例:：タイトル -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 works_title_box">
                        <span class="works_title_en"><span class="text_red">W</span>ORKS</span><br>
                        <span class="works_title_jp">施工事例</span>
                    </div>
                </div>
            </div> 

            <!-- 施工事例：コンテンツ -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 mt-3">
                        <div class="row delayScroll">
                            <!-- 施工事例：1 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_01.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：2 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_02.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：3 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_03.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：4 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_04.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：1 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_01.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：2 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_02.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：3 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3 box">
                                <img src="./img/works_03.jpg" class="img-fluid" alt="...">
                            </div>
                            <!-- 施工事例：4 -->
                            <div class="col-12 col-md-12 col-lg-3 mt-3">
                                <img src="./img/works_04.jpg" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
                
            <!-- 施工事：ボタン -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 mt-3">
                        <div class="row">
                            <!-- 施工事例：1 -->
                            <div class="col-12 col-md-12 col-lg-12 mt-3 fadeUpTrigger">
                                <a href="#" class="btn bgleft float-end"><span>VIEW ALL</span></a><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- 事業内容:：タイトル -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 service_title_box">
                        <span class="service_title_en"><span class="text_red">S</span>ERVICE</span><br>
                        <span class="service_title_jp">事業内容</span>
                    </div>
                </div>
            </div>

            <!-- 事業内容：コンテンツ -->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 mt-3">
                        <div class="row delayScroll">

                            <!-- 事業内容：1 -->
                            <div class="col-12 col-md-12 col-lg-4 mt-3 box">
                                <div class="colorfilter-base service_box">
                                    <img src="./img/service_01.jpg" class="img-fluid colorfilter-image" alt="...">
                                    <div class="service_contents">
                                        <span class="service_en">REFORM<br></span>
                                        <span class="service_jp">リフォーム</span>
                                    </div>
                                </div>
                            </div>

                            <!-- 事業内容：2 -->
                            <div class="col-12 col-md-12 col-lg-4 mt-3 box">
                                <div class="colorfilter-base service_box">
                                    <img src="./img/service_02.jpg" class="img-fluid colorfilter-image" alt="...">
                                    <div class="service_contents">
                                        <span class="service_en">RENOVATION<br></span>
                                        <span class="service_jp">リノベーション</span>
                                    </div>
                                </div>
                            </div>

                            <!-- 事業内容：3 -->
                            <div class="col-12 col-md-12 col-lg-4 mt-3 box">
                                <div class="colorfilter-base service_box">
                                    <img src="./img/service_03.jpg" class="img-fluid colorfilter-image" alt="...">
                                    <div class="service_contents">
                                        <span class="service_en">SUPPORT<br></span>
                                        <span class="service_jp">入居者対応</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
            
            <!-- 会社概要 -->
            <div class="container-fluid about_us_box">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 about_us_contents">
                        <div class="row">

                            <!-- 会社概要コンテンツ -->
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="col-12 col-md-12 col-lg-12 p-5 fadeUpTrigger">
                                    <div class="about_us_title">
                                        「住みたい空間」「したい暮らし」を創造する。
                                    </div>
                                    <div class="about_us_text">
                                        弊社、広末ホームのコーポレートサイトを閲覧いただきありがとうございます。<br>
                                        空間に対するこだわりは、十人十色。 デザインの美学や、理想の暮らしは人によって異なります。<br> だからこそ、シンプルでミニマルなものを私たちは追求します。<br>
                                        ディティールを生かす意匠、シンプルな形状は、 あなたの個性を自由に演出することができるからです。<br> 思わず誰かを招きたくなるような、スタイリッシュなデザインは、 見る人の感性を刺激し、創造力を高めてくれます。<br>
                                        毎日を、自分らしく、豊かに生きる。 そんな幸せがある空間の創造を、お手伝いいたします。
                                    </div>
                                </div>
                            </div>

                            <!-- 会社概要ボタン -->
                            <div class="col-12 col-md-12 col-lg-6">
                                <a href="#" class="btnshine btn_size_10 float-end zoomInTrigger"><i class="bi bi-cloud me-2"></i>ABOUT US</a>
                            </div>

                            <!-- お問い合わせ -->
                            <div class="col-12 col-md-12 col-lg-6">
                                <a href="#" class="btnshine btn_size_10 float-start zoomInTrigger"><i class="bi bi-chat-dots me-2"></i>CONTACT</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 新着情報:：タイトル -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 information_title_box">
                        <span class="information_title_en"><span class="text_red">I</span>NFORMATION</span><br>
                        <span class="information_title_jp">新着情報</span>
                    </div>
                </div>
            </div>

            <!-- 新着情報：コンテンツ -->
            <div class="container fadeUpTrigger">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 mt-3">
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                2022-07-01
                            </div>
                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                <label class="required" for="textBox"></label>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 py-4 information_contents">
                                コーポレートサイト開設のお知らせ
                            </div>

                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                2022-07-01
                            </div>
                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                <label class="required" for="textBox"></label>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 py-4 information_contents">
                                コーポレートサイト開設のお知らせ
                            </div>

                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                2022-07-01
                            </div>
                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                <label class="required" for="textBox"></label>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 py-4 information_contents">
                                コーポレートサイト開設のお知らせ
                            </div>

                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                2022-07-01
                            </div>
                            <div class="col-12 col-md-12 col-lg-2 py-4 information_contents">
                                <label class="required" for="textBox"></label>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 py-4 information_contents">
                                コーポレートサイト開設のお知らせ
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mt-5">
                                <a href="#" class="btn bgleft float-end"><span>VIEW ALL</span></a><br>
                            </div>

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

        </div>
        <!---画面遷移用-->

        <!-- js -->
        @component('component.front_js')
        @endcomponent
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_home.js') }}"></script>
    </body>

</html>