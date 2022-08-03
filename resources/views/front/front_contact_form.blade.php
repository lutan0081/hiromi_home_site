<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>お問い合わせ/HIROMI HOME</title>

        <!-- css -->
        @component('component.front_head')
        @endcomponent

        <!-- Googleフォント：各題名 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">

        <!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/front/front_contact_form.css') }}">

    </head>

    <body>

        <!-- プルダウンメニュー -->
        @component('component.front_menu')
        @endcomponent

        <!-- top画面 -->
        <div class="container-fluid contact_form_top_box">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 contact_form_top_box_filter">
                    <div class="contact_form_top_title_box">
                        <span class="contact_form_title_en">CONTACT<br></span>
                        <span class="contact_form_title_jp">お問い合わせ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- プライバシー内容 -->
        <div class="container fadeUpTrigger">
            <div class="row">

                <!-- タイトル -->
                <div class="col-12 col-md-12 col-lg-12 contact_form_title_box">
                    <span class="contact_form_title">お問い合わせ</span>
                    <hr class="bar_red"> 
                </div>

                <!-- コンテンツ -->
                <div class="col-12 col-md-12 col-lg-12">

                    <form>
                        
                            <table class="table">
                                <tbody>

                                    <!-- お名前 -->
                                    
                                        <tr>
                                            <th scope="row" style="width:30%">お名前</th>
                                            <td style="width:70%"><input type="text" class="form-control" id="contact_user_name" placeholder="例：大阪　太郎"></td>
                                        </tr>
                                

                                    <!-- 所在地 -->
                                    
                                        <tr>
                                            <th scope="row" style="width:30%">メールアドレス</th>
                                            <td style="width:70%"><input type="email" class="form-control" id="contact_user_mail" placeholder="例：xxxx@gmail.com"></td>
                                        </tr>
                                    

                                    <!-- 所在地 -->
                                    
                                        <tr>
                                            <th scope="row" style="width:30%">電話番号</th>
                                            <td style="width:70%"><input type="text" class="form-control" id="contact_user_mail" placeholder="例：080-4234-9459"></td>
                                        </tr>
                                    

                                    <!-- ご希望の連絡方法 -->
                                    
                                        <tr>
                                            <th scope="row" style="width:30%">ご希望の連絡方法</th>
                                            <td style="width:70%"><input type="text" class="form-control size_30" id="contact_user_mail" placeholder="例：080-4234-9459"></td>
                                        </tr>
                                    

                                    <!-- お問い合わせ内容 -->
                                    
                                        <tr>
                                            <th scope="row" style="width:30%">お問い合わせ内容</th>
                                            <td style="width:70%"><input type="text" class="form-control size_30" id="contact_user_mail" placeholder="例：080-4234-9459"></td>
                                        </tr>
                                    


                                </tbody>
                            </table>
                        
                    </form>

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