$(function() {

    // 登録・編集
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

        // id
        let reform_id = $("#reform_id").val();
        console.log('reform_id:' + reform_id);

        // validationフラグ初期値
        let v_check = true;
        
        /**
         * v_checkフラグがfalseの場合、下段のバリデーションに引っ掛かり
         * modalFormにwas-validatedを付与、エラー文字の表示
         */
        if(reform_title == ''){

            v_check = false;
        }

        if(reform_sub_title == ''){

            v_check = false;
        }

        if(img_files == ''){

            v_check = false;
        }
        
        // チェック=falseの場合プログラム終了
        console.log('v_check:' + v_check);

        if (v_check === false) {

            // ローディング画面停止
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);

            $('#editForm').addClass("was-validated");

            return false;
        }

        /**
         * 送信データ設定
         */
        var sendData = new FormData();
        sendData.append('reform_title', reform_title);
        sendData.append('reform_sub_title', reform_sub_title);
        sendData.append('editor_input', editor_input);
        sendData.append('reform_id', reform_id);
        
        $("#img_files").each(function(index, field) {
            console.log(field.files);
            for (var i=0; i < field.files.length; i++) {
                let file = field.files[i];
                console.log(file);
                sendData.append('img_files' + '[' + i + ']', file);
            }
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
            // 画像複数アップロードの場合必要
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
                        location.href = 'backReformInit';
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

    // 削除
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
         let reform_id = $('#reform_id').val();
         console.log(reform_id);
        
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
                    "reform_id": reform_id,
                };
                console.log(sendData);
    
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
    
                $.ajax({
                    type: 'post',
                    url: 'backReformDeleteEntry',
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
                            OK: true
                        }
                    };
    
                    // then() OKを押した時の処理
                    swal(options)
                        .then(function(val) {
                        if (val) {
                            location.href = 'backReformInit';
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
        
    // 画像編集：表示
    $(".btn_modal").on('click', function(e) {
        console.log('btn_modalの処理');

        e.preventDefault();

        // modal表示
        $('#modal_img').modal('toggle');

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[2];
        console.log('id:'+ id);

        var sendData = new FormData();
        sendData.append('id', id);

        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'backImgEditInit',
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
            // ログ
            console.log('data' + data);
            console.log('img_list' + data.img_list[0]['img_type_id']);

            // ローディング停止
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);
            
            // 値設定
            // 画像
            $('#modal_img_box').attr('src', 'storage/' + data.img_list[0]['img_path']);

            // お知らせ
            $('#img_type_id').val(data.img_list[0]['img_type_id']);
            
            // id
            $('#img_id').val(data.img_list[0]['img_id']);

            // 備考
            $('#img_memo').text(data.img_list[0]['img_memo']);

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

    // 画像編集：登録
    $("#btn_modal_edit").on('click', function(e) {
        console.log('btn_modalの処理');

        e.preventDefault();

        // 値取得
        // id
        let img_id = $('#img_id').val();
        console.log(img_id);
        // 種別
        let img_type_id = $('#img_type_id').val();
        console.log(img_type_id);
        // 備考
        let img_memo = $("#img_memo").val();
        console.log(img_memo);

        // 送信データの設定
        var sendData = new FormData();
        sendData.append('img_id', img_id);
        sendData.append('img_type_id', img_type_id);
        sendData.append('img_memo', img_memo);

        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'backImgEditEntry',
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
                        location.href = 'backReformInit';
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

    // 画像編集（詳細）：削除
    $(".btn_modal_delete").on('click', function(e) {

        console.log('btn_modal_deleteの処理');
    
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

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        img_id = id.split('_')[2];
        console.log('img_id:'+ img_id);
        
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
                    "img_id": img_id,
                };
                console.log(sendData);
    
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
    
                $.ajax({
                    type: 'post',
                    url: 'backImgDeleteEntry',
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
                            location.href = 'backReformInit';
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
