$(function() {
    // 登録
    $("#btn_edit").on('click', function(e) {

        console.log('btn_editの処理');

        e.preventDefault();

        // ローディング開始
        $("#overlay").fadeIn(300);        

        /**
         * フォームから値取得
         */
        // タイトル
        let reform_title = $("#reform_title").val();
        console.log('reform_title:' + reform_title);

        // サブタイトル
        let reform_sub_title = $("#reform_sub_title").val();
        console.log('reform_sub_title:' + reform_sub_title);

        // 本文
        let editor_input = $("#editor_input").val();
        console.log('editor_input:' + editor_input);

        // 画像ファイル取得
        let img_files = $('#img_files').prop('files');
        console.log("img_files:" + img_files);

        /**
         * 送信データ設定
         */
        var sendData = new FormData();
        sendData.append('reform_title', reform_title);
        sendData.append('reform_sub_title', reform_sub_title);
        sendData.append('editor_input', editor_input);
  
        jQuery.each(jQuery('#img_files')[0].files, function(i, file) {
            sendData.append('img_files'+'['+i+']', file);
        });

        console.log("sendData:" + sendData);

        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'backReformEntry',
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
            enctype: 'multipart/form-data',

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

                        // location.reload();
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
});
