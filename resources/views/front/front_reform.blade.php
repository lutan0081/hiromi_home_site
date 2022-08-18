<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>リフォーム/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_reform.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid reform_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 reform_top_box_filter">
                    <div class="reform_top_box_title_box">
                        <span class="reform_top_title_en">REFORM<br></span>
                        <span class="reform_top_title_jp">リフォーム</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 内容1 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 reform_contents_title_box">
                    <span class="reform_contents_title">壁紙・床・防水・外壁など工事に関して全て対応可能です。</span>
                    <hr class="bar_red"> 
                </div>


                <!-- コンテンツ：画像 -->
                <div class="col-12 col-md-12 col-lg-6 order-xl-2">
                    <img src="./img/reform_01.jpg" class="img-fluid" alt="...">
                </div>

                <!-- コンテンツ：説明 -->
                <div class="col-12 col-md-12 col-lg-6 reform_contents order-xl-1">
                    <span class="reform_contents_sub_title"><span class="text_red">「デザインクロス」</span>を多用したオシャレな空間をご提供</span><br><br>
                    白一色のクロスでは何か物足りないと感じたことありませんか？<br>
                    デザインクロスは量産品と比べて数百円高値ですが、一面だけをデザインクロスにするだけで雰囲気が一気に変化します。<br>
                    又、最近ではデザインクロスを組み合わせることにより洋風・アンティーク風にすることも主流です。<br>
                    弊社はお客様のニーズに合わせてデザインをすることを心がけております。
                </div>

            </div>
        </div>

        <!-- 内容2 -->
        <div class="container fadeUpTrigger reform_contents_box">
            <div class="row">
                
                <!-- コンテンツ：画像 -->
                <div class="col-12 col-md-12 col-lg-6 order-xl-1">
                    <img src="./img/reform_02.jpg" class="img-fluid" alt="...">
                </div>

                <!-- コンテンツ：説明 -->
                <div class="col-12 col-md-12 col-lg-6 reform_contents order-xl-2">
                    <span class="reform_contents_sub_title"><span class="text_blue">「水回り工事」</span>で他の物件と差別化を図る</span><br><br>
                    水回り工事は高額と思っていませんか？<br>
                    特にユニットバス交換は、高額な費用が掛かります。<br>
                    在来のお風呂でもお風呂用のパネルを貼り付けることでユニットバスのように施工が可能です。<br>
                    弊社では、ユニットバスの交換だけでなくパネル施工など、最適で最安値の工事をご提案致します。
                </div>

            </div>
        </div>

        <!-- 内容3 -->
        <div class="container fadeUpTrigger reform_contents_box">
            <div class="row">

                <!-- コンテンツ：画像 -->
                <div class="col-12 col-md-12 col-lg-6 order-xl-2">
                    <img src="./img/reform_03.jpg" class="img-fluid" alt="...">
                </div>

                <!-- コンテンツ：説明 -->
                <div class="col-12 col-md-12 col-lg-6 reform_contents order-xl-1">
                    <span class="reform_contents_sub_title"><span class="text_pink">「外壁塗装・防水工事」</span>低価格でもっとデザイン性と便利さを。</span><br><br>
                    テキストテキストテキストテキストテキストテキストテキストテキスト<br>
                    テキストテキストテキステキストテキストテキストテキスト<br>
                    テキストテキストテキストテキストテキストテキストテキストテキスト<br>
                    テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
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