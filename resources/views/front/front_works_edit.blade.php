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
        <link rel="stylesheet" href="{{ asset('css/front/front_works_edit.css') }}">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid works_edit_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 works_edit_top_box_filter">
                    <div class="works_edit_top_title_box">
                        <span class="works_edit_top_title_en">WORKS<br></span>
                        <span class="works_edit_top_title_jp">施工事例</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 内容 -->
        <div class="container">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 works_edit_contents_title_box fadeUpTrigger">
                    <span class="works_edit_contents_main_title">{{ $reform_edit_list->reform_title }}<br></span>
                </div>

                <!-- サブタイトル -->
                <div class="col-12 col-md-12 col-lg-12 works_edit_contents_sub_title_box fadeUpTrigger">
                    <span class="works_edit_contents_sub_title pt-3">{{ $reform_edit_list->reform_sub_title }}</span>
                </div>

                <!-- 罫線 -->
                <div class="col-12 col-md-12 col-lg-12">
                    <hr class="bar_red">
                </div>
                

                <!-- 写真 -->
                <div class="col-12 col-md-12 col-lg-12 slider_box">
                    
                    <ul class="slider-2" id="js-slider-2">
                        @foreach($img_list as $img)
                            <li><img src="storage/{{ $img->img_path }}" alt=""></li>
                        @endforeach
                    </ul>
                    <div class="dots-2"></div>

                </div>

                <div class="col-12 col-md-12 col-lg-12 works_edit_bottom_box fadeUpTrigger">
                    {!! $reform_edit_list->reform_contents!!}
                </div>

                <!-- 罫線 -->
                <div class="col-12 col-md-12 col-lg-12">
                    <hr class="bar_red">
                </div>

                <!-- 詳細画像 -->
                <div class="col-12 col-md-12 col-lg-12 mt-5">
                    <div class="row delayScroll">

                        @foreach($img_list as $img)
                            <div class="col-12 col-md-12 col-lg-6 mb-4 box">
                                <div class="img_wrap">
                                    <img src="storage/{{ $img->img_path }}" class="img-fluid img_fluid_box" alt="...">
                                </div>
                            </div>
                        @endforeach

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

        
        
        <!-- 独自js -->
        <script src="{{ asset('js/front/front_works_edit.js') }}"></script>

        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    </body>

</html>