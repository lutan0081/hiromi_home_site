 $(function() {
    /**
     * ページネーション：センター表示
     */
    $(".pagination").addClass("justify-content-center");
    $("#links").show();

    /**
     * 一覧ダブルクリックの処理
     */
    $(".click_class").on('dblclick', function(e) {
        console.log("dblclickの処理.");

        // ローディング開始
        $("#overlay").fadeIn(300);

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[1];
        console.log(id);

        // ローディング停止
        setTimeout(function(){
            $("#overlay").fadeOut(300);
        },500);

        // idをパラメーターでControllerに渡す
        location.href = "backPostEditInit?post_id=" + id;
    });

    /**
     * 公開・非公開
     */
     $(".check_class").on('change', function(e) {

        console.log('check_classの処理');

        e.preventDefault();

        // ローディング開始
        $("#overlay").fadeIn(300);
        
        /**
         * 公開のcheckの判定
         * 公開 = active_id:0
         * 非公開 = active_id:1
         */
        if(this.checked){
            var active_id = 0;
            console.log('active_id:' + active_id);
        }else{
            var active_id = 1;
            console.log('active_id:' + active_id);
        }

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[1];
        console.log('id:'+ id);

        /**
         * フォームから値取得
         */
        // id
        let post_id = id;
        console.log('post_id:' + post_id);

        /**
         * 送信データ設定
         */
        var sendData = new FormData();
        sendData.append('post_id', post_id);
        sendData.append('active_id', active_id);

        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'backPostReleaseEntry',
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
                // 画面更新
                location.reload();
            };

             // falseの処理：アラートでエラーメッセージを表示
            if(data.status == false){

                console.log("status:" + data.status);
                console.log("messages:" + data.messages);
                console.log("errorkeys:" + data.errkeys);

                // アラートボタン設定
                var options = {
                    title: 'エラー',
                    text: 'システム管理者にお問い合わせください。',
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