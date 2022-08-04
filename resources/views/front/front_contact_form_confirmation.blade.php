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
                <div class="col-12 col-md-12 col-lg-12 contact_form_container_box">

                    <form>
                        
                        <table class="table">
                            <tbody>

                                <!-- お名前 -->
                                <tr>
                                    <th scope="row" style="width:40%"><label class="s_required" for="textBox">お名前</label></th>
                                    <td><input type="text" class="form-control contact_form_input_box" id="contact_user_name" placeholder="例：大阪　太郎"></td>
                                </tr>

                                <!-- メールアドレス -->
                                <tr>
                                    <th scope="row" style="width:40%"><label class="s_required" for="textBox">メールアドレス</label></th>
                                    <td><input type="text" class="form-control contact_form_input_box" id="contact_user_name" placeholder="例：xxxx@gmail.com"></td>
                                </tr>

                                <!-- 電話番号 -->
                                <tr>
                                    <th scope="row" style="width:40%"><label class="s_any" for="textBox">電話番号</label></th>
                                    <td><input type="text" class="form-control contact_form_input_box" id="contact_user_name" placeholder="例：080-xxxx-xxxx"></td>
                                </tr>

                                <!-- 連絡方法 -->
                                <tr>
                                    <th scope="row" style="width:40%"><label class="s_required" for="textBox">連絡方法</label></th>
                                        <td>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">メール</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">電話</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">どちらでも</label>
                                        </div>

                                    </td>
                                </tr>

                                <!-- お問い合わせ内容 -->
                                <tr>
                                    <th scope="row" style="width:40%"><label class="s_required" for="textBox">問合せ内容</label></th>
                                    <td>
                                        <textarea class="form-control contact_form_input_box" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    </td>
                                </tr>
                            
                                
                            </tbody>
                        </table>
                        
                    </form>

                </div>

                <div class="col-12 col-md-12 col-lg-12 contact_form_contents_box mt-3">
                    <a href="#" class="btnshine btn_size_15 zoomInTrigger">確認画面へ</a>
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