<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>プライバシー/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_privacy.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid privacy_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 privacy_top_box_filter">
                    <div class="privacy_top_title_box">
                        <span class="privacy_top_title_en">PRIVACY<br></span>
                        <span class="privacy_top_title_jp">プライバシー</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- プライバシー内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12 privacy_contents_title_box">
                    <span class="privacy_contents_title">プライバシー</span>
                    <hr class="bar_red"> 
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <span class="font_bold">1.法令等の遵守</span><br>
                    個人情報に関する法令・ガイドライン及びその他の規範を遵守いたします。<br>
                    <br>
                    <span class="font_bold">2.安全管理の実施</span><br>
                    個人情報の漏洩・紛失・破壊・盗難・改竄、不正アクセス等を防止するため、必要かつ適切な安全管理措置を講じます。<br>
                    <br>
                    <span class="font_bold">3.個人情報の取得と取扱</span><br>
                    個人情報を適法かつ公正な手段によって取得し、正確かつ最新の内容に保つよう努めます。<br>
                    <br>
                    <span class="font_bold">4.個人情報の利用</span><br>
                    個人情報の利用目的を明確にし、その目的の達成に必要な範囲内で、業務の遂行上必要な限りにおいて取扱います。<br>
                    <br>
                    <span class="font_bold">5.個人情報の提供</span><br>
                    個人情報の提供に際しては、法令に定められた例外措置等を除き、あらかじめ本人の同意を得ることなく、第三者に提供いたしません。<br>
                    <br>
                    <span class="font_bold">6.個人情報の開示・訂正・利用停止等</span><br>
                    個人情報について、開示・訂正・利用停止等の請求があった場合は、法令に定められた例外措置等を除き、本人であることを確認したうえで、所定の手続きに基づき対応いたします。<br>
                    <br>
                    <span class="font_bold">7.点検・監査の実施</span><br>
                    個人情報保護に関する定期的な点検又は監査を実施し、管理体制及び取組みを継続的に見直し、改善に努めます。<br>
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