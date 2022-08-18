<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>会社概要/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_about_us.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid about_us_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 about_us_top_box_filter">
                    <div class="about_us_top_title_box">
                        <span class="about_us_top_title_en">COMPANY<br></span>
                        <span class="about_us_top_title_jp">会社概要</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- プライバシー内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 about_us_contents_title_box">
                    <span class="about_us_contents_title">会社概要</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12">

                    <table class="table">
                        <tbody>

                            <!-- 商号 -->
                            <tr>
                                <th scope="row">商号</th>
                                <td>株式会社広未ホーム</td>
                            </tr>

                            <!-- 所在地 -->
                            <tr>
                                <th scope="row">所在地</th>
                                <td>〒538-0053<br>
                                大阪府大阪市鶴見区鶴見3-10-27-2F<br>
                                TEL：06-1111-1111<br class="br-sp"> FAX：06-1111-1111
                                </td>
                            </tr>

                            <!-- 営業時間 -->
                            <tr>
                                <th scope="row">営業時間</th>
                                <td>10：00～19:00</td>
                            </tr>

                            <!-- 代表者 -->
                            <tr>
                                <th scope="row">代表者</th>
                                <td>大阪　太郎</td>
                            </tr>

                            <!-- 資本金 -->
                            <tr>
                                <th scope="row">資本金</th>
                                <td>10,000,000円</td>
                            </tr>

                            <!-- 設立 -->
                            <tr>
                                <th scope="row">設立</th>
                                <td>2989年8月1日</td>
                            </tr>

                            <!-- 建築番号 -->
                            <tr>
                                <th scope="row">建築業許可番号</th>
                                <td>大阪府知事許可(般-30)　第149687号</td>
                            </tr>

                            <!-- 取引銀行 -->
                            <tr>
                                <th scope="row">取引銀行</th>
                                <td>関西みらい銀行・〇〇〇〇〇〇銀行</td>
                            </tr>

                            <!-- 事業内容 -->
                            <tr>
                                <th scope="row">事業内容</th>
                                <td>
                                    不動産の売買、仲介、賃貸並びに管理業務<br>
                                    不動産のコンサルティング<br>
                                    不動産の投資<br>
                                    建築工事の設計、施工並びに請負業務<br>
                                    内装仕上工事業<br>
                                    土木工事業<br>
                                    通信代理店業<br>
                                    損害保険代理業<br>
                                    ディベロップ事業<br>
                                    インベストメント事業
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
        
        <!-- front_home -->
        <script src="{{ asset('js/front/front_home.js') }}"></script>
    </body>

</html>