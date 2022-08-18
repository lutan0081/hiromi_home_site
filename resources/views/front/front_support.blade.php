<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>入居者対応/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_support.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid support_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 support_top_box_filter">
                    <div class="support_top_box_title_box">
                        <span class="support_top_title_en">SUPPORT<br></span>
                        <span class="support_top_title_jp">入居者対応</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 support_contents_title_box">
                    <span class="support_contents_title">賃貸経営における設備トラブルは、大切な業務の1つです。</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ：説明 -->
                <div class="col-12 col-md-12 col-lg-6 support_contents_box">
                    <b>「水道が壊れてシャワーが使えないから今すぐ来て欲しい！！」<br><br></b>
                    突然このような電話が掛かってきたことありませんか？<br>
                    入居者からの連絡は、たいていの場合が急を要する場合が多く対応が遅れた場合、クレームに発展してしまう可能性がある為、注意が必要です。<br>
                    そのため、弊社ではスピーディーな対応を心がけており、入居者との連絡は、電話・メール・ラインなど柔軟に対応させて頂いております。<br>
                    「パッキン交換」「電球の交換」などのような些細な工事でも弊社にご相談ください。
                </div>

                <!-- コンテンツ：画像 -->
                <div class="col-12 col-md-12 col-lg-6 support_contents_img_box">
                    <img src="./img/support_detail.jpg" class="img-fluid" alt="...">
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
        
    </body>

</html>