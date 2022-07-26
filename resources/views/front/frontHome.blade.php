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
        <link href="https://fonts.googleapis.com/css2?family=Ms+Madi&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_home.css') }}">

    </head>

    <body>
        <div id="splash">
            <div id="splash-logo">読み込み中...</div>
        </div>

        <div class="splashbg"></div>

        <!---画面遷移用-->
        <div id="container">
            <p>
                ここにメインコンテンツが入ります。
            </p>
        </div>

        <!-- js -->
        @component('component.front_js')
        @endcomponent
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_home.js') }}"></script>
    </body>

</html>