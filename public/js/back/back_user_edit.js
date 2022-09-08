$(function() {
    
    /**
     * 登録
     */
    $("#btn_edit").on('click', function(e) {

        console.log('btn_editの処理');

        e.preventDefault();

        // ローディング開始
        $("#overlay").fadeIn(300);        

        /**
         * フォームから値取得
         */
        // ユーザ名
        let create_user_name = $("#create_user_name").val();
        console.log('create_user_name:' + create_user_name);

        // メールアドレス
        let create_user_mail = $("#create_user_mail").val();
        console.log('create_user_mail:' + create_user_mail);

        // パスワード
        let create_user_password = $("#create_user_password").val();
        console.log('create_user_password:' + create_user_password);

        // パスワード確認
        let create_user_password_again = $("#create_user_password_again").val();
        console.log('create_user_password_again:' + create_user_password_again);

        // validationフラグ初期値
        let v_check = true;
        
        /**
         * 必須項目が空白の時、v_check = falseになり、modalFormにwas-validatedを付与、エラー文字の表示
         */
        if(create_user_name == ''){
            v_check = false;
        }

        if(create_user_mail == ''){
            v_check = false;
        }

        if(create_user_password == ''){
            v_check = false;
        }

        if(create_user_password_again == ''){
            v_check = false;
        }

        if(create_user_password == create_user_password_again){
            v_check = false;
        }

        console.log('v_check:' + v_check);

        if (v_check === false) {

            // ローディング停止
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);

            $('#editForm').addClass("was-validated");

            return false;
        }

        return false;

        /**
         * 送信データ設定
         */
        var sendData = new FormData();
        sendData.append('post_title', post_title);
        sendData.append('post_type_id', post_type_id);
        sendData.append('editor_input', editor_input);
        sendData.append('post_id', post_id);

        console.log('sendData' + JSON.stringify(sendData));
        
        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'backPostEntry',
            dataType: 'json',
            data: sendData,
            // ★以下は画像送信の際に必要★
            // キャッシュ削除
            cache:false,
            /**
             * dataに指定したオブジェクトをクエリ文字列に変換するかどうかを設定する。
             * 初期値はtrue、自動的に "application/x-www-form-urlencoded" 形式に変換する。
             */
            processData : false,
            contentType : false,

        // trueの処理：完了アラート表示
        }).done(function(data) {

            // ローディング停止
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);
            
            // trueの処理->申込一覧に遷移
            if(data.status == true){
                console.log("status:" + data.status);

                // アラートの設定
                var options = {
                    title: "登録が完了しました。",
                    icon: "success",
                    buttons: {
                        OK: true
                    }
                };
                
                swal(options)
                    .then(function(val) {
                    if (val == 'OK' || val == null) {
                        location.href = 'backPostInit';
                    };
                });
            };

             // falseの処理：アラートでエラーメッセージを表示
            if(data.status == false){

                console.log("status:" + data.status);
                console.log("messages:" + data.messages);
                console.log("errorkeys:" + data.errkeys);

                // アラートボタン設定
                var options = {
                    title: '入力箇所をご確認ください。',
                    text: '※赤表示の箇所を修正後、再登録をしてください。',
                    icon: 'error',
                    buttons: {
                        OK: 'OK'
                    }
                };
                
                // then() OKを押した時の処理
                swal(options)
                    .then(function(val) {
                    /**
                     * ダイアログ外をクリックされた場合、nullを返す為
                     * ok,nullの場合の処理を記載
                     */
                    if (val == 'OK' || val == null) {

                        console.log(val);

                        /**
                         * formの全要素をerror_Messageを表示に変更
                         * error数だけループ処理
                         */
                        for (let i = 0; i < data.errkeys.length; i++) {
                            
                            // bladeの各divにclass指定
                            let id_key = "#" + data.errkeys[i];
                            $(id_key).addClass('is-invalid');
                            console.log(id_key);

                            // 表示箇所のMessageのkey取得
                            let msg_key = "#" + data.errkeys[i] + "_error"

                            // error_messageテキスト追加
                            $(msg_key).text(data.messages[i]);
                            $(msg_key).show();
                            console.log(msg_key);
                        };
                    };
                });
            }
            
            return false;

        // 接続失敗の処理
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);

            // ローディング画面終了の処理
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);
        });
    });

    /**
     * 削除
     */
     $("#btn_delete").on('click', function(e) {

        console.log('btn_deleteの処理');

        e.preventDefault();

        // alertの設定
        var options = {
            title: "削除しますか？",
            text: "※一度削除したデータは復元出来ません。",
            icon: 'warning',
            buttons: {
                CANCEL: "CANCEL", // キャンセルボタン
                OK: true
            }
        };

        /**
         * フォームから値取得
         */
        let post_id = $("#post_id").val();
        console.log('post_id:' + post_id);
        
        // then() OKを押した時の処理
        swal(options)
            .then(function(val) {

            if(val == null){

                console.log('キャンセルの処理');

                return false;
            }

            // OKの処理
            if (val == "OK") {

                console.log('OKの処理');

                // 送信用データ
                let sendData = {
                    "post_id": post_id,
                };
                console.log(sendData);

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });

                $.ajax({
                    type: 'post',
                    url: 'backPostDeleteEntry',
                    dataType: 'json',
                    data: sendData,
                // 接続処理
                }).done(function(data) {

                    console.log('status:' + data.status);

                    // ローディング停止
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);

                    var options = {
                        title: "削除が完了しました。",
                        icon: "success",
                        buttons: {
                            ok: true
                        }
                    };

                    // then() OKを押した時の処理
                    swal(options)
                        .then(function(val) {
                        if (val) {
                            location.href = 'backPostInit';
                        }
                    });

                // ajax接続失敗の時の処理
                }).fail(function(jqXHR, textStatus, errorThrown) {

                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);

                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
            };
        });
    });
});