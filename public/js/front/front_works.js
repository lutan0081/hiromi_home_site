$(function() {
    /**
     * 施工事例：詳細表示
     */
    $(".click_class").on('click', function(e) {
        console.log('click_classの処理');

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[2];
        console.log('id:'+ id);

        // idをパラメーターでControllerに渡す
        location.href = "frontWorksEditInit?reform_id=" + id;
    });

    /**
     * View Moreの処理
     */
    // 画像編集：表示
    $("#btn_view_more").on('click', function(e) {
        console.log('btn_view_moreの処理');

        e.preventDefault();

        // tdのidを配列に分解
        var ofset_id = $('#ofset_id').val();
        console.log('ofset_id:'+ ofset_id);

        var sendData = new FormData();
        sendData.append('ofset_id', ofset_id);

        console.log(sendData.getAll('ofset_id')); // ["karabiner", "peter"]
        /**
         * ajaxの設定
         */
        // ヘッダー
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: 'post',
            url: 'frontWorksViewMore',
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

            // データ数が0の場合return false
            if(data.reform_list.length <= 0){
                console.log('データの配列無しの処理');
                return false;
            }

            console.log('reform_id:' + data.reform_list[0]['reform_id']);
            console.log('img_path:' + data.reform_list[0]['img_path']);
            console.log('img_type_id:' + data.reform_list[0]['img_type_id']);
            console.log('reform_title:' + data.reform_list[0]['reform_title']);
            console.log('reform_sub_title:' + data.reform_list[0]['reform_sub_title']);
            console.log('reform_contents:' + data.reform_list[0]['reform_contents']);
            console.log('date_length:' + data.reform_list.length);

            // 取得要素数のループ処理：データ描画
            for (let i = 0; i < data.reform_list.length; i++) {
                /**
                 * html描画
                 */
                // h5_box
                let h5_box = $("<h5></h5>", {
                    id: "h5_box_" + data.reform_list[i]['reform_id'],
                    addClass: "card-title works_contents_img_title",
                    text:data.reform_list[i]['reform_title']
                });
                
                // p_box
                let p_box = $("<p></p>", {
                    id: "p_box" + data.reform_list[i]['reform_id'],
                    addClass: "card-text",
                    text:data.reform_list[i]['reform_sub_title']
                });

                // i_box
                let i_box = $("<i></i>", {
                    id: "p_box" + data.reform_list[i]['reform_id'],
                    addClass: "bi bi-chevron-right float-end",
                });

                // card_body_box
                let card_body_box = $("<div></div>", {
                    id: "card_body_box_" + data.reform_list[i]['reform_id'],
                    addClass: "card-body works_contents_box"
                });

                $(card_body_box).append(i_box);
                $(card_body_box).append(p_box);
                $(card_body_box).append(h5_box);

                // img_box作成
                let img_box = $("<img>", {
                    src: "storage/" + data.reform_list[i]['img_path'],
                    addClass: "img-fluid"
                });

                // img_wrap_box
                let img_wrap_box = $("<div></div>", {
                    id: "img_wrap_" + data.reform_list[i]['reform_id'],
                    addClass: "img_wrap"
                });
                
                $(img_wrap_box).append(img_box);
                // $('.view_more_box').append(card_body_box);
                
                // card要素
                let card_box = $("<div></div>", {
                    id: "card_id_" + data.reform_list[i]['reform_id'],
                    addClass: "card"
                });

                $(card_box).append(img_wrap_box);
                $(card_box).append(card_body_box);
                
                // col要素
                let col_box = $("<div></div>", {
                    id: "reform_id_" + data.reform_list[i]['reform_id'],
                    addClass: "col-12 col-md-12 col-lg-4 click_class mb-4",
                });

                
                $(col_box).append(card_box);

                $('.view_more_box').append(col_box);


                // view_moreの値設定
                $("#ofset_id").val(data.ofset_id);
            };

            // ローディング停止
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);
            
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

/**
 * 施工事例：詳細表示(DOM後)
 * 関数化にするとclick_classでidを取得できない
 */
$(document).on("click", ".click_class", function(){
    console.log('click_classの処理');

    // tdのidを配列に分解
    var id = $(this).attr("id");

    // 文字列をアンダーバーで分割
    id = id.split('_')[2];
    console.log('id:'+ id);

    // idをパラメーターでControllerに渡す
    location.href = "frontWorksEditInit?reform_id=" + id;
});
