<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>リノベーション/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">
        <!-- slick -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_renovation.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid renovation_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 renovation_top_box_filter">
                    <div class="renovation_top_box_title_box">
                        <span class="renovation_top_title_en">RENOVATION<br></span>
                        <span class="renovation_top_title_jp">リノベーション</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 renovation_contents_title_box">
                    <span class="renovation_contents_title">住宅は人を包み、人生を共にするパートナーである。</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ：説明 -->
                <div class="col-12 col-md-12 col-lg-6 renovation_contents_box">
                    <b>「はじめてのリノベーションはわからないことだらけ」<br><br></b>
                    イメージは出来ているが、伝えることができない。<br>
                    そもそも何かからすればいいかが分からない。<br>
                    「あなたの思い描くイメージ」を形にするのが「リノベーション」です。<br>
                    「築年数が経過している」「他者では高額な見積もりだった」「オシャレにしたい」<br>
                    どんな些細な事でも快適な空間を作るために弊社は善処します。<br>
                    小さいことでも妥協せず、人生を共にするパートナーを一緒に創造しましょう。<br>

                    <button type="button" class="btn btn-outline-danger btn_size_10 py-2 mt-5">CONTACT</button>
                </div>

                <!-- コンテンツ：画像 -->
                <div class="col-12 col-md-12 col-lg-6 renovation_contents_img_box">
                    <img src="./img/renovation_01.jpg" class="img-fluid" alt="...">
                </div>

            </div>
        </div>

        <!-- 内容01 -->
        <div class="container-fluid fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 renovation_contents_title_box_01">
                    <span class="renovation_contents_title_01"><span class="text_red">創</span>造</span>
                    <!-- 縦線 -->
                    <div class="line"></div>
                    <span class="renovation_contents_title_01"><span class="text_red">H</span>IROMIの施工<br></span>
                    <span class="">マンションも戸建ても賃貸も。未来に価値あるリノベーション。</span>
                    
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <ul class="slider">
                    <li><img src="./img/renovation_02.jpg" alt=""></li>
                    <li><img src="./img/renovation_03.jpg" alt=""></li>
                    <li><img src="./img/renovation_04.jpg" alt=""></li>
                    <li><img src="./img/renovation_05.jpg" alt=""></li>
                    <li><img src="./img/renovation_06.jpg" alt=""></li>
                    <!--/slider--></ul>
                </div>


            </div>
        </div>

        <!-- 内容02 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 renovation_contents_title_box_02">
                    <span class="renovation_contents_title_02"><span class="text_red">築</span>100年の物件も生まれ変わります</span>
                    <hr class="bar_red"> 
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/works_01.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/renovation02_01.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/renovation02_02.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/renovation02_03.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/renovation02_04.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-4">
                    <img src="./img/renovation02_05.jpg" class="img-fluid" alt="...">
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12">

                    <table class="table">
                        <tbody>

                            <!-- 商号 -->
                            <tr>
                                <th scope="row">物件名</th>
                                <td>福島区テラスハウス</td>
                            </tr>

                            <!-- 所在地 -->
                            <tr>
                                <th scope="row">予算</th>
                                <td>300万円<br>
                            </tr>

                            <!-- 営業時間 -->
                            <tr>
                                <th scope="row">施工内容</th>
                                <td>
                                    ユニットバス新設・システムキッチン新設などの水回り新設工事。<br>
                                    外壁も雨漏れで木部が腐食していたので、下地補修から防水加工をし、京都風の木ルーバーで仕上げました。<br>
                                    室内のデザインはアクセントクロスを多用することで洋風に仕上げました。
                                </td>
                            </tr>

                        </tbody>
                    </table>

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

        <!-- slick -->
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- 自作js -->
        <script src="{{ asset('js/front/front_renovation.js') }}"></script>
        
    </body>

</html>