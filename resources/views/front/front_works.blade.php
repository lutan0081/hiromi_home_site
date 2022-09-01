<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>施工事例/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_works.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid works_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 works_top_box_filter">
                    <div class="works_top_title_box">
                        <span class="works_top_title_en">WORKS<br></span>
                        <span class="works_top_title_jp">施工事例</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 works_contents_title_box">
                    <span class="works_contents_title">施工事例</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="row view_more_box">
                        <!-- 施工事例：写真 -->
                        @foreach($reform_list as $reform)
                            <div id="reform_id_{{ $reform->reform_id }}" class="col-12 col-md-12 col-lg-4 click_class mb-4">
                                <div class="card">
                                    
                                    <!-- フォーカス時、画像に黒フィルタをかける -->
                                    <div class="img_wrap">
                                        <img src="storage/{{ $reform->img_path }}" class="img-fluid" alt="...">
                                    </div>
                                    
                                    <div class="card-body works_contents_box">
                                        <h5 class="card-title works_contents_img_title">{{ $reform->reform_title }}</h5>
                                        <p class="card-text">{{ $reform->reform_sub_title }}</p>
                                        <i class="bi bi-chevron-right float-end"></i>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- 施工事：ボタン -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-3 fadeUpTrigger">
                            <a href="" id="btn_view_more" class="btnDraw bgleft float-end"><span>VIEW MORE</span></a><br>
                        </div>

                        <div class="col-12 col-md-12 col-lg-12 mt-3 fadeUpTrigger">
                            <!-- ofsetの値 -->
                            <input type="hidden" name="ofset_id" id="ofset_id" value="9">
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

        <!-- js -->
        @component('component.front_js')
        @endcomponent
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_works.js') }}"></script>
    </body>

</html>