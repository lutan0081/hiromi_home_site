<!-- top画面のロゴ -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 top_logo_box">
            <a href="{{ url('/') }}"><img src="./img/hiromi_home_logo_side.png" class="top_log_size"></a>
        </div>
    </div>
</div>

<!-- ×ボタン -->
<div class="openbtn">
    <span></span><span></span><span></span>
</div>

<!-- コンテンツ -->
<nav id="g-nav">
    <div id="g-nav-list"><!--ナビの数が増えた場合縦スクロールするためのdiv※不要なら削除-->
        <!-- 以下を編集 -->
        <div class="container">
            <div class="row delayScroll">
                <div class="col-12 col-md-12 col-lg-12 parent_box">
                    <div class="row chilled_box">

                        <div class="col-6 col-md-6 col-lg-3">
                            <h4><i class="bi bi-house-door me-1 mb-5"></i>HOME</h3>
                            <a href="{{ url('/') }}" target="_blank"><p class="mt-4">ホーム</p></a>
                            <a href="frontPrivacyInit" target="_blank"><p>プライバシー</p></a>
                            <a href="frontSiteMapInit" target="_blank"><p>サイトマップ</p></a> 
                            <a href="frontInformationInit" target="_blank"><p>新着情報</p></a> 
                        </div>

                        <div class="col-6 col-md-6 col-lg-3">
                            <h4><i class="bi bi-building me-1"></i>COMPANY</h4>
                            <a href="frontAboutUsInit" target="_blank"><p class="mt-4">会社概要</p></a>
                            <a href="frontContactInit" target="_blank"><p>お問い合わせ</p></a> 
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 menu_bottm_mt">
                            <h4><i class="bi bi-gem me-1"></i>SERVICE</h4>
                            <a href="frontWorksInit" target="_blank"><p class="mt-4">施工事例</p></a>
                            <a href="#" target="_blank"><p>ブログ</p></a>
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 menu_bottm_mt">
                            <h4><i class="bi bi-search me-1"></i>RECRUIT</h4>
                            <a href="#" target="_blank"><p class="mt-4">採用情報</p></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="circle-bg"></div>